<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
session_start();
$email=$_SESSION["email"];
echo $objEvents->getEventsEmail($email);