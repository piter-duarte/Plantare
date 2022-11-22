<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");
?>


<div class="container">
    <?php 
        chamarHeader('Novo Pedido');
    ?>
    <main class="logadoPage">
        <?php
       chamarNavbar($_SESSION["nome"], $_SESSION["razao_social"], $_SESSION["media"], $_SESSION["ehProvedor"]);
        ?>
        <div class="conteudo">
        <a href="<?php echo DIRPAGE.'/views/user/novoPedido.php' ?>"><button>Fazer Pedidos</button></a>
        <div class="calendarManager"></div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>