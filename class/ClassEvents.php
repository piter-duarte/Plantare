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
    public function createEvent($id=0, $title, $description, $color='blue', $start, $end, $client_id, $provider_id)
    {

        $b=$this->conectDB()->prepare("select * from events where start=? and provider_id=?");
        $b->bindParam(1,$start,\PDO::PARAM_STR);
        $b->bindParam(2,$provider_id,\PDO::PARAM_INT);
        $b->execute();

        if($b->rowCount() == 0)
        {
            
                $b=$this->conectDB()->prepare("insert into events values (?,?,?,?,?,?,?, ?)");
                $b->bindParam(1,$id,\PDO::PARAM_INT);
                $b->bindParam(2,$title,\PDO::PARAM_STR);
                $b->bindParam(3,$description,\PDO::PARAM_STR);
                $b->bindParam(4,$color,\PDO::PARAM_STR);
                $b->bindParam(5,$start,\PDO::PARAM_STR);
                $b->bindParam(6,$end,\PDO::PARAM_STR);
                $b->bindParam(7,$client_id,\PDO::PARAM_INT);
                $b->bindParam(8,$provider_id,\PDO::PARAM_INT);
                $b->execute();
        }
        else
        {
            exit("<p> Este horário não está disponível </p>");
        }
        
    }

        

    public function createUser($id=0, $name, $username, $password, $email,$telefone,$cep,$endereco,$ehProvedor)
    {

        $usernameCriptografado = hash("sha512", $username);
        $emailCriptografado    = hash("sha512", $email);
        $passwordCriptografada = hash("sha512", $password);

        $b=$this->conectDB()->prepare("select * from users where username=? and password=?");
        $b->bindParam(1,$usernameCriptografado,\PDO::PARAM_STR);
        $b->bindParam(2,$passwordCriptografada,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);

        //exit(var_dump($resultado));

        if($b->rowCount() == 0)
        {
            $b=$this->conectDB()->prepare("insert into users values (?,?,?,?,?,?,?,?,?)");
            $b->bindParam(1,$id,\PDO::PARAM_INT);
            $b->bindParam(2,$name,\PDO::PARAM_STR);
            $b->bindParam(3,$usernameCriptografado,\PDO::PARAM_STR);
            $b->bindParam(4,$passwordCriptografada,\PDO::PARAM_STR);
            $b->bindParam(5,$emailCriptografado,\PDO::PARAM_STR);
            $b->bindParam(6,$telefone,\PDO::PARAM_STR);
            $b->bindParam(7,$cep,\PDO::PARAM_STR);
            $b->bindParam(8,$endereco,\PDO::PARAM_STR);
            $b->bindParam(9,$ehProvedor,\PDO::PARAM_INT);
            $b->execute();

            $b=$this->conectDB()->prepare("select * from users where username=? and password=?");
            $b->bindParam(1,$usernameCriptografado,\PDO::PARAM_STR);
            $b->bindParam(2,$passwordCriptografada,\PDO::PARAM_STR);
            $b->execute();
            $resultado=$b->fetch(\PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["nome"] = $resultado['name'];
            $_SESSION["client_id"] = $resultado['id'];
        }
        else
        {
            exit("<p> Usuário já cadastrado! Aplicação Encerrada! </p>");
            session_destroy();
        }
    }

    public function loginUser($username, $password)
    {
        $usernameCriptografado = hash("sha512", $username);
        $passwordCriptografada = hash("sha512", $password);

        $b=$this->conectDB()->prepare("select * from users where username=? and password=?");
        $b->bindParam(1,$usernameCriptografado,\PDO::PARAM_STR);
        $b->bindParam(2,$passwordCriptografada,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);

        if($b->rowCount() == 0)
        {
         exit("<p> Credenciais de acesso incorretas. Tente novamente! </p>");
        }
        else
        {  
            session_start();
            $_SESSION["nome"] = $resultado['name'];
            $_SESSION["client_id"] = $resultado['id'];
            $_SESSION["ehProvedor"] = $resultado['ehProvedor'];
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
    
    public function getEventsByClientId($client_id)
    {
        $b=$this->conectDB()->prepare("select * from events where client_id=? or provider_id=?");
        $b->bindParam(1,$client_id,\PDO::PARAM_INT);
        $b->bindParam(2,$client_id,\PDO::PARAM_INT);
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
    
}

