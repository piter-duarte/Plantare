<?php
namespace Models\Database;
use Models\Database\Connection;

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
        $con->query(
        "
                SET NAMES utf8mb4;

                CREATE DATABASE IF NOT EXISTS plantare_DB;
                
                USE plantare_DB;
                
                CREATE TABLE IF NOT EXISTS usuarios
                (
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
                ) ENGINE=innoDB;
                
                CREATE TABLE IF NOT EXISTS servicos
                (
                                id INT PRIMARY KEY,
                                nome VARCHAR(300)
                ) ENGINE=innoDB;
                
                CREATE TABLE IF NOT EXISTS relacao
                (
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
                ) ENGINE=innoDB;
                
                CREATE TABLE IF NOT EXISTS events
                (
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
                                status VARCHAR(300), 
                                FOREIGN KEY (clienteEmail) REFERENCES usuarios(email)
                                ON DELETE CASCADE
                                ON UPDATE CASCADE,
                                FOREIGN KEY (provedorEmail) REFERENCES usuarios(email) 
                                ON DELETE CASCADE
                                ON UPDATE CASCADE,
                                FOREIGN KEY (idServico) REFERENCES servicos(id) 
                                ON DELETE CASCADE
                                ON UPDATE CASCADE
                ) ENGINE=innoDB;
                
                INSERT IGNORE INTO servicos VALUES (1, 'Cortar Grama'), (2, 'Realizar Poda'), (3, 'Aplicar Pesticida'), (4, 'Aplicar Fertilizante');
                
                INSERT IGNORE INTO usuarios VALUES ('Usuario', null, null, null, null, null, null, 0,0, 5.00, 'user@email.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2');
                INSERT IGNORE INTO usuarios(nome,cpf,razao_social,cnpj,telefone,cep,endereco,ehJuridica,ehProvedor,media,email,senha) VALUES ('Romário de Souza Faria', '413.092.426-58', null, null, '(64) 99775-3402', '75803-335', 'Rua Madre Pilar', 0,0, 5.00, 'romario@email.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2');
                
                INSERT IGNORE INTO usuarios VALUES (null, null, 'Cortadores.Inc', '18.798.114/0001-94', '(47) 3323-9585', '89289-620', 'Rua Afonso Spitzner', 1,1, 5.00, 'cortadores@email.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2');
                INSERT IGNORE INTO relacao(provedorEmail, idServico, preco) VALUES ('cortadores@email.com', 1, 75.50), ('cortadores@email.com', 2, 115.00), ('cortadores@email.com', 3, 64.99), ('cortadores@email.com', 4, 100.00);

                INSERT IGNORE INTO usuarios(nome,cpf,razao_social,cnpj,telefone,cep,endereco,ehJuridica,ehProvedor,media,email,senha) VALUES ('Luan Noah Almeida', '171.383.999-79', null, null, '(53) 98936-8716', '96072-086', 'Rua Vinte e Sete', 0,1, 5.00, 'luan@email.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2');
                INSERT IGNORE INTO relacao(provedorEmail, idServico, preco) VALUES ('luan@email.com', 1, 25.00), ('luan@email.com', 2, 50.00), ('luan@email.com', 3, 75.0), ('luan@email.com', 4, 100.00);
                
                INSERT IGNORE INTO usuarios VALUES (null, null, 'JC Jardinagem', '59.668.727/0001-94', '(11) 63246-2875', '69025-007', 'Vila Sidon', 1,1, 5.00, 'jc@email.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2');
                INSERT IGNORE INTO relacao(provedorEmail, idServico, preco) VALUES ('jc@email.com', 1, 75.50), ('jc@email.com', 2, 115.00), ('jc@email.com', 3, 64.99), ('jc@email.com', 4, 100.00);
                
                INSERT IGNORE INTO usuarios VALUES ('Uwelson Flores', '915.686.430-20', null, null, null, null, null, 0,1, 5.00, 'uwelson@email.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2');
                INSERT IGNORE INTO relacao(provedorEmail, idServico, preco) VALUES ('uwelson@email.com', 1, 75.50), ('uwelson@email.com', 2, 115.00), ('uwelson@email.com', 3, 64.99), ('uwelson@email.com', 4, 100.00);

                INSERT IGNORE INTO usuarios VALUES ('Cristiano Jardinagem', '463.576.320-07', null, null, '(48) 52366-5792', '89227-560', 'Rua Arquimedes', 0,1, 5.00, 'cristiano@email.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2');
                INSERT IGNORE INTO relacao(provedorEmail, idServico, preco) VALUES ('cristiano@email.com', 1, 65.50), ('cristiano@email.com', 2, 80.00), ('cristiano@email.com', 3, 74.99), ('cristiano@email.com', 4, 47.07);
            ");
    }

    public function verificarSeExiste()
    {
        $con = $this->conectDB();
        $stmt = $con->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'plantare_db'");
        return (bool) $stmt->fetchColumn();
    }

}