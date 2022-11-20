<?php
include ("../config/config.php");
$objEvents = new \Classes\ClassEvents();
$id        =filter_input(INPUT_POST,'id', FILTER_DEFAULT);
$avaliacao =filter_input(INPUT_POST,'avaliacao', FILTER_DEFAULT);
$provider_key        =filter_input(INPUT_POST,'provider_key', FILTER_DEFAULT);

$objEvents->updateRating(
    $id,
    $avaliacao,
    $provider_key
);

// echo "<script>window.location.replace('".DIRPAGE."/views/user/novoPedido.php');</script>";