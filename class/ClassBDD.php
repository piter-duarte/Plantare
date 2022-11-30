<?php
namespace Classes;

use Models\ModelConect;

class ClassBDD extends ModelConect
{
  
    public function inserirUsuario($nome,$cpf, $razao_social, $cnpj, $telefone, $cep, $endereco, $ehJuridica, $ehProvedor, $avaliacao=null, $email, $senha)
    {

        $senhaCriptografada = hash("sha512", $senha);

        $b=$this->conectDB()->prepare("select * from usuarios where email=? and senha=?"); //verifica se o usuário já está cadastrado
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$senhaCriptografada,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);

        if($b->rowCount() == 0)
        {
            $b=$this->conectDB()->prepare("insert into usuarios values (?,?,?,?,?,?,?,?,?,?,?,?)");
            $b->bindParam(1,$nome,\PDO::PARAM_STR);
            $b->bindParam(2,$cpf,\PDO::PARAM_STR);
            $b->bindParam(3,$razao_social,\PDO::PARAM_STR);
            $b->bindParam(4,$cnpj,\PDO::PARAM_STR);
            $b->bindParam(5,$telefone,\PDO::PARAM_STR);
            $b->bindParam(6,$cep,\PDO::PARAM_STR);
            $b->bindParam(7,$endereco,\PDO::PARAM_STR);
            $b->bindParam(8,$ehJuridica,\PDO::PARAM_STR);
            $b->bindParam(9,$ehProvedor,\PDO::PARAM_STR);
            $b->bindParam(10,$avaliacao,\PDO::PARAM_STR);
            $b->bindParam(11,$email,\PDO::PARAM_STR);
            $b->bindParam(12,$senhaCriptografada,\PDO::PARAM_STR);
            $b->execute();

            $b=$this->conectDB()->prepare("select * from usuarios where email=? and senha=?");
            $b->bindParam(1,$email,\PDO::PARAM_STR);
            $b->bindParam(2,$senhaCriptografada,\PDO::PARAM_STR);
            $b->execute();
            $resultado=$b->fetch(\PDO::FETCH_ASSOC);

            session_start();
            if($resultado['ehJuridica'] == '0')
            {
                $_SESSION["nome"] = $resultado["nome"];
                $_SESSION["cpf"]  = $resultado["cpf"];
                $_SESSION["razao_social"] = null;
                $_SESSION["cnpj"] = null;
            }
            else
            {
                $_SESSION["nome"]  = null;
                $_SESSION["cpf"]  = null;
                $_SESSION["razao_social"] = $resultado['razao_social'];
                $_SESSION["cnpj"] = $resultado["cnpj"];
            }
            $_SESSION["telefone"]   = $resultado["telefone"];
            $_SESSION["cep"]        = $resultado["cep"];
            $_SESSION["endereco"]   = $resultado["endereco"];
            $_SESSION["ehJuridica"] = $resultado['ehJuridica'];
            $_SESSION["ehProvedor"] = $resultado['ehProvedor'];
            $_SESSION["media"]      = $resultado['media'];
            $_SESSION["email"]      = $resultado['email'];
            $_SESSION['conectado']  = true;
        }
        else
        {
            exit("<p> Usuário já cadastrado! Aplicação Encerrada! </p>");
            session_destroy();
        }
    }

    public function logarUsuario($email, $senha)
    {
        $senhaCriptografada  = hash("sha512", $senha);

        $b=$this->conectDB()->prepare("select * from usuarios where email=? and senha=?"); //procura no BDD o usuario digitado
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$senhaCriptografada,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);

        if($b->rowCount() == 0)
        {
         exit("<p> Credenciais de acesso incorretas. Tente novamente! </p>");
        }
        else
        {  
            session_start();
            if($resultado['ehJuridica'] == '0')
            {
                $_SESSION["nome"] = $resultado["nome"];
                $_SESSION["cpf"]  = $resultado["cpf"];
                $_SESSION["razao_social"] = null;
                $_SESSION["cnpj"] = null;
            }
            else
            {
                $_SESSION["nome"]  = null;
                $_SESSION["cpf"]  = null;
                $_SESSION["razao_social"] = $resultado['razao_social'];
                $_SESSION["cnpj"] = $resultado["cnpj"];
            }
            $_SESSION["telefone"]   = $resultado["telefone"];
            $_SESSION["cep"]        = $resultado["cep"];
            $_SESSION["endereco"]   = $resultado["endereco"];
            $_SESSION["ehJuridica"] = $resultado['ehJuridica'];
            $_SESSION["ehProvedor"] = $resultado['ehProvedor'];
            $_SESSION["media"]      = $resultado['media'];
            $_SESSION["email"]      = $resultado['email'];
            $_SESSION['conectado']  = true;
        }        
    }

    public function insertServices($id=0, $provedorEmail, $idServico, $preco)
    {
        $b=$this->conectDB()->prepare("INSERT INTO relacao VALUES (?,?,?,?)");
        $b->bindParam(1,$id,\PDO::PARAM_INT);
        $b->bindParam(2,$provedorEmail,\PDO::PARAM_STR);
        $b->bindParam(3,$idServico,\PDO::PARAM_INT);
        $b->bindParam(4,$preco,\PDO::PARAM_STR); //mesmo sendo DECIMAL o bindParam não tem um específico para decimais, portanto deve se usar PARAM_STR
        $b->execute();

    }

    public function getServices()
    {
        $b=$this->conectDB()->prepare("SELECT id, nome FROM servicos");
        $b->execute();
        $resultado=$b->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function getService($idServico)
    {
        $b=$this->conectDB()->prepare("SELECT nome FROM servicos WHERE id=?");
        $b->bindParam(1,$idServico,\PDO::PARAM_INT);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function getProviders($idServico, $start, $end){
        $b=$this->conectDB()->prepare("SELECT usu.nome, usu.razao_social, usu.ehJuridica, usu.email, usu.media, se.nome 'nomeServico', rel.preco
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
            GROUP BY usu2.nome
        )");

    $b->bindParam(1,$idServico,\PDO::PARAM_INT);
    $b->bindParam(2,$start,\PDO::PARAM_STR);
    $b->bindParam(3,$end,\PDO::PARAM_STR);
    $b->execute();
    $resultado = $b->fetchAll(\PDO::FETCH_ASSOC);
    return $resultado;
    }

    public function updateUser($nome, $cpf, $razao_social, $cnpj, $telefone, $cep, $endereco, $email){
        $b=$this->conectDB()->prepare("UPDATE usuarios 
        SET nome=?, cpf=?, razao_social=?,  cnpj=?, telefone=?, cep=?, endereco=? 
        WHERE email=?");
        $b->bindParam(1,$nome,\PDO::PARAM_STR);
        $b->bindParam(2,$cpf,\PDO::PARAM_STR);
        $b->bindParam(3,$razao_social,\PDO::PARAM_STR);
        $b->bindParam(4,$cnpj,\PDO::PARAM_STR);
        $b->bindParam(5,$telefone,\PDO::PARAM_STR);
        $b->bindParam(6,$cep,\PDO::PARAM_STR);
        $b->bindParam(7,$endereco,\PDO::PARAM_STR);
        $b->bindParam(8,$email,\PDO::PARAM_STR);
        $b->execute();

        session_start();
        $_SESSION["nome"]          = $nome;
        $_SESSION["cpf"]           = $cpf;
        $_SESSION["razao_social"]  = $razao_social;
        $_SESSION["cnpj"]          = $cnpj;
        $_SESSION["telefone"]      = $telefone;
        $_SESSION["cep"]           = $cep;
        $_SESSION["endereco"]      = $endereco;
    }
    
}

