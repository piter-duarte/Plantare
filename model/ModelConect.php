<?php
namespace Models;

class ModelConect
{
    public function conectDB()
    {
        try{
            $con=new \PDO("mysql:host=".HOST,USER,PASS);
            $con->exec('set names utf8');
            $con->query("CREATE DATABASE IF NOT EXISTS sistema");
            $con->query("USE sistema");
            $con->query("CREATE TABLE IF NOT EXISTS usuarios(
                nome       VARCHAR(300),
                telefone   VARCHAR(15),
                cep        VARCHAR(9),
                endereco   VARCHAR(150),
                ehProvedor TINYINT(1),
                email      VARCHAR(300) PRIMARY KEY,
                senha      VARCHAR(130)
                ) ENGINE=innoDB");
            $con->query("CREATE TABLE IF NOT EXISTS events(
                id INT PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(90),
                description TEXT,
                color VARCHAR(10),
                start TIMESTAMP,
                end TIMESTAMP,
                rating INT,
                client_key VARCHAR(300),
                provider_key VARCHAR(300),
                FOREIGN KEY (client_key) REFERENCES usuarios(email)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
                FOREIGN KEY (provider_key) REFERENCES usuarios(email) 
                ON DELETE CASCADE
                ON UPDATE CASCADE
            ) ENGINE=innoDB");
            $con->query("CREATE TABLE IF NOT EXISTS servicos(
                id INT PRIMARY KEY,
                nome VARCHAR(300)
            ) ENGINE=innoDB");
            $con->query("CREATE TABLE IF NOT EXISTS relacao(
                id INT PRIMARY KEY AUTO_INCREMENT,
                provider_key VARCHAR(300),
                idServico INT,
                preco DECIMAL(7,2),
                FOREIGN KEY (provider_key) REFERENCES usuarios(email) 
                ON DELETE CASCADE
                ON UPDATE CASCADE,
                FOREIGN KEY (idServico) REFERENCES servicos(id) 
                ON DELETE CASCADE
                ON UPDATE CASCADE
            ) ENGINE=innoDB");
            $con->query("INSERT IGNORE INTO servicos VALUES (1, 'Cortar Grama'), (2, 'Realizar Poda'), (3, 'Aplicar Pesticida'), (4, 'Aplicar Fertilizante')"); //Cláusula IGNORE utilizada para evitar que o MySQL mostre erro ao tentar reinserir os serviços no BDD
            $con->query("INSERT IGNORE INTO usuarios VALUES ('Manager', '', '', '', 1, 'manager', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2')"); //para testes
            $con->query("INSERT IGNORE INTO usuarios VALUES ('Usuario', '', '', '', 1, 'user', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2')"); //para testes
            return $con;
        }catch (\PDOException $erro){
            return $erro ->getMessage();
        }
    }
}