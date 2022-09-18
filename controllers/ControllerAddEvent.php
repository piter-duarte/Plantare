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
$client_key=$_SESSION["client_key"];
$provider_key=filter_input(INPUT_POST,'provider_key', FILTER_DEFAULT);

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
            $client_key,
            $provider_key
        ); 
        $i++;
    }while($i < $horasAtendimento);

echo "<script>window.location.replace('".DIRPAGE."/views/user/index.php');</script>";