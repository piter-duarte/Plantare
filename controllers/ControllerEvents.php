<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
session_start();
$client_key=$_SESSION["client_key"];
echo $objEvents->getEventsByClientKey($client_key);