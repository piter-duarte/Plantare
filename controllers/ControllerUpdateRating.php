<?php
include ("../config/config.php");
$objEvents = new \Classes\ClassEvents();

$id            = filter_input(INPUT_POST,'id', FILTER_DEFAULT);
$avaliacao     = filter_input(INPUT_POST,'avaliacao', FILTER_DEFAULT);
$provedorEmail = filter_input(INPUT_POST,'provedorEmail', FILTER_DEFAULT);

$objEvents->updateRating(
    $id,
    $avaliacao,
    $provedorEmail
);

echo "<script>window.location.replace('".DIRPAGE."/views/user/meuCalendario.php');</script>";