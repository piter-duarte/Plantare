<?php
use Models\Servico;
include ("../config/config.php");
use Models\Evento;
$eventoDAO  = new \Classes\EventoDAO();
$servicoDAO = new \Classes\ServicoDAO();
$usuarioDAO = new \Classes\UsuarioDAO();
session_start();

//pegando os dados do formulário
$date=filter_input(INPUT_POST,'date', FILTER_DEFAULT); //data do evento
$time=filter_input(INPUT_POST,'time', FILTER_DEFAULT); //hora inicial
$horasAtendimento=filter_input(INPUT_POST,'horasAtendimento', FILTER_DEFAULT); //tempo de serviço

$start = new \DateTime($date.' '.$time, new \DateTimeZone('America/Sao_Paulo'));

$title        = filter_input(INPUT_POST,'title', FILTER_DEFAULT); //nome evento
$description  = filter_input(INPUT_POST,'description', FILTER_DEFAULT); //descrição evento

$cliente = unserialize($_SESSION['usuario']); //pega o objeto do usuário logado

$provedorEmail = filter_input(INPUT_POST,'provider_key', FILTER_DEFAULT); //email do provedor escolhido
$idServico = $title;
$precoServico = filter_input(INPUT_POST,'precoServico', FILTER_DEFAULT);

//TODO fazer calculo do preço final e adicionar ao evento

//passando para objetos e transferindo ao banco
$i=0;
do
{
    $evento = new Evento;
    $evento->setDescription($description);
    $evento->setColor('blue');
    $evento->setStart($start->format("Y-m-d H:i:s"));
    $evento->setEnd($start->modify('+'.'1'.'hours')->format("Y-m-d H:i:s"));
    $evento->setRating(null);
    //montando os objetos de usuario e de servico

    //objeto cliente (lembrar que sempre vai ser o usuário logado)
    $evento->setCliente($cliente);

    //objeto profissional
    $profissional = $usuarioDAO->buscarPorEmail($provedorEmail);
    $evento->setProvedor($profissional);

    //objeto serviço
    $servico = new Servico;
    $servico->setId($idServico);
    $servico = $servicoDAO->buscar($servico);
    $evento->setServico($servico);

    $evento->setTitle($servico->getNome());

    $evento->setPrecoServico($precoServico);

    $eventoDAO->inserir($evento);

    $i++;
}while($i < $horasAtendimento);

echo "<script>window.location.replace('".DIRPAGE."/views/user/meuCalendario.php');</script>";