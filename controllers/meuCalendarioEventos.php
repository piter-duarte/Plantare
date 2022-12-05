<?php
include ("../config/config.php");
$eventDAO = new \Classes\EventoDAO();
session_start();
$usuario = unserialize($_SESSION['usuario']);
echo $eventDAO->listarPorEmail($usuario); //busca por email