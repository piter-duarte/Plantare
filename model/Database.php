<?php
namespace Models;
use Models\Connection;

class Database extends Connection
{
    protected function useDB() //utilizado para quando o banco já foi criado
    {
        $con = $this->conectDB();
        $con->exec('set names utf8');
        $con->query("USE plantare_DB");
        return $con;
    }

    public function createDB() //cria o banco de dados
    {
        $con = $this->conectDB();
        $con->exec('set names utf8');
        $con->query("CREATE DATABASE IF NOT EXISTS plantare_DB");
        $con->query("USE plantare_DB");
        $con->query("CREATE TABLE IF NOT EXISTS usuarios(
                nome         VARCHAR(300),
                cpf          VARCHAR(14),
                razao_social VARCHAR(300),
                cnpj         VARCHAR(18),
                telefone     VARCHAR(15),
                cep          VARCHAR(9),
                endereco     VARCHAR(150),
                ehJuridica   TINYINT(1),
                ehProvedor   TINYINT(1),
                media        DECIMAL(3,2),
                email        VARCHAR(300) PRIMARY KEY,
                senha        VARCHAR(130)
                ) ENGINE=innoDB");
         $con->query("CREATE TABLE IF NOT EXISTS servicos(
                id INT PRIMARY KEY,
                nome VARCHAR(300)
            ) ENGINE=innoDB");
        $con->query("CREATE TABLE IF NOT EXISTS relacao(
                id INT PRIMARY KEY AUTO_INCREMENT,
                provedorEmail VARCHAR(300),
                idServico INT,
                preco DECIMAL(7,2),
                FOREIGN KEY (provedorEmail) REFERENCES usuarios(email) 
                ON DELETE CASCADE
                ON UPDATE CASCADE,
                FOREIGN KEY (idServico) REFERENCES servicos(id) 
                ON DELETE CASCADE
                ON UPDATE CASCADE
            ) ENGINE=innoDB");
        $con->query("CREATE TABLE IF NOT EXISTS events(
                id INT PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(90),
                description TEXT,
                color VARCHAR(10),
                start TIMESTAMP,
                end TIMESTAMP,
                rating INT DEFAULT NULL,
                clienteEmail VARCHAR(300),
                provedorEmail VARCHAR(300),
                idServico INT,
                precoServico DECIMAL(10,2), 
                FOREIGN KEY (clienteEmail) REFERENCES usuarios(email)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
                FOREIGN KEY (provedorEmail) REFERENCES usuarios(email) 
                ON DELETE CASCADE
                ON UPDATE CASCADE,
                FOREIGN KEY (idServico) REFERENCES servicos(id) 
                ON DELETE CASCADE
                ON UPDATE CASCADE
            ) ENGINE=innoDB");
        $con->query("INSERT IGNORE INTO servicos VALUES (1, 'Cortar Grama'), (2, 'Realizar Poda'), (3, 'Aplicar Pesticida'), (4, 'Aplicar Fertilizante')"); //Cláusula IGNORE utilizada para evitar que o MySQL mostre erro ao tentar reinserir os serviços no BDD
        $con->query("INSERT IGNORE INTO usuarios VALUES (null, null, 'Manager', null, null, null, null, 1, 1, 5.00,'manager@email.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2')"); //para testes
        $con->query("INSERT IGNORE INTO usuarios VALUES ('Usuario', null, null, null, null, null, null, 0,0, 5.00, 'user@email.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2')"); //para testes
        $con->query("INSERT IGNORE INTO usuarios VALUES (null, null, 'Cortadores.Inc', '18.798.114/0001-94', '(47) 3323-9585', '89289-620', 'Rua Afonso Spitzner', 1,1, 5.00, 'cortadores@email.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2')"); //para testes
            // $con->query("INSERT IGNORE INTO relacao(provedorEmail, idServico, preco) VALUES ('cortadores@email.com', 1, 75.50)"); //para testes
            // $con->query("INSERT IGNORE INTO relacao(provedorEmail, idServico, preco) VALUES ('cortadores@email.com', 2, 115.00)"); //para testes
            // $con->query("INSERT IGNORE INTO relacao(provedorEmail, idServico, preco) VALUES ('cortadores@email.com', 3, 64.99)"); //para testes
            // $con->query("INSERT IGNORE INTO relacao(provedorEmail, idServico, preco) VALUES ('cortadores@email.com', 4, 100.00)"); //para testes
    }

}