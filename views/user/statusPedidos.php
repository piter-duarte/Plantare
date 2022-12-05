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
       chamarNavbar($_SESSION["nome"], $_SESSION["razao_social"], $_SESSION["media"], $_SESSION["ehProvedor"]);
        ?>
        <div class="conteudo StatusPedido">
            <div class="contendmiddle">

                <div class="infoStatus">

                    <div class="titleStatus">
                        <h3>Status do Pedido</h3>
                    </div>

                    <div class="status">
                        <h4>Serviço: </h4> 
                        <h4>Solicitando:</h4>
                        <h4>Prestador:</h4>
                        <h4>Data:</h4>
                        <h4>Horário Inicio:</h4>
                        <h4>Horário Fim:</h4>
                        <h4>Status:</h4>
                    </div>

                    <form class="btnStatus" name="formStatusPedido" id="formStatusPedido" method="post">
                        <div>
                            <input class="btm" type="submit" value="Confirmar"
                                formaction="<?php echo DIRPAGE.'/controllers/ControllerUpdateRating.php'; ?>">
                            <input class="btm bts" type="submit" value="Cancelar"
                                formaction="<?php echo DIRPAGE.'/views/user/novoPedido.php'; ?>">
                        </div>
                        <input class="btm bts" type="submit" value="Voltar"
                            formaction="<?php echo DIRPAGE.'/views/user/meuCalendario.php'; ?>">
                    </form>

                </div>
            </div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>