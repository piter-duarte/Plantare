<?php 
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
    $con= new \Models\ModelConect;
    $con->conectDB();
?>

<div class="container-top">
    <p>'</p>
</div>



<div class="container-mid">
    <div class="container-mid-left">
        <div class="container-mid-child1">
           <p></p>
        </div>
        <div class="container-mid-child2">
            <a href="./views/cadastro.php">Cadastre-se</a> <br> <br>
        </div>
        <div class="container-mid-child3">
            <a href="./views/login.php">Logar</a>
        </div>
    </div>
    <div class="container-mid-right">
        <p>'</p>
    </div>
</div>

<div class="container-bottom">
<div class="container-bottom-child1">
            <p>'</p>
        </div>
</div>






<?php include("./lib/html/footer.php"); ?>
