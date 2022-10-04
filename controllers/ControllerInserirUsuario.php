<?php
include ("../config/config.php");
$objBDD       = new \Classes\ClassBDD();

$nome         = filter_input(INPUT_POST,'nome', FILTER_DEFAULT);
$cpf          = filter_input(INPUT_POST,'cpf', FILTER_DEFAULT);
$razao_social = filter_input(INPUT_POST,'razao_social', FILTER_DEFAULT);
$cnpj         = filter_input(INPUT_POST,'cnpj', FILTER_DEFAULT);
$ehJuridica   = filter_input(INPUT_POST,'tipo_pessoa', FILTER_DEFAULT);
$telefone     = filter_input(INPUT_POST,'telefone', FILTER_DEFAULT);
$cep          = filter_input(INPUT_POST,'cep', FILTER_DEFAULT);
$endereco     = filter_input(INPUT_POST,'endereco', FILTER_DEFAULT);
$ehProvedor   = 0;
if(isset($_POST["ehProvedor"])) 
{
    $ehProvedor=1;
}
$email      = filter_input(INPUT_POST,'email', FILTER_DEFAULT);
$senha      = filter_input(INPUT_POST,'senha', FILTER_DEFAULT);


if($ehJuridica == 0)
{
    $objBDD->inserirUsuario(
        $nome,
        $cpf,
        null,
        null,
        $telefone,
        $cep,
        $endereco,
        $ehJuridica,
        $ehProvedor,
        null,
        $email,
        $senha
    );
}
else
{
    $objBDD->inserirUsuario(
        null,
        null,
        $razao_social,
        $cnpj,
        $telefone,
        $cep,
        $endereco,
        $ehJuridica,
        $ehProvedor,
        null,
        $email,
        $senha
    );
}

if ($ehProvedor == 0) 
{
    echo "<script>window.location.replace('".DIRPAGE."/views/user/index.php');</script>";
}
else
{
    echo "<script>window.location.replace('".DIRPAGE."/views/manager/continuacaoCadastro.php');</script>";
}