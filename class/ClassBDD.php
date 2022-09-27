<?php
namespace Classes;

use Models\ModelConect;

class ClassBDD extends ModelConect
{
  
    public function inserirUsuario($nome, $telefone, $cep, $endereco, $ehProvedor, $avaliacao=null, $email, $senha)
    {

        $senhaCriptografada = hash("sha512", $senha);

        $b=$this->conectDB()->prepare("select * from usuarios where email=? and senha=?"); //verifica se o usuário já está cadastrado
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$senhaCriptografada,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);

        if($b->rowCount() == 0)
        {
            $b=$this->conectDB()->prepare("insert into usuarios values (?,?,?,?,?,?,?,?)");
            $b->bindParam(1,$nome,\PDO::PARAM_STR);
            $b->bindParam(2,$telefone,\PDO::PARAM_STR);
            $b->bindParam(3,$cep,\PDO::PARAM_STR);
            $b->bindParam(4,$endereco,\PDO::PARAM_STR);
            $b->bindParam(5,$ehProvedor,\PDO::PARAM_STR);
            $b->bindParam(6,$avaliacao,\PDO::PARAM_STR);
            $b->bindParam(7,$email,\PDO::PARAM_STR);
            $b->bindParam(8,$senhaCriptografada,\PDO::PARAM_STR);
            $b->execute();

            $b=$this->conectDB()->prepare("select * from usuarios where email=? and senha=?");
            $b->bindParam(1,$email,\PDO::PARAM_STR);
            $b->bindParam(2,$senhaCriptografada,\PDO::PARAM_STR);
            $b->execute();
            $resultado=$b->fetch(\PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["nome"] = $resultado['nome'];
            $_SESSION["client_key"] = $resultado['email'];
            $_SESSION['conectado'] = true;
        }
        else
        {
            exit("<p> Usuário já cadastrado! Aplicação Encerrada! </p>");
            session_destroy();
        }
    }

    public function logarUsuario($email, $senha)
    {
        //$emailCriptografado  = hash("sha512", $email);
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
            $_SESSION["nome"] = $resultado['nome'];
            $_SESSION["client_key"] = $resultado['email'];
            $_SESSION["ehProvedor"] = $resultado['ehProvedor'];
            $_SESSION['conectado'] = true;
        }        
    }

    public function insertServices($id=0, $provider_key, $idServico, $preco)
    {
        $b=$this->conectDB()->prepare("INSERT INTO relacao VALUES (?,?,?,?)");
        $b->bindParam(1,$id,\PDO::PARAM_INT);
        $b->bindParam(2,$provider_key,\PDO::PARAM_STR);
        $b->bindParam(3,$idServico,\PDO::PARAM_INT);
        $b->bindParam(4,$preco,\PDO::PARAM_STR); //mesmo sendo DECIMAL o bindParam não tem um específico para decimais, portanto deve se usar PARAM_STR
        $b->execute();

    }

    public function getServices()
    {
        $b=$this->conectDB()->prepare("SELECT id, nomeS FROM servicos");
        $b->execute();
        $resultado=$b->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function getService($idServico)
    {
        $b=$this->conectDB()->prepare("SELECT nomeS FROM servicos WHERE id=?");
        $b->bindParam(1,$idServico,\PDO::PARAM_INT);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    // public function getProviders()
    // {
    //     $b=$this->conectDB()->prepare("SELECT nome, email, media FROM usuarios WHERE ehProvedor=1");
    //     $b->execute();
    //     $resultado=$b->fetchAll(\PDO::FETCH_ASSOC);
    //     return $resultado;

    // }

    public function getProviders($idServico, $start, $end, $horas)
    {
        if($horas == 1)
        {
            $b=$this->conectDB()->prepare("SELECT DISTINCT usuarios.nome, usuarios.email, usuarios.media, 
            usuarios.telefone, servicos.nomeS, relacao.preco
            FROM usuarios
            LEFT JOIN events ON usuarios.email=events.provider_key
            JOIN relacao ON usuarios.email=relacao.provider_key
            JOIN servicos ON relacao.idServico=servicos.id
            WHERE usuarios.ehProvedor=1 
            AND (start!=? or start is null)
            AND (end!=? or end is null)
            AND relacao.idServico=?
            ORDER BY usuarios.media DESC, usuarios.nome ASC");
            $b->bindParam(1,$start,\PDO::PARAM_STR);
            $b->bindParam(2,$end,\PDO::PARAM_STR);
            $b->bindParam(3,$idServico,\PDO::PARAM_INT);
            $b->execute();
            $resultado = $b->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }
        elseif($horas == 2)
        {
            $b=$this->conectDB()->prepare("SELECT DISTINCT usuarios.nome, usuarios.email, usuarios.media, 
            usuarios.telefone, servicos.nomeS, relacao.preco
            FROM usuarios
            LEFT JOIN events ON usuarios.email=events.provider_key
            JOIN relacao ON usuarios.email=relacao.provider_key
            JOIN servicos ON relacao.idServico=servicos.id
            WHERE usuarios.ehProvedor=1 
            AND (start!=? or start is null)
            AND (end!=? or end is null)
            AND relacao.idServico=?
            ORDER BY usuarios.media DESC, usuarios.nome ASC");
            $b->bindParam(1,$start,\PDO::PARAM_STR);
            $b->bindParam(2,$end,\PDO::PARAM_STR);
            $b->bindParam(3,$idServico,\PDO::PARAM_INT);
            $b->execute();
            $resultado = $b->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } elseif($horas == 3)
        {
            $b=$this->conectDB()->prepare("SELECT DISTINCT usuarios.nome, usuarios.email, usuarios.media, 
            usuarios.telefone, servicos.nomeS, relacao.preco
            FROM usuarios
            LEFT JOIN events ON usuarios.email=events.provider_key
            JOIN relacao ON usuarios.email=relacao.provider_key
            JOIN servicos ON relacao.idServico=servicos.id
            WHERE usuarios.ehProvedor=1 
            AND (start!=? or start is null)
            AND (end!=? or end is null)
            AND relacao.idServico=?
            ORDER BY usuarios.media DESC, usuarios.nome ASC");
            $b->bindParam(1,$start,\PDO::PARAM_STR);
            $b->bindParam(2,$end,\PDO::PARAM_STR);
            $b->bindParam(3,$idServico,\PDO::PARAM_INT);
            $b->execute();
            $resultado = $b->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }
        else
        {
            exit("Erro!");
        }
    }
    
}

