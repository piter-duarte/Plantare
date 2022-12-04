<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");

?>


<div class="container">
    <?php 
        chamarHeader('Status dos Pedidos');
    ?>
    <main class="logadoPage">
        <?php
            chamarNavbar($_SESSION["nome"]);
        ?>
        <div class="conteudo StatusPedido">
            <div class="contendmiddle">

                <form name="formStatusPedido" id="formStatusPedido" method="post">


                    <div class="titleStatus">
                        <h3>Status do Pedido</h3>
                    </div>

                    <div class="status">
                        <h5 >Serviço:</h5>
                        <h5 >Solicitando:</h5>
                        <h5 >Prestador:</h5>
                        <h5 >Data:</h5>
                        <h5 >Horário Inicio:</h5>
                        <h5 >Horário Fim:</h5>
                        <h5 >Status:</h5>
                    </div>

                    <div class="btnStatus">
                        <input class="btxg" type="submit" value="Cancelar Pedido"
                            formaction="<?php echo DIRPAGE.'/views/user/novoPedido.php'; ?>">
                        <input class="btm bts" type="submit" value="Confirmar"
                            formaction="<?php echo DIRPAGE.'/controllers/ControllerUpdateRating.php'; ?>">
                        <input class="btm bts" type="submit" value="Voltar"
                            formaction="<?php echo DIRPAGE.'/views/user/meuPerfil.php'; ?>">
                    </div>
                </form>
            </div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>