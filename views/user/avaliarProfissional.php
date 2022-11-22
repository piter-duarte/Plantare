<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");
?>


<div class="container">
    <?php 
        chamarHeader('Avaliar Profissional');
    ?>
    <main class="logadoPage">
        <?php
        chamarNavbar($_SESSION["nome"], $_SESSION["razao_social"], $_SESSION["media"], $_SESSION["ehProvedor"]);
        ?>
        <div class="conteudo avaliarProfissional">
            <div class="contendmiddle">
                <form name="formAdd" id="formAdd" method="post">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="provider_key" value="<?php echo $_GET['provider_key']; ?>">

                    <div class="titleAvaliar">
                        <h3>Avaliar prestador de Serviço</h3>
                    </div>

                    <div class="fotoUser">
                        <img id="img-user" src="../../lib/img/userImage.png" alt="">
                    </div>

                    <div class="avaliar">
                        <?php 
                            echo "<h5>".$_GET['provider_key']."</h5>";
                        ?>
                        <select name="avaliacao">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="btnAvaliar">
                        <input class="btm bts" type="submit" value="Cancelar"
                            formaction="<?php echo DIRPAGE.'/views/user/novoPedido.php'; ?>">
                        <input class="btm" type="submit" value="Avaliar"
                            formaction="<?php echo DIRPAGE.'/controllers/ControllerUpdateRating.php'; ?>">
                    </div>
                </form>
            </div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>