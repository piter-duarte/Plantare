<?php
include ("../config/config.php");
session_start();
$relacaoDAO     = new \Classes\RelacaoDAO();
$usuarioDAO = new \Classes\UsuarioDAO();

$precoGrama         = filter_input(INPUT_POST,'precoGrama', FILTER_DEFAULT);
$precoPoda          = filter_input(INPUT_POST,'precoPoda', FILTER_DEFAULT);
$precoFertilizante  = filter_input(INPUT_POST,'precoFertilizante', FILTER_DEFAULT);
$precoPesticida     = filter_input(INPUT_POST,'precoPesticida', FILTER_DEFAULT);

$usuario = unserialize($_SESSION['usuario']);
$email = $usuario->getEmail();


if (!empty($_POST["servico"])) 
{
    //TODO adicionar variável de sessão 
    //para reconhecer se já um usuário cadastro que quer se tornar prestador de serviço
    $usuarioCadastrado = $_SESSION['usuarioCadastrado'];
    if($usuarioCadastrado == false)
    {
        $usuarioDAO->inserir($usuario);
    }
    else
    {
        $usuario->setEhProvedor(1);
        $usuarioDAO->virarProvedor($usuario);
        $_SESSION['usuario'] = serialize($usuario);
    }

    if(in_array('Cortar Grama',$_POST["servico"]))
    {
        
        $relacaoDAO->inserir($email, 1, $precoGrama);
    }
    else
    {
        $relacaoDAO->inserir($email, 1, 0.0);  
    }

    if(in_array('Realizar Poda',$_POST["servico"]))
    {
        $relacaoDAO->inserir($email, 2, $precoPoda);
    }
    else
    {
        $relacaoDAO->inserir($email, 2, 0.0);  
    }

    if(in_array('Aplicar Fertilizante',$_POST["servico"]))
    {
        $relacaoDAO->inserir($email, 3, $precoFertilizante);
    }
    else
    {
        $relacaoDAO->inserir($email, 3, 0.0);  
    }

    if(in_array('Aplicar Pesticida',$_POST["servico"]))
    {
        $relacaoDAO->inserir($email, 4, $precoPesticida);
    }
    else
    {
        $relacaoDAO->inserir($email, 4, 0.0);  
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
