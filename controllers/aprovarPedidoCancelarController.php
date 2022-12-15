<?php
include ("../config/config.php");
$eventoDAO = new \Models\DAO\EventoDAO();
$id     = filter_input(INPUT_POST,'idEvento', FILTER_DEFAULT);
$start  = filter_input(INPUT_POST,'start', FILTER_DEFAULT);
$end    = filter_input(INPUT_POST,'end', FILTER_DEFAULT);


$eventoDAO->alterarStatus('red', 'Cancelado', $id, $start, $end);

session_start();
$usuario = unserialize($_SESSION["usuario"]);

if($usuario->getEhProvedor() == 1)
{
    echo "<script>window.location.replace('".DIRPAGE."/views/manager/meuCalendario.php');</script>";
}
else
{
    echo "<script>window.location.replace('".DIRPAGE."/views/user/meuCalendario.php');</script>";
}
