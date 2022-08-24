<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
$date=filter_input(INPUT_POST,'date', FILTER_DEFAULT);
$time=filter_input(INPUT_POST,'time', FILTER_DEFAULT);
$title=filter_input(INPUT_POST,'title', FILTER_DEFAULT);
$description=filter_input(INPUT_POST,'description', FILTER_DEFAULT);
$horasAtendimento=filter_input(INPUT_POST,'horasAtendimento', FILTER_DEFAULT);
$start=new \DateTime($date.' '.$time, new \DateTimeZone('America/Sao_Paulo'));
session_start();
$client_id=$_SESSION["id_cliente"];

$objEvents->createEvent(
    0,
    $title,
    $description,
    'blue',
    $start->format("Y-m-d H:i:s"),
    $start->modify('+'.$horasAtendimento.'hours')->format("Y-m-d H:i:s"),
    $client_id
);
?>
<script>window.location.replace("http://localhost/Curso/views/user/logado.php");</script>