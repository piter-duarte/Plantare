<?php
include ("../config/config.php");
$objBDD= new \Classes\ClassBDD();
$email=filter_input(INPUT_POST,'email', FILTER_DEFAULT);
$senha=filter_input(INPUT_POST,'senha', FILTER_DEFAULT);

$objBDD->logarUsuario(
    $email,
    $senha
);
if($_SESSION["ehProvedor"] == 0)
{
    echo "<script>window.location.replace('".DIRPAGE."/views/user/meuCalendario.php');</script>";
}
else
{
    echo "<script>window.location.replace('".DIRPAGE."/views/manager/meuCalendario.php');</script>";
}
?>