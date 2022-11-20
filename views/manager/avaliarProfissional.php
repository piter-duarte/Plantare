<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");
    $nome = $_SESSION["nome"];
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
                <div class="contentbody">

                    <div class="titleAvaliar">
                        <h3>Avaliar prestador de Serviço</h3>
                    </div>

                    <div class="fotoUser">
                         <img id="img-user" src="../../lib/img/userImage.png" alt=""> 
                    </div>
                    <div class="avaliar">
                        <h5>Usuario</h5>
                        <div class="stars">
                            <i class="fa-solid fa-star fa-sm starEmpty"></i>
                            <i class="fa-solid fa-star fa-sm starEmpty"></i>
                            <i class="fa-solid fa-star fa-sm starEmpty"></i>
                            <i class="fa-solid fa-star fa-sm starEmpty"></i>
                            <i class="fa-solid fa-star fa-sm starEmpty"></i>
                        </div>
                    </div>

                    <div class="btnAvaliar">
                        <input class="btg" type="button" value="Avaliar">
                    </div>
                </div>

            </div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>