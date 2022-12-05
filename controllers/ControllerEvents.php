<?php
include ("../config/config.php");
$eventDAO = new \Classes\EventDAO();
session_start();
$usuario = unserialize($_SESSION['usuario']);
echo $eventDAO->buscar($usuario); //busca por email