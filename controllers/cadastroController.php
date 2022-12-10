<?php
use Models\PessoaFisica;
use Models\PessoaJuridica;

include ("../config/config.php");
$usuarioDAO       = new \Classes\UsuarioDAO();

$nome         = filter_input(INPUT_POST,'nome', FILTER_DEFAULT);
$razao_social = filter_input(INPUT_POST,'razao_social', FILTER_DEFAULT);
$email        = filter_input(INPUT_POST,'email', FILTER_DEFAULT);
$senha        = filter_input(INPUT_POST,'senha', FILTER_DEFAULT);
$ehProvedor   = 0;
if(isset($_POST["ehProvedor"])) 
{
    $ehProvedor=1;
}
$ehJuridica   = filter_input(INPUT_POST,'tipo_pessoa', FILTER_DEFAULT);


if($ehJuridica == 0)
{
    $usuario = new PessoaFisica;

    $usuario->setNome($nome);
    $usuario->setEmail($email);
    $usuario->setSenha($senha);
    $usuario->setEhJuridica($ehJuridica);
    $usuario->setEhProvedor($ehProvedor);
    $usuario->setMedia(5);
}
else
{
    $usuario = new PessoaJuridica;

    $usuario->setRazao_social($razao_social);
    $usuario->setEmail($email);
    $usuario->setSenha($senha);
    $usuario->setEhJuridica($ehJuridica);
    $usuario->setEhProvedor($ehProvedor);
    $usuario->setMedia(5);
}

if ($ehProvedor == 0) 
{
    $usuarioDAO->inserir($usuario);
    echo "<script>window.location.replace('".DIRPAGE."/views/user/meuCalendario.php');</script>";
}
else
{
    session_start();
    //se o usuário estiver realizando o cadastro cria a sessão usuario
    $_SESSION['usuario'] = serialize($usuario);

    $_SESSION['usuarioCadastrado'] = false;
    echo "<script>window.location.replace('".DIRPAGE."/views/manager/continuacaoCadastro.php');</script>";
}