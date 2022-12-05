<?php
namespace Classes;
use Models\Database;
use Models\PessoaFisica;
use Models\PessoaJuridica;

class UsuarioDAO extends Database{
    public function inserir($usuario)
    {
        $email = $usuario->getEmail();
        $senha  = hash("sha512", $usuario->getSenha());
        $usuario->setSenha($senha);

        $telefone = $usuario->getTelefone();
        $cep = $usuario->getCep();
        $endereco = $usuario->getEndereco();
        $ehJuridica = $usuario->getEhJuridica();
        $ehProvedor = $usuario->getEhProvedor();
        $media = $usuario->getMedia();

        $b=$this->useDB()->prepare("select * from usuarios where email=? and senha=?"); //verifica se o usuário já está cadastrado
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$senha,\PDO::PARAM_STR);
        $b->execute();
        $b->fetch(\PDO::FETCH_ASSOC);

        if($b->rowCount() == 0)
        {
            if($usuario instanceof PessoaFisica)
            {
                $nome = $usuario->getNome();
                $cpf = $usuario->getCpf();
                $razao_social = "";
                $cnpj = "";
            }
            else
            {
                $nome = "";
                $cpf = "";
                $razao_social = $usuario->getRazao_social();
                $cnpj = $usuario->getCnpj();
            }

            $b=$this->useDB()->prepare("insert into usuarios values (?,?,?,?,?,?,?,?,?,?,?,?)");
            $b->bindParam(1,$nome,\PDO::PARAM_STR);
            $b->bindParam(2,$cpf,\PDO::PARAM_STR);
            $b->bindParam(3,$razao_social,\PDO::PARAM_STR);
            $b->bindParam(4,$cnpj,\PDO::PARAM_STR);
            $b->bindParam(5,$telefone,\PDO::PARAM_STR);
            $b->bindParam(6,$cep,\PDO::PARAM_STR);
            $b->bindParam(7,$endereco,\PDO::PARAM_STR);
            $b->bindParam(8,$ehJuridica,\PDO::PARAM_STR);
            $b->bindParam(9,$ehProvedor,\PDO::PARAM_STR);
            $b->bindParam(10,$media,\PDO::PARAM_STR);
            $b->bindParam(11,$email,\PDO::PARAM_STR);
            $b->bindParam(12,$senha,\PDO::PARAM_STR);
            $b->execute();

            $this->buscar($usuario);
        }
        else
        {
            exit("<p> Usuário já cadastrado! Aplicação Encerrada! </p>");   
        }
    }
    public function alterar($usuario)
    {
        if($usuario instanceof PessoaFisica)
        {
            $nome = $usuario->getNome();
            $cpf = $usuario->getCpf();
            $razao_social = "";
            $cnpj = "";
        }
        else
        {
            $nome = "";
            $cpf = "";
            $razao_social = $usuario->getRazao_social();
            $cnpj = $usuario->getCnpj();
        }
        $telefone = $usuario->getTelefone();
        $cep = $usuario->getCep();
        $endereco = $usuario->getEndereco();
        $media = $usuario->getMedia();
        $email = $usuario->getEmail();

        $b=$this->useDB()->prepare("UPDATE usuarios 
        SET nome=?, cpf=?, razao_social=?,  cnpj=?, telefone=?, cep=?, endereco=?, media=?
        WHERE email=?");
        $b->bindParam(1,$nome,\PDO::PARAM_STR);
        $b->bindParam(2,$cpf,\PDO::PARAM_STR);
        $b->bindParam(3,$razao_social,\PDO::PARAM_STR);
        $b->bindParam(4,$cnpj,\PDO::PARAM_STR);
        $b->bindParam(5,$telefone,\PDO::PARAM_STR);
        $b->bindParam(6,$cep,\PDO::PARAM_STR);
        $b->bindParam(7,$endereco,\PDO::PARAM_STR);
        $b->bindParam(8,$media,\PDO::PARAM_STR);
        $b->bindParam(9,$email,\PDO::PARAM_STR);
        $b->execute();

        $_SESSION['usuario'] = serialize($usuario);
    }
    public function remover($usuario){}
    public function buscar($usuario)
    {
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();

        $b=$this->useDB()->prepare("select * from usuarios where email=? and senha=?"); //procura no BDD o usuario digitado
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$senha,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);

        if($b->rowCount() == 0)
        {
         exit("<p> Credenciais de acesso incorretas. Tente novamente! </p>");
        }
        else
        {  
            if($resultado['ehJuridica'] == '0')
            {
                $usuarioRetorno = new PessoaFisica;
                
                //dados de todo usuario
                $usuarioRetorno->setEmail($resultado['email']);
                $usuarioRetorno->setSenha($resultado["senha"]);
                $usuarioRetorno->setTelefone($resultado["telefone"]);
                $usuarioRetorno->setCep($resultado["cep"]);
                $usuarioRetorno->setEndereco($resultado["endereco"]);
                $usuarioRetorno->setEhJuridica($resultado['ehJuridica']);
                $usuarioRetorno->setEhProvedor($resultado['ehProvedor']);
                $usuarioRetorno->setMedia($resultado['media']);
                
                //dados de pessoa física
                $usuarioRetorno->setNome($resultado["nome"]);
                $usuarioRetorno->setCpf($resultado["cpf"]);
            }
            else
            {
                $usuarioRetorno = new PessoaJuridica;
                
                //dados de todo usuario
                $usuarioRetorno->setEmail($resultado['email']);
                $usuarioRetorno->setSenha($resultado["senha"]);
                $usuarioRetorno->setTelefone($resultado["telefone"]);
                $usuarioRetorno->setCep($resultado["cep"]);
                $usuarioRetorno->setEndereco($resultado["endereco"]);
                $usuarioRetorno->setEhJuridica($resultado['ehJuridica']);
                $usuarioRetorno->setEhProvedor($resultado['ehProvedor']);
                $usuarioRetorno->setMedia($resultado['media']);
                
                //dados de pessoa jurídica
                $usuarioRetorno->setRazao_social($resultado['razao_social']);
                $usuarioRetorno->setCnpj($resultado["cnpj"]);
            }
            session_start();
            $_SESSION['usuario'] = serialize($usuarioRetorno);
            $_SESSION['conectado']  = true;
        }        
    }
    public function alterarMedia($email)
    {
        $b=$this->useDB()->prepare("UPDATE usuarios SET media=(SELECT ROUND(AVG(rating)) FROM events WHERE provedorEmail=?) WHERE email=?");
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$email,\PDO::PARAM_STR);
        $b->execute();
    }
    public function buscarPorEmailSenha($email, $senha)
    {
        $senha =  hash("sha512", $senha);

        $b=$this->useDB()->prepare("select * from usuarios where email=? and senha=?"); //procura no BDD o usuario digitado
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$senha,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);

        if($b->rowCount() == 0)
        {
         exit("<p> Credenciais de acesso incorretas. Tente novamente! </p>");
        }
        else
        {  
            if($resultado['ehJuridica'] == '0')
            {
                $usuarioRetorno = new PessoaFisica;
                
                //dados de todo usuario
                $usuarioRetorno->setEmail($resultado['email']);
                $usuarioRetorno->setSenha($resultado["senha"]);
                $usuarioRetorno->setTelefone($resultado["telefone"]);
                $usuarioRetorno->setCep($resultado["cep"]);
                $usuarioRetorno->setEndereco($resultado["endereco"]);
                $usuarioRetorno->setEhJuridica($resultado['ehJuridica']);
                $usuarioRetorno->setEhProvedor($resultado['ehProvedor']);
                $usuarioRetorno->setMedia($resultado['media']);
                
                //dados de pessoa física
                $usuarioRetorno->setNome($resultado["nome"]);
                $usuarioRetorno->setCpf($resultado["cpf"]);
            }
            else
            {
                $usuarioRetorno = new PessoaJuridica;
                
                //dados de todo usuario
                $usuarioRetorno->setEmail($resultado['email']);
                $usuarioRetorno->setSenha($resultado["senha"]);
                $usuarioRetorno->setTelefone($resultado["telefone"]);
                $usuarioRetorno->setCep($resultado["cep"]);
                $usuarioRetorno->setEndereco($resultado["endereco"]);
                $usuarioRetorno->setEhJuridica($resultado['ehJuridica']);
                $usuarioRetorno->setEhProvedor($resultado['ehProvedor']);
                $usuarioRetorno->setMedia($resultado['media']);
                
                //dados de pessoa jurídica
                $usuarioRetorno->setRazao_social($resultado['razao_social']);
                $usuarioRetorno->setCnpj($resultado["cnpj"]);
            }
            session_start();
            $_SESSION['usuario'] = serialize($usuarioRetorno);
            $_SESSION['conectado']  = true;
        }        
    }

    public function buscarPorEmail($email)
    {

        $b=$this->useDB()->prepare("select * from usuarios where email=?"); //procura no BDD o usuario digitado
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);

        if($b->rowCount() == 0)
        {
         exit("<p> Erro ao buscar usuario no banco. Tente novamente! </p>");
        }
        else
        {  
            //instancia objeto de acordo com tipo de pessoa
            if($resultado['ehJuridica'] == '0')
            {
                $usuarioRetorno = new PessoaFisica;
                
                //dados de pessoa física
                $usuarioRetorno->setNome($resultado["nome"]);
                $usuarioRetorno->setCpf($resultado["cpf"]);
            }
            else
            {
                $usuarioRetorno = new PessoaJuridica;
                
                //dados de pessoa jurídica
                $usuarioRetorno->setRazao_social($resultado['razao_social']);
                $usuarioRetorno->setCnpj($resultado["cnpj"]);
            }

            //dados de todo usuario
            $usuarioRetorno->setEmail($resultado['email']);
            $usuarioRetorno->setSenha($resultado["senha"]);
            $usuarioRetorno->setTelefone($resultado["telefone"]);
            $usuarioRetorno->setCep($resultado["cep"]);
            $usuarioRetorno->setEndereco($resultado["endereco"]);
            $usuarioRetorno->setEhJuridica($resultado['ehJuridica']);
            $usuarioRetorno->setEhProvedor($resultado['ehProvedor']);
            $usuarioRetorno->setMedia($resultado['media']);

            return $usuarioRetorno;
        }
    }
    public function buscarDisponiveis($idServico, $start, $end)
    {
        $b=$this->useDB()->prepare("SELECT usu.nome, usu.razao_social, usu.ehJuridica, usu.email, usu.media, se.nome 'nomeServico', rel.preco
        FROM usuarios usu
        INNER JOIN relacao rel ON rel.provedorEmail = usu.email
        INNER JOIN servicos se ON se.id = rel.idServico
        WHERE se.id = ? AND usu.email NOT IN(
            SELECT usu2.email 
            FROM usuarios usu2 
            INNER JOIN events ev ON usu2.email = ev.provedorEmail
            INNER JOIN relacao rel2 ON rel2.provedorEmail = usu2.email
            INNER JOIN servicos se2 ON se2.id = rel2.idServico
            WHERE rel2.idServico = se.id AND ev.start >= ? AND ev.end <= ?
            GROUP BY usu2.nome, ev.provedorEmail
        )");

        $b->bindParam(1,$idServico,\PDO::PARAM_INT);
        $b->bindParam(2,$start,\PDO::PARAM_STR);
        $b->bindParam(3,$end,\PDO::PARAM_STR);
        $b->execute();
        $resultado = $b->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }
}