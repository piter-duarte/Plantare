<?php
include ("../config/config.php");
$objBDD     = new \Classes\ClassBDD();
$nome       = filter_input(INPUT_POST,'nome', FILTER_DEFAULT);
$telefone   = filter_input(INPUT_POST,'telefone', FILTER_DEFAULT);
$cep        = filter_input(INPUT_POST,'cep', FILTER_DEFAULT);
$endereco   = filter_input(INPUT_POST,'endereco', FILTER_DEFAULT);
$ehProvedor = 0;
if(isset($_POST["ehProvedor"])) 
{
    $ehProvedor=1;
}
$email      = filter_input(INPUT_POST,'email', FILTER_DEFAULT);
$senha      = filter_input(INPUT_POST,'senha', FILTER_DEFAULT);

$objBDD->inserirUsuario(
    $nome,
    $telefone,
    $cep,
    $endereco,
    $ehProvedor,
    $email,
    $senha
);

if ($ehProvedor ==0) {
    echo "<script>window.location.replace('".DIRPAGE."/views/user/index.php');</script>";
}
else
{
    echo "<script>window.location.replace('".DIRPAGE."/views/manager/continuacaoCadastro.php');</script>";
}