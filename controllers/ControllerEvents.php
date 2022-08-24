<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
session_start();
$client_id=$_SESSION["id_cliente"];
echo $objEvents->getEventsByClientId($client_id);