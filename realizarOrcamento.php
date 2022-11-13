<?php 
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
    include(DIRREQ."/lib/includes/funcoes.php");

?>


<div class="container">
    <?php 
        chamarHeader('Status dos Pedidos');
    ?>
    <main class="logadoPage">
        <?php
            chamarNavbar('Pagina em Desenvolvimento do Bruno');
        ?>
        <div class="conteudo realizarOrcamento">
            <div class="space80">     
                    <div class="containerform">
                        <input type="text">
                        <input type="text">
                        <input type="text">
                        <input type="text">
                        <input type="text">
                        <input type="button">
                    </div>
            </div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>