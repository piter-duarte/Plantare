<?php
include ("../config/config.php");
$eventoDAO = new \Classes\EventoDAO();
$id     = filter_input(INPUT_POST,'idEvento', FILTER_DEFAULT);
$start  = filter_input(INPUT_POST,'start', FILTER_DEFAULT);
$end    = filter_input(INPUT_POST,'end', FILTER_DEFAULT);


$eventoDAO->alterarStatus('green', 'Confirmado', $id, $start, $end);

echo "<script>window.location.replace('".DIRPAGE."/views/manager/meuCalendario.php');</script>";