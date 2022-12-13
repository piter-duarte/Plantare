<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");

    /*
        OBS - Cookies somente são lidos após a página recarregar/mudar de página, 
        portanto, para que a tela de realizarOrcamento funcione desde o ínico,
        os cookies necessários serão gerados aqui
    */
        //cria o cookie hora para que na primeira leitura já seja atribuído no elemento html select#horaAtendimento a option 1 como selected
        if(!isset($_COOKIE["hora"]))
        {
            setcookie('hora','1', 0 ); 
        }
        //cria o cookie id para que na primeira leitura já ser feito a query no banco de dados
        if(!isset($_COOKIE["id"]))
        {
            setcookie('id','1', 0 ); 
        }
        if(!isset($_COOKIE["email"]))
        {
            setcookie('email', 'cortadores@email.com', 0 ); 
        }
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
            <div class="calendarUser"></div>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>