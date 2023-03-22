<?php
namespace Models\Domain;
class PessoaJuridica extends Usuario
{
    private $razao_social;
    private $cnpj;

    /**
     * Get the value of razao_social
     */ 
    public function getRazao_social()
    {
        return $this->razao_social;
    }

    /**
     * Set the value of razao_social
     *
     * @return  self
     */ 
    public function setRazao_social($razao_social)
    {
        $this->razao_social = $razao_social;

        return $this;
    }

    /**
     * Get the value of cnpj
     */ 
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set the value of cnpj
     *
     * @return  self
     */ 
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }
}