<?php 
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
    $con= new Models\ModelConect;
    $con->conectDB();
?>



<div class="container-top">
<img class="img-logo" src="https://source.unsplash.com/random" width="75px" height="75px">
<button class="btn btn-1">Cadastrar</button>
<button class="btn">Logar</button>
</div>



<div class="container-mid">
    <div class="container-mid-left">
        <div class="container-mid-child1">
                
        </div>
        <div class="container-mid-child2">
            <button class="btn">
                <a href="./views/cadastro.php">Cadastre-se</a>
            </button>
        </div>
        <div class="container-mid-child3">
            <button class="btn">
                <a href="./views/login.php">Logar</a>
            </button>
        </div>
    </div>
    <div class="container-mid-right">
    <img class="img-logo-b" src="https://source.unsplash.com/random" width="216px" height="231px">
    <br>
    <h1>Estrelas</h1>
    </div>
</div>

<div class="container-bottom">

    <div class="container-bottom-child1">
    <p>'</p>
    </div>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>
