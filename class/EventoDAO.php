<?php
namespace Classes;
use Models\Database;
use Models\Evento;
use Models\Servico;

class EventoDAO extends Database
{
    public function inserir($evento)
    {

        $b=$this->useDB()->prepare("INSERT INTO events(title, description, color, start, end, rating, clienteEmail, provedorEmail, idServico, precoServico) VALUES (?,?,?,?,?,?,?,?,?,?)");

        $title = $evento->getTitle();
        $description = $evento->getDescription();
        $color = $evento->getColor();
        $start = $evento->getStart();
        $end =  $evento->getEnd();
        $rating =  $evento->getRating();
        $clienteEmail  = $evento->getCliente()->getEmail();
        $provedorEmail = $evento->getProvedor()->getEmail();
        $idServico     = $evento->getServico()->getId();
        $precoServico = $evento->getPrecoServico();


        $b->bindParam(1,$title,\PDO::PARAM_STR);
        $b->bindParam(2,$description,\PDO::PARAM_STR);
        $b->bindParam(3,$color,\PDO::PARAM_STR);
        $b->bindParam(4,$start,\PDO::PARAM_STR);
        $b->bindParam(5,$end,\PDO::PARAM_STR);
        $b->bindParam(6,$rating,\PDO::PARAM_STR);
        $b->bindParam(7,$clienteEmail,\PDO::PARAM_STR);
        $b->bindParam(8,$provedorEmail,\PDO::PARAM_STR);
        $b->bindParam(9,$idServico,\PDO::PARAM_STR);
        $b->bindParam(10,$precoServico,\PDO::PARAM_STR);  //mesmo sendo DECIMAL o bindParam não tem um específico para decimais, portanto deve se usar PARAM_STR
        $b->execute();
    }
    public function alterar()
    {
    }
    public function remover($id)
    {
        $b=$this->useDB()->prepare("DELETE FROM events WHERE id=?");
        $b->bindParam(1,$id,\PDO::PARAM_INT);
        $b->execute();
    }
    //busca o evento relacionado pelo id
    public function buscar($evento)
    {
        $id = $evento->getId();

        $b=$this->useDB()->prepare("SELECT * FROM events WHERE events.id=?");
        $b->bindParam(1,$id,\PDO::PARAM_INT);
        $b->execute();
        $resultado=$b->fetch(\PDO::FETCH_ASSOC);

        $eventoRetorno = new Evento();

        $eventoRetorno->setId($resultado["id"]);
        $eventoRetorno->setTitle($resultado["title"]);
        $eventoRetorno->setDescription($resultado["description"]);
        $eventoRetorno->setColor($resultado["color"]);
        $eventoRetorno->setStart($resultado["start"]);
        $eventoRetorno->setEnd($resultado["end"]);
        $eventoRetorno->setRating($resultado["rating"]);
        //buscando no banco de dados informações do cliente e do provedor e criando os seus objetos
        $usuarioDAO = new UsuarioDAO;
        $cliente  = $usuarioDAO->buscarPorEmail($resultado["clienteEmail"]);
        $provedor = $usuarioDAO->buscarPorEmail($resultado["provedorEmail"]);

        //buscando no banco de dados informações do servioço e criando o seu objeto
        $servico = new Servico;
        $servico->setId($resultado["idServico"]);

        $servicoDAO = new ServicoDAO;
        $servico = $servicoDAO->buscar($servico);

        $eventoRetorno->setCliente($cliente);
        $eventoRetorno->setProvedor($provedor);
        $eventoRetorno->setServico($servico);
        $eventoRetorno->setPrecoServico($resultado["precoServico"]);

        return $eventoRetorno;
    }
    //Lista os eventos relacionados ao usuário
    public function listarPorEmail($evento)
    {
        $clienteEmail = $evento->getEmail();
        $provedorEmail = $evento->getEmail();

        $b=$this->useDB()->prepare("SELECT * FROM events WHERE clienteEmail=? OR provedorEmail=?");
        $b->bindParam(1,$clienteEmail,\PDO::PARAM_STR);
        $b->bindParam(2,$provedorEmail,\PDO::PARAM_STR);
        $b->execute();
        $resultado=$b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($resultado);
    }
    public function alterarNota($avaliacao, $id)
    {
        $b=$this->useDB()->prepare("UPDATE events SET rating=? WHERE id=?");
        $b->bindParam(1,$avaliacao,\PDO::PARAM_INT);
        $b->bindParam(2,$id,\PDO::PARAM_INT);
        $b->execute();
    }
    public function alterarStatus($color,$start,$end,$id)
    {
        /*$b=$this->useDB()->prepare("UPDATE events SET color=?, start=?, end=? WHERE id=?");
        $b->bindParam(1,$color,\PDO::PARAM_STR);
        $b->bindParam(2,$start,\PDO::PARAM_INT);
        $b->bindParam(3,$end,\PDO::PARAM_INT);
        $b->bindParam(4,$id,\PDO::PARAM_INT);
        $b->execute();
        return $f=$b->fetch(\PDO::FETCH_ASSOC);*/
        return $start;
    }
    
    //TODO implementar busca por id com intervalo completo
    public function buscar2($id)
    {
        $b=$this->useDB()->prepare("select title, description, color, MIN(start) as start, MAX(end) as end, clienteEmail, provedorEmail, idServico from events where provedorEmail=? GROUP BY `clienteEmail`, `provedorEmail`, `idServico`");
        $b->bindParam(1,$id,\PDO::PARAM_INT);
        $b->execute();
        return $f=$b->fetch(\PDO::FETCH_ASSOC);
    }
    //TODO implementar busca por email com intervalo completo
    public function listarPorEmail2($email)
    {
        $b=$this->useDB()->prepare("select id, title, description, color, MIN(start) as start, MAX(end) as end, clienteEmail, provedorEmail, idServico from events where clienteEmail=? or provedorEmail=? GROUP BY `clienteEmail`, `provedorEmail`, `idServico`,  day(start), id");
        $b->bindParam(1,$email,\PDO::PARAM_STR);
        $b->bindParam(2,$email,\PDO::PARAM_STR);
        $b->execute();
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($f);
    }

    //TODO implementar update do status com intervalo completo
    public function alterarStatus2($color, $clienteEmail, $provedorEmail, $idServico)
    {
        $b=$this->useDB()->prepare("UPDATE events SET color=? WHERE clienteEmail=? AND provedorEmail=? AND idServico=?");
        $b->bindParam(1,$color,\PDO::PARAM_STR);
        $b->bindParam(2,$clienteEmail,\PDO::PARAM_STR);
        $b->bindParam(3,$provedorEmail,\PDO::PARAM_STR);
        $b->bindParam(4,$idServico,\PDO::PARAM_INT);
        $b->execute();
    }
}