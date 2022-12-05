<?php
include ("../config/config.php");
$eventDAO = new \Classes\EventDAO();
$usuarioDAO = new \Classes\UsuarioDAO();

$id            = filter_input(INPUT_POST,'id', FILTER_DEFAULT);
$avaliacao     = filter_input(INPUT_POST,'avaliacao', FILTER_DEFAULT);
$provedorEmail = filter_input(INPUT_POST,'provedorEmail', FILTER_DEFAULT);


$eventDAO->alterarNota($avaliacao,$id);

$usuarioDAO->alterarMedia($provedorEmail);

echo "<script>window.location.replace('".DIRPAGE."/views/user/meuCalendario.php');</script>";