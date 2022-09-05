<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
session_start();
$client_id=$_SESSION["client_id"];
echo $objEvents->getEventsByClientId($client_id);