<?php
namespace Models\Database;

abstract class Connection //classe de conexão com o banco
{
    protected function conectDB() //utilizado para conectar com o host e utilizado para criar o banco
    {
        try{
            $con=new \PDO("mysql:host=".HOST,USER,PASS);
            return $con;
        }catch (\PDOException $erro){
            return $erro ->getMessage();
        }
    }
}