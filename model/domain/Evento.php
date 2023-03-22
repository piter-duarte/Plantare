<?php
namespace Models\Domain;
class Evento
{
    private $id;
    private $title;
    private $description;
    private $color;
    private $start;
    private $end;
    private $rating;
    private $cliente;  //objeto cliente
    private $provedor; //objeto provedor
    private $servico;  //objeto servico
    private $precoServico;
    private $status;


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of color
     */ 
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */ 
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the value of start
     */ 
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set the value of start
     *
     * @return  self
     */ 
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get the value of end
     */ 
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set the value of end
     *
     * @return  self
     */ 
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of cliente
     */ 
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set the value of cliente
     *
     * @return  self
     */ 
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get the value of provedor
     */ 
    public function getProvedor()
    {
        return $this->provedor;
    }

    /**
     * Set the value of provedor
     *
     * @return  self
     */ 
    public function setProvedor($provedor)
    {
        $this->provedor = $provedor;

        return $this;
    }

    /**
     * Get the value of servico
     */ 
    public function getServico()
    {
        return $this->servico;
    }

    /**
     * Set the value of servico
     *
     * @return  self
     */ 
    public function setServico($servico)
    {
        $this->servico = $servico;

        return $this;
    }

    /**
     * Get the value of precoServico
     */ 
    public function getPrecoServico()
    {
        return $this->precoServico;
    }

    /**
     * Set the value of precoServico
     *
     * @return  self
     */ 
    public function setPrecoServico($precoServico)
    {
        $this->precoServico = $precoServico;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}