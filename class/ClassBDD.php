<?php
namespace Classes;

use Models\ModelConect;

class ClassBDD extends ModelConect
{
  
    public function inserirUsuario($nome, $telefone, $cep, $endereco, $ehProvedor, $email, $senha)
    {

        $senhaCriptografada = hash("sha512", $senha);

        $b=$this->conectDB()->prepare("select * from usuarios where email=? and senha=?"); //verifica se o usuário já está cadastrado
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$senhaCriptografada,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);

        if($b->rowCount() == 0)
        {
            $b=$this->conectDB()->prepare("insert into usuarios values (?,?,?,?,?,?,?)");
            $b->bindParam(1,$nome,\PDO::PARAM_STR);
            $b->bindParam(2,$telefone,\PDO::PARAM_STR);
            $b->bindParam(3,$cep,\PDO::PARAM_STR);
            $b->bindParam(4,$endereco,\PDO::PARAM_STR);
            $b->bindParam(5,$ehProvedor,\PDO::PARAM_STR);
            $b->bindParam(6,$email,\PDO::PARAM_STR);
            $b->bindParam(7,$senhaCriptografada,\PDO::PARAM_STR);
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

    public function getServices()
    {
        $b=$this->conectDB()->prepare("SELECT nome FROM servicos");
        $b->execute();
        $resultado=$b->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function getProviders()
    {
        $b=$this->conectDB()->prepare("SELECT email FROM usuarios WHERE ehProvedor=1");
        $b->execute();
        $resultado=$b->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }
    
}

