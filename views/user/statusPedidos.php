<?php
include("../../config/config.php");
include(DIRREQ."/lib/html/header.php");
require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
include(DIRREQ."/lib/includes/funcoes.php");

use Models\DAO\EventoDAO;
use Models\DAO\UsuarioDAO;
use Models\Domain\Evento;
use Models\Domain\PessoaFisica;

    $usuario = unserialize($_SESSION['usuario']);
    
    //objeto de conexão ao BD serve apenas para tabela usuário
    $usuarioDAO=new UsuarioDAO();
    $eventoDAO = new EventoDAO();

    //pegando o id passado no get com JS (linha: 86 || 113)
    $id = $_GET['id'];

    $evento = new Evento();
    $evento->setId($id);

    //buscando todos os dados do evento de acordo com o id
    //retorna o objeto montado com todos os dados do banco
    //esse método recebe como parâmetro o objeto evento
    $evento = $eventoDAO->buscar($evento);

    //objetos vinculados ao evento
    $cliente = $evento->getCliente();
    $prestador = $evento->getProvedor();
    $servico = $evento->getServico();

    $preco = $evento->getPrecoServico();

    $status = $evento->getStatus();

    //$start = $_GET['start'];
    //$end = $_GET['end'];
    $start = $evento->getStart();
    $end = $evento->getEnd();
   
    $timestamp = strtotime($end);
    $dataAtual = date("d/m/Y", $timestamp);

    $array1 = explode(" ", $start);
    $array2 = explode(" ", $end);

    $horaInicial = $array1[1];
    $horaFinal   = $array2[1];

    $horaInicial = explode(":", $horaInicial);
    $horaFinal =   explode(":", $horaFinal);
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
                    <h4>Serviço: <?php echo  $servico->getNome();?></h4>
                    <h4>Solicitante:
                        <?php 
                        if($cliente instanceof PessoaFisica)
                        {
                            echo $cliente->getNome();
                        }
                        else
                        {
                            echo $cliente->getRazao_social();
                        }
                        ?>
                    </h4>
                    <h4>Prestador:
                        <?php 
                        if($prestador instanceof PessoaFisica)
                        {
                            echo $prestador->getNome();
                        }
                        else
                        {
                            echo $prestador->getRazao_social();
                        }
                        ?>
                    </h4>
                    <h4>Data: <?php echo $dataAtual;?></h4>
                    <h4>Horário Inicio: <?php echo $horaInicial[0].':00';?></h4>
                    <h4>Horário Fim: <?php echo $horaFinal[0].':00';?></h4>
                    <h4>Status:
                        <?php 
                        if ($status == 'Avaliado')
                        {
                            echo "Avaliado";
                        }
                        else if($status == 'Finalizado')
                        {
                            echo "Finalizado";
                        }  
                        else if($status == 'Confirmado')
                        {
                            echo "Confirmado";
                        }        
                        else if($status == 'Pendente')
                        {
                            echo "Pendente";
                        }
                        else if($status == 'Cancelado')
                        {
                            echo "Cancelado";
                        }
                        ?>
                    </h4>
                    <h4>Valor: R$ <?php echo $preco?> </h4>
                </div>

                <form class="btnStatus usuario" name="formStatusPedido" id="formStatusPedido" method="post">
                    <input type="hidden" name="idEvento" value="<?php echo $evento->getId();?>">
                    <input type="hidden" name="start" value="<?php echo  $evento->getStart();?>">
                    <input type="hidden" name="end" value="<?php echo $evento->getEnd();?>">
                    <?php
                        if($evento->getStatus() == 'Avaliado')
                        {
                            echo "
                            <div class='avaliado'>
                                <input class='btm bts' type='submit' value='Voltar' formaction='" . DIRPAGE . "/views/user/meuCalendario.php'>
                            </div>
                            ";
                        }
                        else if ($evento->getStatus() == 'Finalizado')
                        {
                            echo 
                                "
                                    <div class='finalizado'>
                                        <input class='btm' type='submit' value='Avaliar' id='avaliar' formaction='".DIRPAGE."/views/user/avaliarProfissional.php?id=".$evento->getId()."&provedorEmail=".$prestador->getEmail()."'>                       
                                    </div>
                                    <input class='btm bts' type='submit' value='Voltar' formaction='".DIRPAGE."/views/user/meuCalendario.php'>  
                                ";
                        }
                        else if($evento->getStatus() == 'Confirmado') //se estiver confirmado não pode cancelar o evento
                        {
                            echo 
                                "
                                    <div class='confirmado'>                                                          
                                        <input class='btm bts' type='submit' value='Cancelar' id='cancelar' formaction='".DIRPAGE."/controllers/aprovarPedidoCancelarController.php'>
                                    </div>
                                    <input class='btm bts' type='submit' value='Voltar' formaction='".DIRPAGE."/views/user/meuCalendario.php'>  
                                ";            
                        }
                        else if ($evento->getStatus() == 'Cancelado')
                        {
                            echo "
                                <div class='cancelado'>
                                    <input class='btm bts' type='submit' value='Voltar' formaction='" . DIRPAGE . "/views/user/meuCalendario.php'>
                                </div>
                            ";
                        } 
                        else if ($evento->getStatus() == 'Pendente')
                        {
                            echo 
                                "
                                    <input class='btm bts' type='submit' value='Cancelar' id='cancelar'
                                        formaction='".DIRPAGE."/controllers/aprovarPedidoCancelarController.php'>
                                    <input class='btm bts' type='submit' value='Voltar' formaction='" . DIRPAGE . "/views/user/meuCalendario.php'>
                                "; 
                        }       
                        ?>
                </form>
            </div>
        </div>
    </main>
</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>