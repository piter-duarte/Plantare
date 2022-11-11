<?php
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
    $con= new Models\ModelConect;
    $con->conectDB();
?>


<div class="container">
    <header>
        <h3>Teste</h3>
    </header>
    <main class="logado">
        <div class="navbar">
            <a href="">Meu Perfil</a>
            <br>
            <a href="">Meus Pedidos</a>
            <br>
            <a href="">Novo Pedido</a>
            <br>
            <a href="">Avaliar Profissional</a><a href=""></a>
            <br>
            <a href="">Cadastrar Serviços</a>
            <br>
            <a href="">Status do Pedido</a>
            <br>
            <a href="">Sair</a>
        </div>
        <div class="conteudo">
            <div class="space80">     
                <div class="containerform">
                    <input type="text">
                    <input type="text">
                    <input type="text">
                    <input type="text">
                    <input type="text">
                    <input type="button">
                    
                </div>
            </div>
            
           
           
    </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>