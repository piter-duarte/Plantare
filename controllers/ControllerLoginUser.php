<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
$email=filter_input(INPUT_POST,'email', FILTER_DEFAULT);
$senha=filter_input(INPUT_POST,'senha', FILTER_DEFAULT);

$objEvents->logarUsuario(
    $email,
    $senha
);
if($_SESSION["ehProvedor"] == 1)
{
    echo"<script>window.location.replace('http://localhost/Curso/views/manager/index.php');</script>";
}
else
{
    echo"<script>window.location.replace('http://localhost/Curso/views/user/index.php');</script>";
}
?>