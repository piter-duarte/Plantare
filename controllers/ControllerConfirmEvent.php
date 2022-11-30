<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
$idEvento  = filter_input(INPUT_POST,'idEvento', FILTER_DEFAULT);

$objEvents->updateEvent(
    $idEvento,
    'green'
);

echo "<script>window.location.replace('".DIRPAGE."/views/manager/meuCalendario.php');</script>";