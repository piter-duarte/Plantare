<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
session_start();


$date=filter_input(INPUT_POST,'date', FILTER_DEFAULT); //data do evento
$time=filter_input(INPUT_POST,'time', FILTER_DEFAULT); //hora inicial
$horasAtendimento=filter_input(INPUT_POST,'horasAtendimento', FILTER_DEFAULT); //tempo de serviço

$start = new \DateTime($date.' '.$time, new \DateTimeZone('America/Sao_Paulo'));

$title        = filter_input(INPUT_POST,'title', FILTER_DEFAULT); //nome evento
$description  = filter_input(INPUT_POST,'description', FILTER_DEFAULT); //descrição evento

$clienteEmail   = $_SESSION["email"]; //email do solicitante de serviços
$provedorEmail = filter_input(INPUT_POST,'provider_key', FILTER_DEFAULT); //email do provedor escolhido
$idServico = $title;

    $i=0;
    do
    {
        $objEvents->createEvent(
            0,
            $title,
            $description,
            'blue',
            $start->format("Y-m-d H:i:s"),
            $start->modify('+'.'1'.'hours')->format("Y-m-d H:i:s"),
            null,
            $clienteEmail,
            $provedorEmail,
            $idServico
        ); 
        $i++;
    }while($i < $horasAtendimento);

echo "<script>window.location.replace('".DIRPAGE."/views/user/meuCalendario.php');</script>";