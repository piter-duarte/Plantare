<?php
namespace Classes;
use Models\Database;

class ClassEvents extends Database
{
    #Trazer os dados de eventos do banco
    public function getEvents()
    {
        $b=$this->useDB()->prepare("select * from events");
        $b->execute();
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($f);
    }

    #Criação da consulta no banco
    public function createEvent($id=0, $title, $description, $color='blue', $start,$end, $rating=null, $clienteEmail, $provedorEmail, $idServico, $precoServico)
    {

        $b=$this->useDB()->prepare("select * from events where start=? and end=? and provedorEmail=?");
        $b->bindParam(1,$start,\PDO::PARAM_STR);
        $b->bindParam(2,$end,\PDO::PARAM_STR);
        $b->bindParam(3,$provedorEmail,\PDO::PARAM_INT);
        $b->execute();
        if($b->rowCount() == 0)
        {
                $servicoDAO           = new \Classes\ServicoDAO();
                $resultado = $servicoDAO->buscar($idServico); //pegando o nome do serviço baseado no id

                $b=$this->useDB()->prepare("insert into events values (?,?,?,?,?,?,?,?,?,?,?)");
                $b->bindParam(1,$id,\PDO::PARAM_INT);
                $b->bindParam(2,$resultado['nome'],\PDO::PARAM_STR);
                $b->bindParam(3,$description,\PDO::PARAM_STR);
                $b->bindParam(4,$color,\PDO::PARAM_STR);
                $b->bindParam(5,$start,\PDO::PARAM_STR);
                $b->bindParam(6,$end,\PDO::PARAM_STR);
                $b->bindParam(7,$rating,\PDO::PARAM_STR);
                $b->bindParam(8,$clienteEmail,\PDO::PARAM_STR);
                $b->bindParam(9,$provedorEmail,\PDO::PARAM_STR);
                $b->bindParam(10,$idServico,\PDO::PARAM_STR);
                $b->bindParam(11,$precoServico,\PDO::PARAM_STR);  //mesmo sendo DECIMAL o bindParam não tem um específico para decimais, portanto deve se usar PARAM_STR
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
        $b=$this->useDB()->prepare("SELECT events.id AS id, events.title, events.description, events.color, events.start, events.end, events.rating, events.clienteEmail, events.provedorEmail, events.idServico, relacao.preco 
        FROM events 
        INNER JOIN relacao ON events.idServico=relacao.idServico 
        WHERE events.id=? AND relacao.provedorEmail=events.provedorEmail");
        $b->bindParam(1,$id,\PDO::PARAM_INT);
        $b->execute();
        return $f=$b->fetch(\PDO::FETCH_ASSOC);
    }

    #Buscar eventos pelo id
    public function getEventsById2($id)
    {
        $b=$this->useDB()->prepare("select title, description, color, MIN(start) as start, MAX(end) as end, clienteEmail, provedorEmail, idServico from events where provedorEmail=? GROUP BY `clienteEmail`, `provedorEmail`, `idServico`");
        $b->bindParam(1,$id,\PDO::PARAM_INT);
        $b->execute();
        return $f=$b->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function getEventsEmail($email)
    {
        $b=$this->useDB()->prepare("select * from events where clienteEmail=? or provedorEmail=?");
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$email,\PDO::PARAM_STR);
        $b->execute();
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($f);
    }

    public function getEventsEmail2($email)
    {
        $b=$this->useDB()->prepare("select id, title, description, color, MIN(start) as start, MAX(end) as end, clienteEmail, provedorEmail, idServico from events where clienteEmail=? or provedorEmail=? GROUP BY `clienteEmail`, `provedorEmail`, `idServico`,  day(start), id");
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$email,\PDO::PARAM_STR);
        $b->execute();
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($f);
    }

    #Update no banco de dados
    public function updateEvent($id, $color)
    {
        $b=$this->useDB()->prepare("update events set color=? where id=?");
        $b->bindParam(1,$color,\PDO::PARAM_STR);
        $b->bindParam(2,$id,\PDO::PARAM_INT);
        $b->execute();
    }

    #Update no banco de dados2
    public function updateEvent2($color, $clienteEmail, $provedorEmail, $idServico)
    {
        $b=$this->useDB()->prepare("UPDATE events SET color=? WHERE clienteEmail=? AND provedorEmail=? AND idServico=?");
        $b->bindParam(1,$color,\PDO::PARAM_STR);
        $b->bindParam(2,$clienteEmail,\PDO::PARAM_STR);
        $b->bindParam(3,$provedorEmail,\PDO::PARAM_STR);
        $b->bindParam(4,$idServico,\PDO::PARAM_INT);
        $b->execute();
    }

    #Deletar no banco de dados
    public function deleteEvent($id)
    {
        $b=$this->useDB()->prepare("delete from events where id=?");
        $b->bindParam(1,$id,\PDO::PARAM_INT);
        $b->execute();
    }
}

