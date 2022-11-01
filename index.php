<?php 
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
    $con= new Models\ModelConect;
    $con->conectDB();
?>
<div class="container">

  <header>
        <div class="logo">
          <img class="img-logo" src="./lib/img/LogoAlterada.png">
          <h6>Plantare</h6>
        </div>
        <div class="btns">
          <a class="button-main" href="./views/cadastro.php">
            <h6>CONECTE-SE</h6>
          </a>
          <a class="button-secondary" href="./views/login.php">
            <h6>LOGIN</h6>
          </a>
        </div>       
  </header>

  <main>
    <h2 class="hero">Facilitando a sua conexão com a natureza</h2>
    <div class="slider">
          <div class="slides">
              <!--Radio Buttons-->
              <input type="radio" name="radio-btn" id="radio1">
              <input type="radio" name="radio-btn" id="radio2" checked>
              <input type="radio" name="radio-btn" id="radio3">
              <!--fim Radio Buttons-->

              <!--Slide images-->
              <div class="slide first">
                <img src="./lib/img/image1.png" alt="imagem 1">
              </div>

              <div class="slide">
                <img src="./lib/img/image2.png" alt="imagem 2">
              </div>

              <div class="slide">
                <img src="./lib/img/image3.png" alt="imagem 3">
              </div>
              <!--fim Slide images-->

              <!--Navigation auto-->
              <div class="navigation-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
              </div>
          </div>

          <div class="manual-navigation">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
          </div>
      </div>
  
    <div class="qsomos">
      <h3>QUEM<br>SOMOS</h3>
      <p>Somos uma plataforma focada no ramo de jardinagem, promovendo um espaço para a busca e contratação de profissionais do ramo</p>
    </div>
    
    <div class="nservicos">
      <h2>NOSSOS<br>SERVIÇOS</h2>
      <img class="nservicosimg" src="./lib/img/nservicosimg.png" alt="nservicosimg">
      <div class="servicos">
        <div class="servicosgrid" id="servico1">
            <img src="./lib/img/Grama.png" alt="algo">
            <p>Cortar Grama</p>
        </div>
        <div class="servicosgrid" id="servico2">
        <img src="./lib/img/Poda.png" alt="algo">
            <p>Realizar Poda</p>
        </div>
        <div class="servicosgrid" id="servico3">
            <img src="./lib/img/Fertiliza.png" alt="algo">
            <p>Aplicar Fertilizante</p>
        </div>
        <div class="servicosgrid" id="servico4">
            <img src="./lib/img/Pesticida.png" alt="algo">
            <p>Aplicar Pesticida</p>
        </div>
      </div>
    </div>

  <div class="nprofissionais">

  </div>

    </main>

</div>


<?php include(DIRREQ."/lib/html/footer.php"); ?>
