<?php
include ("../config/config.php");

$email=filter_input(INPUT_POST,'email', FILTER_DEFAULT);
$senha=filter_input(INPUT_POST,'senha', FILTER_DEFAULT);

/*
    OBS: Aqui não se pode passar um objeto do tipo usuario,
    isto porque se trata de uma classa abstrata e, ainda 
    não temos como saber se é uma pessoa física ou jurídica
*/
$usuarioDAO= new \Models\DAO\UsuarioDAO();
$usuarioDAO->buscarPorEmailSenha($email, $senha); //busca o usuario no banco

$usuario = unserialize($_SESSION['usuario']);

if($usuario->getEhProvedor() == 0)
{
   echo "<script>window.location.replace('".DIRPAGE."/views/user/meuCalendario.php');</script>";
}
else
{
   echo "<script>window.location.replace('".DIRPAGE."/views/manager/meuCalendario.php');</script>";
}
?>