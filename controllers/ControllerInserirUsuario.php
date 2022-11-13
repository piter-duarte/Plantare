<?php
include ("../config/config.php");
$objBDD       = new \Classes\ClassBDD();

$nome         = filter_input(INPUT_POST,'nome', FILTER_DEFAULT);
$razao_social = filter_input(INPUT_POST,'razao_social', FILTER_DEFAULT);
$email        = filter_input(INPUT_POST,'email', FILTER_DEFAULT);
$senha        = filter_input(INPUT_POST,'senha', FILTER_DEFAULT);

$ehProvedor   = 0;
if(isset($_POST["ehProvedor"])) 
{
    $ehProvedor=1;
}

$ehJuridica   = filter_input(INPUT_POST,'tipo_pessoa', FILTER_DEFAULT);
if($ehJuridica == 0)
{
    $objBDD->inserirUsuario(
        $nome,
        null,
        null,
        null,
        null,
        null,
        null,
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
        null,
        null,
        null,
        null,
        $ehJuridica,
        $ehProvedor,
        null,
        $email,
        $senha
    );
}

if ($ehProvedor == 0) 
{
   echo "<script>window.location.replace('".DIRPAGE."/views/user/novoPedido.php');</script>";
}
else
{
    echo "<script>window.location.replace('".DIRPAGE."/views/manager/continuacaoCadastro.php');</script>";
}