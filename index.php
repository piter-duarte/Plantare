<?php 
use Models\Database;
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
    $con= new Models\Database;

    if($con->verificarSeExiste() == false)
    {
        $con->createDB();
    }

    session_start();
    //o código abaixo remove tudo das variáveis de sessão e cookies do sistema 
    $_SESSION = array();
    session_destroy();
    if (isset($_COOKIE['id'])) {
        unset($_COOKIE['id']);
        setcookie('id', '', time() - 3600, '/'); // remove o cookie id
    }
    if (isset($_COOKIE['hora'])) {
        unset($_COOKIE['hora']);
        setcookie('hora', '', time() - 3600, '/'); // remove o cookie hora
    }
    if (isset($_COOKIE['email'])) {
        unset($_COOKIE['email']);
        setcookie('email', '', time() - 3600, '/'); // remove o cookie email
    }
?>
<div class="container">

    <header>
        <div class="logo">
            <a class="img-logo" href="assets.php">
                <img class="img-logo" src="./lib/img/LogoAlterada.png">
            </a>
            <h5>Plantare</h5>
        </div>
        <div class="btns">
            <a href="./views/cadastro.php"> <button class="btg">CONECTE-SE</button></a>
            <a href="./views/login.php"><button class="btm bts">LOGIN</button></a>

        </div>
    </header>

    <main class="index">
        <div class="heroarea" id="heroarea">
            <div class="heroradios">
                <input type="radio" name="slide" id="radio1">
                <input type="radio" name="slide" id="radio2" checked>
                <input type="radio" name="slide" id="radio3">
            </div>
            <h1>Facilitando a sua conexão<br>com a natureza</h1>
            <h4>Encontre os melhores profissionais da<br>jardinagem</h4>
            <div class="btcontainer">
            <a href="./views/cadastro.php"><button class="btg">CONECTE-SE</button></a>
            </div>
        </div>

        <div class="qsomos">
            <h2>QUEM<br>SOMOS</h2>
            <p>Somos uma plataforma focada no ramo de jardinagem, promovendo um espaço para a busca e contratação de
                profissionais do ramo</p>
        </div>

        <div class="nservicos">

            <h1>NOSSOS<br>SERVIÇOS</h1>

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
            <div class="main">
                <h2>NOSSOS<br>PROFISSIONAIS</h2>

                <div class="profissionais">
                    <div id="p1">
                        <img src="./lib/img/profissional1.png" alt="algo">
                        <div id="p1info">
                            <h4>Kristin Watson</h4>
                            <img src="./lib/img/profissionalestrelas4.png" alt="">
                        </div>
                    </div>
                    <div id="p2">
                        <img src="./lib/img/profissional2.png" alt="algo">
                        <div id="p2info">
                            <h4>Theresa Webb</h4>
                            <img src="./lib/img/profissionalestrelas5.png">
                        </div>
                    </div>
                    <div id="p3">
                        <img src="./lib/img/profissional3.png" alt="algo">
                        <div id="p3info">
                            <h4>Jenny Wilson</h4>
                            <img src="./lib/img/profissionalestrelas4.png" alt="algo">
                        </div>
                    </div>
                </div>

                <div class="mainC3">
                    <h4>+ de 200 profissionais em um só lugar</h4>
                    <hr class="rounded">
                </div>
            </div>

            <div class="nprofissionaisimg">

            </div>
        </div>

        <div class="footer">
            <h4>FALE CONOSCO</h4>
            <div class="contato">
                <img id="c1" src="./lib/img/email.png" alt="algo">
                <img id="c2" src="./lib/img/whats.png" alt="algo">
                <img id="c3" src="./lib/img/insta.png" alt="algo">
            </div>
        </div>

    </main>

</div>


<?php include(DIRREQ."/lib/html/footer.php"); ?>