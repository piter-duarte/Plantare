<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    include(DIRREQ."/lib/includes/funcoes.php");
    session_start();
?>


<div class="container">
    <?php 
        chamarHeader('Novo Pedido');
    ?>
    <main class="logado">
        <?php
            chamarNavbar($_SESSION["nome"]);
        ?>
        <div class="conteudo">
        <a href="<?php echo DIRPAGE.'/views/user/index.php' ?>"><button>Fazer Pedidos</button></a>
        <div class="calendarManager"></div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>