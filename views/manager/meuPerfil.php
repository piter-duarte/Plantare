<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    include(DIRREQ."/lib/includes/funcoes.php");
    session_start();
?>


<div class="container">
    <?php 
        chamarHeader('Meu Perfil');
    ?>
    <main class="logado">
        <?php
            chamarNavbar($_SESSION["nome"]);
        ?>
        <div class="conteudo"></div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>