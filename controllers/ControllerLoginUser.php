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
    echo "<script>window.location.replace('".DIRPAGE."/views/user/index.php');</script>";
}
else
{
    echo "<script>window.location.replace('".DIRPAGE."/views/manager/index.php');</script>";
}
?>