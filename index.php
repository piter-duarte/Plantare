<?php 
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
    $con= new Models\ModelConect;
    $con->conectDB();
?>
<header class="mdc-top-app-bar">
  <div class="mdc-top-app-bar__row">
    <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
      <span class="mdc-top-app-bar__title"><img class="img-logo" src="./lib/img/logo2.png" height="50px"></span>
    </section>
    <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
    <button class="mdc-button mdc-button--raised cadastrar">
        <span class="mdc-button__label"><a href="./views/cadastro.php">Cadastrar</a></span>
    </button>
    <button class="mdc-button mdc-button--raised logar">
        <span class="mdc-button__label"><a href="./views/login.php">Logar</a></span>
    </button>
    </section>
  </div>
</header>

<div class="index-img-container">
        <h1>imagem</h1>
</div>

<div class="container-bottom">
    <div class="bottom-footer"></div>
</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>
