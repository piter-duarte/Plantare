<?php
namespace Classes;

use Models\ModelConect;

class ClassEvents extends ModelConect
{
    #Trazer os dados de eventos do banco
    public function getEvents()
    {
        $b=$this->conectDB()->prepare("select * from events");
        $b->execute();
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($f);
    }

    #Criação da consulta no banco
    public function createEvent($id=0, $title, $description, $color='blue', $start,$end, $rating=null, $client_key, $provider_key)
    {

        // $b=$this->conectDB()->prepare("select * from events where start=? and provider_key=?");
        // $b->bindParam(1,$start,\PDO::PARAM_STR);
        // $b->bindParam(2,$provider_id,\PDO::PARAM_INT);
        // $b->execute();

        // if($b->rowCount() == 0)
        // {
            
                $b=$this->conectDB()->prepare("insert into events values (?,?,?,?,?,?,?,?,?)");
                $b->bindParam(1,$id,\PDO::PARAM_INT);
                $b->bindParam(2,$title,\PDO::PARAM_STR);
                $b->bindParam(3,$description,\PDO::PARAM_STR);
                $b->bindParam(4,$color,\PDO::PARAM_STR);
                $b->bindParam(5,$start,\PDO::PARAM_STR);
                $b->bindParam(6,$end,\PDO::PARAM_STR);
                $b->bindParam(7,$rating,\PDO::PARAM_STR);
                $b->bindParam(8,$client_key,\PDO::PARAM_STR);
                $b->bindParam(9,$provider_key,\PDO::PARAM_STR);
                $b->execute();
        // }
        // else
        // {
        //     exit("<p> Este horário não está disponível </p>");
        // }
        
    }

        

    public function inserirUsuario($nome, $telefone, $cep, $endereco, $ehProvedor, $email, $senha)
    {

        //$emailCriptografado = hash("sha512", $email);
        $senhaCriptografada = hash("sha512", $senha);

        $b=$this->conectDB()->prepare("select * from usuarios where email=? and senha=?");
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

        $b=$this->conectDB()->prepare("select * from usuarios where email=? and senha=?");
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

    #Buscar eventos pelo id
    public function getEventsById($id)
    {
        $b=$this->conectDB()->prepare("select * from events where id=?");
        $b->bindParam(1,$id,\PDO::PARAM_INT);
        $b->execute();
        return $f=$b->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function getEventsByClientKey($client_key)
    {
        $b=$this->conectDB()->prepare("select * from events where client_key=? or provider_key=?");
        $b->bindParam(1,$client_key,\PDO::PARAM_STR);
        $b->bindParam(2,$client_key,\PDO::PARAM_STR);
        $b->execute();
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($f);
    }

    #Update no banco de dados
    public function updateEvent($id, $title, $description, $start, $color)
    {
        $b=$this->conectDB()->prepare("update events set title=?, description=?, start=?, color=? where id=?");
        $b->bindParam(1,$title,\PDO::PARAM_STR);
        $b->bindParam(2,$description,\PDO::PARAM_STR);
        $b->bindParam(3,$start,\PDO::PARAM_STR);
        $b->bindParam(4,$color,\PDO::PARAM_STR);
        $b->bindParam(5,$id,\PDO::PARAM_INT);
        $b->execute();
    }

    #Deletar no banco de dados
    public function deleteEvent($id)
    {
        $b=$this->conectDB()->prepare("delete from events where id=?");
        $b->bindParam(1,$id,\PDO::PARAM_INT);
        $b->execute();
    }

    public function updateRating($id, $avaliacao)
    {
        $b=$this->conectDB()->prepare("update events set rating=? where id=?");
        $b->bindParam(1,$avaliacao,\PDO::PARAM_INT);
        $b->bindParam(2,$id,\PDO::PARAM_INT);
        $b->execute();
    }

    public function getProviders()
    {
        $b=$this->conectDB()->prepare("SELECT email FROM usuarios WHERE ehProvedor=1");
        $b->execute();
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return $f;
    }
    
}

