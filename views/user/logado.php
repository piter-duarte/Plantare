<?php include("../../config/config.php"); ?>
<?php include(DIRREQ."/lib/html/header.php"); ?>

<h1> Olá <?php echo $_SESSION["nome"]." com id= ".$_SESSION["id_cliente"];?></h1>
    <div class="calendarUser"></div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>
