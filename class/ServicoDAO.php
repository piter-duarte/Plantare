<?php
namespace Classes;
use Models\Database;

class ServicoDAO extends Database
{
    public function inserir()
    {
    }
    public function alterar()
    {
    }
    public function remover()
    {

    }
    public function buscar($idServico)
    {
        $b=$this->conectDB()->prepare("SELECT nome FROM servicos WHERE id=?");
        $b->bindParam(1,$idServico,\PDO::PARAM_INT);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function listar()
    {
        $b=$this->useDB()->prepare("SELECT id, nome FROM servicos");
        $b->execute();
        $resultado=$b->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    }
}