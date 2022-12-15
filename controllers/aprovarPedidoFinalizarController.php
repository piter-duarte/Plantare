<?php
include ("../config/config.php");
$eventoDAO = new \Models\DAO\EventoDAO();
$id     = filter_input(INPUT_POST,'idEvento', FILTER_DEFAULT);
$start  = filter_input(INPUT_POST,'start', FILTER_DEFAULT);
$end    = filter_input(INPUT_POST,'end', FILTER_DEFAULT);


$eventoDAO->alterarStatus('green', 'Finalizado', $id, $start, $end);

echo "<script>window.location.replace('".DIRPAGE."/views/manager/meuCalendario.php');</script>";