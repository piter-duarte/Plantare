<?php 
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
    $con= new Models\ModelConect;
    $con->conectDB();
?>

<div class="container-top">
    <img class="img-logo" src="./lib/img/logo2.png">
    
    <button class="container-top btn" id="tpCadastrar"><a href="./views/cadastro.php">Cadastrar</a></button>
    <button class="container-top btn" id="tpLogar"><a href="./views/login.php">Logar</a></button>
</div>



<div class="container-mid">
    <div class="container-mid-espaco1"></div>
    <div class="container-mid-espaco2"></div>
</div>

<div class="container-bottom">
    <div class="bottom-footer"></div>
</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>
