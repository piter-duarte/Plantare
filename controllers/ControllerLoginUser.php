<?php
include ("../config/config.php");
$objEvents= new \Classes\ClassEvents();
$username=filter_input(INPUT_POST,'username', FILTER_DEFAULT);
$password=filter_input(INPUT_POST,'password', FILTER_DEFAULT);

$objEvents->loginUser(
    $username,
    $password
);
if($_SESSION["ehProvedor"] == 1)
{
    echo"<script>window.location.replace('http://localhost/Curso/views/manager/index.php');</script>";
}
else
{
    echo"<script>window.location.replace('http://localhost/Curso/views/user/index.php');</script>";
}
?>