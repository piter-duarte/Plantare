<?php
namespace Classes;
use Models\Database;

class EventDAO extends Database
{
    public function inserir($title, $description, $color='blue', $start,$end, $rating=null, $clienteEmail, $provedorEmail, $idServico, $precoServico)
    {
    }
    public function alterarNota($avaliacao, $id)
    {
        $a=$this->useDB()->prepare("UPDATE events SET rating=? WHERE id=?");
        $a->bindParam(1,$avaliacao,\PDO::PARAM_INT);
        $a->bindParam(2,$id,\PDO::PARAM_INT);
        $a->execute();
    }
    public function remover()
    {

    }
    public function buscar($usuario)
    {
        $clienteEmail = $usuario->getEmail();
        $provedorEmail = $usuario->getEmail();

        $b=$this->useDB()->prepare("select * from events where clienteEmail=? or provedorEmail=?");
        $b->bindParam(1,$clienteEmail,\PDO::PARAM_STR);
        $b->bindParam(2,$provedorEmail,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($resultado);
    }
    public function listar()
    {
        $b=$this->useDB()->prepare("SELECT id, nome FROM servicos");
        $b->execute();
        $resultado=$b->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }
}