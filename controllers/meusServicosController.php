<?php
include ("../config/config.php");
$relacaoDAO = new \Models\DAO\RelacaoDAO();
session_start();
$usuario = unserialize($_SESSION['usuario']);
   
    $precoGrama         = filter_input(INPUT_POST,'precoGrama', FILTER_DEFAULT);
    $precoPoda          = filter_input(INPUT_POST,'precoPoda', FILTER_DEFAULT);
    $precoPesticida     = filter_input(INPUT_POST,'precoPesticida', FILTER_DEFAULT);
    $precoFertilizante  = filter_input(INPUT_POST,'precoFertilizante', FILTER_DEFAULT);


    $relacaoDAO->alterar($precoGrama, $usuario, 1);
    $relacaoDAO->alterar($precoPoda, $usuario, 2);
    $relacaoDAO->alterar($precoPesticida, $usuario, 3);
    $relacaoDAO->alterar($precoFertilizante, $usuario, 4);
    

    echo "<script>window.location.replace('".DIRPAGE."/views/manager/meusServicos.php');</script>";
?>