<?php
include ("../config/config.php");
$eventoDAO = new \Classes\EventoDAO();
$usuarioDAO = new \Classes\UsuarioDAO();

$id            = filter_input(INPUT_POST,'id', FILTER_DEFAULT);
$avaliacao     = filter_input(INPUT_POST,'avaliacao', FILTER_DEFAULT);
$provedorEmail = filter_input(INPUT_POST,'provedorEmail', FILTER_DEFAULT);


$eventoDAO->alterarNota($avaliacao,$id);

$usuarioDAO->alterarMedia($provedorEmail);

echo "<script>window.location.replace('".DIRPAGE."/views/user/meuCalendario.php');</script>";