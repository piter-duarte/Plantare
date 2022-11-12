<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    include(DIRREQ."/lib/includes/funcoes.php");
    session_start();
?>


<div class="container">
    <?php 
        chamarHeader('Logado');
    ?>
    <main class="logado">
        <?php
            chamarNavbar($_SESSION["nome"]);
        ?>
        <div class="conteudo">
            <div class="calendarUser"></div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>