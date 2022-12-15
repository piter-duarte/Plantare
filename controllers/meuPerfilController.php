<?php

use Models\Domain\PessoaFisica;

include ("../config/config.php");
$usuarioDAO      = new \Models\DAO\UsuarioDAO();
   
    $nome         = filter_input(INPUT_POST,'nome', FILTER_DEFAULT);
    $cpf          = filter_input(INPUT_POST,'cpf', FILTER_DEFAULT);
    $razao_social = filter_input(INPUT_POST,'razao_social', FILTER_DEFAULT);
    $cnpj         = filter_input(INPUT_POST,'cnpj', FILTER_DEFAULT);
    $telefone     = filter_input(INPUT_POST,'telefone', FILTER_DEFAULT);
    $cep          = filter_input(INPUT_POST,'cep', FILTER_DEFAULT);
    $endereco     = filter_input(INPUT_POST,'endereco', FILTER_DEFAULT);
    $email        = filter_input(INPUT_POST,'email', FILTER_DEFAULT);

    session_start();
    $usuario = unserialize($_SESSION['usuario']);
    if($usuario instanceof PessoaFisica)
    {
        $usuario->setNome($nome);
        $usuario->setCpf($cpf);
    }
    else
    {
        $usuario->setRazao_social($razao_social);
        $usuario->setCnpj($cnpj);
    }
    $usuario->setTelefone($telefone);
    $usuario->setCep($cep);
    $usuario->setEndereco($endereco);
    $usuario->setEmail($email);
    

    $usuarioDAO ->alterar($usuario);
    
    if($usuario->getEhProvedor() == 0)
    {
        echo "<script>window.location.replace('".DIRPAGE."/views/user/meuPerfil.php');</script>";
    }
    else
    {
       echo "<script>window.location.replace('".DIRPAGE."/views/manager/meuPerfil.php');</script>";
    }
?>