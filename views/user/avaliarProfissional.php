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
            chamarNavbar($_SESSION["nome"]);
        ?>
        <div class="conteudo avaliarProfissional">
            <div class="contendmiddle">

                <div class="titleAvaliar">
                    <h3>Avaliar prestador de Serviço</h3>
                </div>

                <div class="fotoUser">
                    <!-- <img id="img-user" src="'.DIRPAGE.'./../lib/img/userImage.png" alt=""> -->
                    <img id="img-user" src="../../lib/img/userImage.png" alt="">
                </div>

                <div class="avaliar">
                    <img id="img-user" src="../../lib/img/userImage.png" alt="">
                    <h5>'.$usuario.'</h5>
                    <!-- <div class="stars">
                        <i class="fa-solid fa-star fa-sm"></i>
                        <i class="fa-solid fa-star fa-sm"></i>
                        <i class="fa-solid fa-star fa-sm"></i>
                        <i class="fa-solid fa-star fa-sm"></i>
                        <i class="fa-solid fa-star fa-sm"></i>
                    </div>-->
                </div>
                <div class="btnAvaliar">
                <input class="btg" type="button" value="Avaliar">
                </div>
            </div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>