<?php
include ("../config/config.php");
$eventoDAO = new \Models\DAO\EventoDAO();
$usuarioDAO = new \Models\DAO\UsuarioDAO();

$id            = filter_input(INPUT_POST,'id', FILTER_DEFAULT);
$avaliacao     = filter_input(INPUT_POST,'avaliacao', FILTER_DEFAULT);
$provedorEmail = filter_input(INPUT_POST,'provedorEmail', FILTER_DEFAULT);

$status = 'Avaliado';

$eventoDAO->alterarAvaliacao($status, $avaliacao, $id);

$usuarioDAO->alterarMedia($provedorEmail);

echo "<script>window.location.replace('".DIRPAGE."/views/user/meuCalendario.php');</script>";