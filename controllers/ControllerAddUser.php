<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
$name=filter_input(INPUT_POST,'name', FILTER_DEFAULT);
$username=filter_input(INPUT_POST,'username', FILTER_DEFAULT);
$password=filter_input(INPUT_POST,'password', FILTER_DEFAULT);

$objEvents->createUser(
    0,
    $name,
    $username,
    $password
);
?>
<script>window.location.replace("http://localhost/Curso/views/user/logado.php");</script>