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

        $b=$this->conectDB()->prepare("select * from events where start=? and end=? and provider_key=?");
        $b->bindParam(1,$start,\PDO::PARAM_STR);
        $b->bindParam(2,$end,\PDO::PARAM_STR);
        $b->bindParam(3,$provider_key,\PDO::PARAM_INT);
        $b->execute();

        if($b->rowCount() == 0)
        {
                $objBDD           = new \Classes\ClassBDD();
                $resultadoService = $objBDD->getService($title); //pegando o nome do serviço baseado no id

                $b=$this->conectDB()->prepare("insert into events values (?,?,?,?,?,?,?,?,?)");
                $b->bindParam(1,$id,\PDO::PARAM_INT);
                $b->bindParam(2,$resultadoService['nomeS'],\PDO::PARAM_STR);
                $b->bindParam(3,$description,\PDO::PARAM_STR);
                $b->bindParam(4,$color,\PDO::PARAM_STR);
                $b->bindParam(5,$start,\PDO::PARAM_STR);
                $b->bindParam(6,$end,\PDO::PARAM_STR);
                $b->bindParam(7,$rating,\PDO::PARAM_STR);
                $b->bindParam(8,$client_key,\PDO::PARAM_STR);
                $b->bindParam(9,$provider_key,\PDO::PARAM_STR);
                $b->execute();
        }
        else
        {
            exit("<p> Este horário não está disponível </p>");
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
    
    public function getEventsEmail($email)
    {
        $b=$this->conectDB()->prepare("select * from events where client_key=? or provider_key=?");
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$email,\PDO::PARAM_STR);
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

    public function updateRating($id, $avaliacao, $provider_key)
    {
        $a=$this->conectDB()->prepare("UPDATE events SET rating=? WHERE id=?");
        $a->bindParam(1,$avaliacao,\PDO::PARAM_INT);
        $a->bindParam(2,$id,\PDO::PARAM_INT);
        $a->execute();

        $email=$provider_key;

        $b=$this->conectDB()->prepare("UPDATE usuarios SET media=(SELECT ROUND(AVG(rating)) FROM events WHERE provider_key=?) WHERE email=?");
        $b->bindParam(1,$provider_key,\PDO::PARAM_STR);
        $b->bindParam(2,$email,\PDO::PARAM_STR);
        $b->execute();
    }
    
}

