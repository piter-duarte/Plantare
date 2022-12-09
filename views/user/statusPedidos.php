<?php

use Classes\UsuarioDAO;
use Models\PessoaFisica;

    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");
    $usuario = unserialize($_SESSION['usuario']);
    $servico=$_GET['title'];
    
    //objeto de conexão ao BD serve apenas para tabela usuário
    $usuarioDAO=new UsuarioDAO();

    $solicitante =$_GET['clienteEmail'];
    $clienteObjeto=$usuarioDAO->buscarPorEmail($solicitante);

    $prestador =$_GET['provedorEmail'];
    $prestadorObjeto=$usuarioDAO->buscarPorEmail($prestador);

    //$data=new \DateTime($_GET['data'], new \DateTimeZone('America/Sao_Paulo'));
    //$date=new \DateTime($_GET['date'], new \DateTimeZone('America/Sao_Paulo'));
    $preco = $_GET['preco'];

    $status = $_GET['status'];

    $start = $_GET['start'];
    $end = $_GET['end'];
   
    $timestamp = strtotime($end);
    $dataAtual = date("d/m/Y", $timestamp);

    $array1 = explode(" ", $start);
    $array2 = explode(" ", $end);

    $horaInicial = $array1[1];
    $horaFinal   = $array2[1];

    $horaInicial = explode(":", $horaInicial);
    $horaFinal =   explode(":", $horaFinal);

    $id = $_GET['id'];
    $provedorEmail = $_GET['provedorEmail'];

?>

<div class="container">
    <?php 
        chamarHeader('Status dos Pedidos');
    ?>
    <main class="logadoPage">
        <?php
       chamarNavbar($usuario);
        ?>
        <div class="conteudo StatusPedido">


            <div class="infoStatus">

                <div class="titleStatus">
                    <h3>Status do Pedido</h3>
                </div>

                <div class="status">
                    <h4>Serviço: <?php echo $servico?></h4>
                    <h4>Solicitante:
                        <?php 
                        if($clienteObjeto instanceof PessoaFisica)
                        {
                            echo $clienteObjeto->getNome();
                        }
                        else
                        {
                            echo $clienteObjeto->getRazao_social();
                        }
                        ?>
                    </h4>
                    <h4>Prestador:
                        <?php 
                        if($prestadorObjeto instanceof PessoaFisica)
                        {
                            echo $prestadorObjeto->getNome();
                        }
                        else
                        {
                            echo $prestadorObjeto->getRazao_social();
                        }
                        ?>
                    </h4>
                    <h4>Data: <?php echo $dataAtual;?></h4>
                    <h4>Horário Inicio: <?php echo $horaInicial[0].':00';?></h4>
                    <h4>Horário Fim: <?php echo $horaFinal[0].':00';?></h4>
                    <h4>Status:
                        <?php 
                        if($status == 'blue')
                        {
                            echo "Pendente";
                        }
                        else if($status == 'green')
                        {
                            echo "Confirmado";
                        }
                        else
                        {
                            echo "Cancelado";
                        }

                        ?>
                    </h4>
                    <h4>Valor: R$ <?php echo $preco?> </h4>
                </div>

                <form class="btnStatus usuario" name="formStatusPedido" id="formStatusPedido" method="post">
                    <input type="hidden" name="idEvento" value="<?php echo $_GET['id'];?>">
                    <input type="hidden" name="start" value="<?php echo $_GET['start'];?>">
                    <input type="hidden" name="end" value="<?php echo $_GET['end'];?>">
                    <div>
                        <input class="btm" type="submit" value="Avaliar" id="avaliar"
                            formaction="<?php echo DIRPAGE.'/views/user/avaliarProfissional.php?id='.$id.'&provedorEmail='.$provedorEmail; ?>">
                        <input class="btm bts" type="submit" value="Cancelar" id="cancelar"
                            formaction="<?php echo DIRPAGE.'/controllers/aprovarPedidoCancelarController.php'; ?>">
                        <input class="btm bts" type="submit" value="Voltar"
                            formaction="<?php echo DIRPAGE.'/views/user/meuCalendario.php'; ?>">
                    </div>

                </form>

            </div>

        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>