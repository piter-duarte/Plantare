<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");

    $usuario = unserialize($_SESSION['usuario']);
?>


<div class="container">
    <?php 
        chamarHeader('Cadastrar Serviços');
    ?>
    <main class="logadoPage">
        <?php
       chamarNavbar($usuario);
        ?>
        <div class="conteudo cadastrarServicos">
            <div class="mensagem">

                <div id="textos">
                    <h5>Deseja se tornar um prestador de serviços ?</h5>
                    <h5>Você poderá realizar os seguintes serviços em nossa plataforma: </h5>
                </div>


                <div id="servicos">
                    <ul>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <h5>Cortar Grama</h5>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <h5>Realizar Poda</h5>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <h5>Aplicar Pesticida</h5>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <h5>Aplicar Fertilizante</h5>
                        </li>
                    </ul>
                </div>

                <form action="<?php echo DIRPAGE.'/controllers/cadastroServicosController.php'; ?>">
                    <input type="submit" class="btg" value="Vamos lá ?">
                </form>
            </div>

        </div>

</div>
</main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>