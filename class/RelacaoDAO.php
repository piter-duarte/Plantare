<?php
namespace Classes;
use Models\Database;
class RelacaoDAO extends Database
{
    public function inserir($provedorEmail, $idServico, $preco)
    {
        $b=$this->useDB()->prepare("INSERT INTO relacao(provedorEmail, idServico, preco) VALUES (?,?,?)");
        $b->bindParam(1,$provedorEmail,\PDO::PARAM_STR);
        $b->bindParam(2,$idServico,\PDO::PARAM_INT);
        $b->bindParam(3,$preco,\PDO::PARAM_STR); //mesmo sendo DECIMAL o bindParam não tem um específico para decimais, portanto deve se usar PARAM_STR
        $b->execute();
    }
    public function alterar($usuario)
    {
    }
    public function remover($usuario)
    {

    }
    public function buscar($email, $idServico)
    {
        $b=$this->useDB()->prepare("SELECT relacao.id, relacao.provedorEmail, relacao.idServico, relacao.preco 
        FROM relacao WHERE relacao.provedorEmail = ? AND relacao.idServico=?");
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$idServico,\PDO::PARAM_INT);  
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
    }
}