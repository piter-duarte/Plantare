<?php
include ("../config/config.php");
session_start();
$relacaoDAO     = new \Classes\RelacaoDAO();

$precoGrama         = filter_input(INPUT_POST,'precoGrama', FILTER_DEFAULT);
$precoPoda          = filter_input(INPUT_POST,'precoPoda', FILTER_DEFAULT);
$precoFertilizante  = filter_input(INPUT_POST,'precoFertilizante', FILTER_DEFAULT);
$precoPesticida     = filter_input(INPUT_POST,'precoPesticida', FILTER_DEFAULT);

$usuario = unserialize($_SESSION['usuario']);
$email = $usuario->getEmail();

if (!empty($_POST["servico"])) 
{
    if(in_array('Cortar Grama',$_POST["servico"]))
    {
        
        $relacaoDAO->inserir($email, 1, $precoGrama);
    }

    if(in_array('Realizar Poda',$_POST["servico"]))
    {
        $relacaoDAO->inserir($email, 2, $precoPoda);
    }

    if(in_array('Aplicar Fertilizante',$_POST["servico"]))
    {
        $relacaoDAO->inserir($email, 3, $precoFertilizante);
    }

    if(in_array('Aplicar Pesticida',$_POST["servico"]))
    {
        $relacaoDAO->inserir($email, 4, $precoPesticida);
    }


}
else
{
    exit("<p style='width: 50%; border: 1px solid #777;
    padding: 20px; text-align: center; margin: 20px auto;'> Caro usuário, você precisar preencher ao menos um serviço. Tente novamente! <br> 
    <a href='../index.php' style='color: #000; text-align: center;'> Ir para a página principal </a>
    </p>");
}

echo "<script>window.location.replace('".DIRPAGE."/views/manager/meuCalendario.php');</script>";
