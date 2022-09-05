<?php
include ("../config/config.php");
$objEvents  = new \Classes\ClassEvents();
$name       = filter_input(INPUT_POST,'name', FILTER_DEFAULT);
$username   = filter_input(INPUT_POST,'username', FILTER_DEFAULT);
$password   = filter_input(INPUT_POST,'password', FILTER_DEFAULT);
$email      = filter_input(INPUT_POST,'e-mail', FILTER_DEFAULT);
$telefone   = filter_input(INPUT_POST,'telefone', FILTER_DEFAULT);
$cep        = filter_input(INPUT_POST,'cep', FILTER_DEFAULT);
$endereco   = filter_input(INPUT_POST,'endereco', FILTER_DEFAULT);

     $ehProvedor=0;
     if(isset($_POST["ehProvedor"])) 
     {
        $ehProvedor=1;
     }



$objEvents->createUser(
    0,
    $name,
    $username,
    $password,
    $email,
    $telefone,
    $cep,
    $endereco,
    $ehProvedor
);
?>
<script>window.location.replace("http://localhost/Curso/views/user/logado.php");</script>