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
                <form name="formAdd" id="formAdd" method="post">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="provider_key" value="<?php echo $_GET['provider_key']; ?>">

                    <div class="titleStatus">
                        <h3>Status do Serviço</h3>
                    </div>

                    <div class="status">
                                            
                        <h5>Pedido recusado.</h5><br>
                        <h5>Em rota de execução.</h5><br>
                        <h5>Pedido em análise.</h5>
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