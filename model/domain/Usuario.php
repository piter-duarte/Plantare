<?php
namespace Models\Domain;
abstract class Usuario
{
    protected $email;
    protected $senha;
    protected $telefone;
    protected $cep;
    protected $endereco;
    protected $ehJuridica;
    protected $ehProvedor;
    protected $media;

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telefone
     */ 
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of cep
     */ 
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     *
     * @return  self
     */ 
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of endereco
     */ 
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of endereco
     *
     * @return  self
     */ 
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get the value of ehJuridica
     */ 
    public function getEhJuridica()
    {
        return $this->ehJuridica;
    }

    /**
     * Set the value of ehJuridica
     *
     * @return  self
     */ 
    public function setEhJuridica($ehJuridica)
    {
        $this->ehJuridica = $ehJuridica;

        return $this;
    }

    /**
     * Get the value of ehProvedor
     */ 
    public function getEhProvedor()
    {
        return $this->ehProvedor;
    }

    /**
     * Set the value of ehProvedor
     *
     * @return  self
     */ 
    public function setEhProvedor($ehProvedor)
    {
        $this->ehProvedor = $ehProvedor;

        return $this;
    }

    /**
     * Get the value of media
     */ 
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the value of media
     *
     * @return  self
     */ 
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }
}
