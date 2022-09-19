<?php
    include("../../config/config.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/html/header.php");
?>
<a href="<?php echo DIRPAGE.'/views/user/index.php' ?>"><button>Fazer Pedidos</button></a>
    <div class="calendarManager"></div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>