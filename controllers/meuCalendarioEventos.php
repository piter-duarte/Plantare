<?php
include ("../config/config.php");
$eventDAO = new \Models\DAO\EventoDAO();
session_start();
$usuario = unserialize($_SESSION['usuario']);
echo $eventDAO->listarPorEmail($usuario); //busca por email