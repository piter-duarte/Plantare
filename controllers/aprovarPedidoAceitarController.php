<?php
include ("../config/config.php");
$eventoDAO = new \Classes\EventoDAO();
$id  = filter_input(INPUT_POST,'idEvento', FILTER_DEFAULT);

$eventoDAO->alterarStatus($id, 'green');

echo "<script>window.location.replace('".DIRPAGE."/views/manager/meuCalendario.php');</script>";