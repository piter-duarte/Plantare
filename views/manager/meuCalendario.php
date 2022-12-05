<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");
    $usuario = unserialize($_SESSION['usuario']);
?>


<div class="container">
    <?php 
        chamarHeader('Meu Calendário');
    ?>
    <main class="logadoPage">
        <?php
       chamarNavbar($usuario);
        ?>
        <div class="conteudo">
        <a href="<?php echo DIRPAGE.'/views/user/meuCalendario.php' ?>"><button>Fazer Pedidos</button></a>
        <div class="calendarManager"></div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>