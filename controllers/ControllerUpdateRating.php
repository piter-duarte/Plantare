<?php
include ("../config/config.php");
$objEvents = new \Classes\ClassEvents();
$id        =filter_input(INPUT_POST,'id', FILTER_DEFAULT);
$avaliacao =filter_input(INPUT_POST,'avaliacao', FILTER_DEFAULT);

$avaliacao = (int)$avaliacao;

$objEvents->updateRating(
    $id,
    $avaliacao
);

echo "<script>window.location.replace('http://localhost/Curso/views/user/index.php');</script>";