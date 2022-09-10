<?php 
    include("../../config/config.php");
    require_once "../../lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/html/header.php"); 
?>

<h1> Olá <?php echo $_SESSION["nome"]." com chave= ".$_SESSION["client_key"];?></h1>
    <div class="calendarUser"></div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>
