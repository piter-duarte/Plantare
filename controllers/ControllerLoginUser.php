<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
$username=filter_input(INPUT_POST,'username', FILTER_DEFAULT);
$password=filter_input(INPUT_POST,'password', FILTER_DEFAULT);

$objEvents->searchUser(
    $username,
    $password
);
?>
<script>window.location.replace("http://localhost/Curso/views/user/logado.php");</script>