<?php
include ("../config/config.php");
$objBDD       = new \Classes\ClassBDD();
   
    $nome         = filter_input(INPUT_POST,'nome', FILTER_DEFAULT);
    $cpf          = filter_input(INPUT_POST,'cpf', FILTER_DEFAULT);
    $razao_social = filter_input(INPUT_POST,'razao_social', FILTER_DEFAULT);
    $cnpj         = filter_input(INPUT_POST,'cnpj', FILTER_DEFAULT);
    $telefone     = filter_input(INPUT_POST,'telefone', FILTER_DEFAULT);
    $cep          = filter_input(INPUT_POST,'cep', FILTER_DEFAULT);
    $endereco     = filter_input(INPUT_POST,'endereco', FILTER_DEFAULT);
    $email        = filter_input(INPUT_POST,'email', FILTER_DEFAULT);

    $objBDD ->updateUser($nome, $cpf, $razao_social, $cnpj, $telefone, $cep, $endereco, $email);
    
    if($_SESSION["ehProvedor"] == 0)
    {
        echo "<script>window.location.replace('".DIRPAGE."/views/user/meuPerfil.php');</script>";
    }
    else
    {
        echo "<script>window.location.replace('".DIRPAGE."/views/manager/meuPerfil.php');</script>";
    }
?>