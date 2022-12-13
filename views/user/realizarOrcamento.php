<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");
    $date=new \DateTime($_GET['date'], new \DateTimeZone('America/Sao_Paulo'));
    $usuarioDAO = new \Classes\UsuarioDAO();
    $relacaoDAO = new \Classes\RelacaoDAO();
    $servicoDAO = new \Classes\ServicoDAO();

    //descobre a data atual
    $start=new \DateTime($date->format("Y-m-d").' '.$date->format("H:i"), new \DateTimeZone('America/Sao_Paulo'));
    $end  =new \DateTime($date->format("Y-m-d").' '.$date->format("H:i"), new \DateTimeZone('America/Sao_Paulo'));

        //busca pelos provedores de serviço disponíveis de acordo com o que o usuário selecionar
        $resultadoBuscarDisponiveis = $usuarioDAO->buscarDisponiveis2($_COOKIE["id"], $start->format("Y-m-d H:i:s"), $end->modify('+'.$_COOKIE["hora"].'hours')->format("Y-m-d H:i:s"));
        
        //busca pelos serviços disponíveis no sistema
        $resultadoServicosDAO = $servicoDAO->listar();

        //busca as informações da tabela relacao de acordo com o email e serviçi selecionado
        $resultadoBuscarRelacaoDAO =  $relacaoDAO->buscar($_COOKIE["email"], $_COOKIE["id"]);
        
        // echo var_dump($resultadoBuscarRelacaoDAO); //mostra o resultado da query do BDD

        $usuario = unserialize($_SESSION['usuario']);
?>


<div class="container">
    <?php 
        chamarHeader('Realizar Orçamento');
    ?>
    <main class="logadoPage">
        <?php
       chamarNavbar($usuario);
        ?>
        <div class="conteudo realizarOrcamento">
            <div class="space80">
                <form class="containerform" id="realizarOrcamento" method="post"
                    action="<?php echo DIRPAGE.'/controllers/realizarOrcamentoController.php'; ?>">
                    <div class="formGroup flex flex-col my-2">
                        <label for="date">Data</label>
                        <div class="flex items-center">

                            <input name="date" id="date" type="date"
                                class="w-full border-b-2 border-black outline-none py-2" required
                                value="<?php echo $date->format("Y-m-d"); ?>" readonly>
                            <span class="error-icon hidden -ml-6 text-red-700">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </span>
                            <span class="success-icon hidden -ml-6 text-green-700">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                        </div>
                        <div class="error text-red-700 py-2"></div>
                    </div>

                    <div class="formGroup flex flex-col my-2">
                        <label for="time">Hora Inicial</label>
                        <div class="flex items-center">

                            <input name="time" id="time" type="time"
                                class="w-full border-b-2 border-black outline-none py-2" required
                                value="<?php echo $date->format("H:i"); ?>" readonly>
                            <span class="error-icon hidden -ml-6 text-red-700">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </span>
                            <span class="success-icon hidden -ml-6 text-green-700">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                        </div>
                        <div class="error text-red-700 py-2"></div>
                    </div>

                    <div class="formGroup flex flex-col my-2">
                        <label for="horasAtendimento">Tempo Atendimento</label>
                        <div class="flex items-center">
                            <select name="horasAtendimento" id="horasAtendimento"
                                class="w-full border-b-2 border-black outline-none py-2">
                                <!-- Options do Select-->
                                <?php 
                                     switch ($_COOKIE["hora"]) {
                                        case 1:
                                            echo "<option value='1' selected>1h</option>";
                                            echo "<option value='2'>2h</option>";
                                            echo "<option value='3'>3h</option>";
                                            break;
                                        case 2:
                                            echo "<option value='1'>1h</option>";
                                            echo "<option value='2' selected>2h</option>";
                                            echo "<option value='3'>3h</option>";
                                            break;
                                        case 3:
                                            echo "<option value='1'>1h</option>";
                                            echo "<option value='2'>2h</option>";
                                            echo "<option value='3' selected>3h</option>";
                                        break;
                                        default:
                                            echo "<option value='1'>1h</option>";
                                            echo "<option value='2'>2h</option>";
                                            echo "<option value='3'>3h</option>";
                                            break;
                                    }
                                ?>
                            </select>
                            <span class="error-icon hidden -ml-6 text-red-700">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </span>
                            <span class="success-icon hidden -ml-6 text-green-700">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                        </div>
                        <div class="error text-red-700 py-2"></div>
                    </div>

                    <div class="formGroup flex flex-col my-2">
                        <label for="title">Serviço</label>
                        <div class="flex items-center">

                            <select name="title" id="title" class="w-full border-b-2 border-black outline-none py-2">
                                <!-- Options do Select-->
                                <?php 
                                    foreach($resultadoServicosDAO as $linha)
                                    {
                                        $idServico = $linha['id'];
                                        $servico   = $linha['nome'];
                                        if($idServico == $_COOKIE["id"])
                                        {
                                            echo "<option value='$idServico' selected>$servico</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='$idServico'>$servico</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <span class="error-icon hidden -ml-6 text-red-700">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </span>
                            <span class="success-icon hidden -ml-6 text-green-700">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                        </div>
                        <div class="error text-red-700 py-2"></div>
                    </div>

                    <div class="formGroup flex flex-col my-2">
                        <label for="provider_key">Profissional</label>
                        <div class="flex items-center">
                            <select name="provider_key" id="provider_key"
                                class="w-full border-b-2 border-black outline-none py-2">
                                <!-- Options do Select-->
                                <?php
                                if(isset($_COOKIE["id"]) AND isset($_COOKIE["hora"]))
                                {
                                    foreach($resultadoBuscarDisponiveis as $linha)
                                    {
                                        if($linha['ehJuridica'] == '0')
                                        {
                                            $provider_nome  = $linha['nome'];
                                        }
                                        else
                                        {
                                            $provider_nome  = $linha['razao_social'];
                                        }
                                    $provider_email = $linha['email'];
                                    $provider_media = $linha['media'];
                                    if($provider_email == $_COOKIE["email"])
                                    {
                                        echo "<option value='$provider_email' selected>$provider_nome | $provider_media estrelas";
                                    } 
                                    else
                                    {
                                        echo "<option value='$provider_email'>$provider_nome | $provider_media estrelas";
                                    }
                                    
                                    }
                                }
                                else
                                {
                                    foreach($resultadoBuscarDisponiveis as $linha)
                                    {
                                        if($linha['ehJuridica'] == '0')
                                        {
                                            $provider_nome  = $linha['nome'];
                                        }
                                        else
                                        {
                                            $provider_nome  = $linha['razao_social'];
                                        }
                                        $provider_email = $linha['email'];
                                        $provider_media = $linha['media'];
                                        echo "<option value='$provider_email'>$provider_nome | $provider_media estrelas </option> <br>";
                                    }
                                }
                        ?>
                            </select>
                            <span class="error-icon hidden -ml-6 text-red-700">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </span>
                            <span class="success-icon hidden -ml-6 text-green-700">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                        </div>
                        <div class="error text-red-700 py-2"></div>
                    </div>
                    <input type="hidden" id= "precoServico" name="precoServico" value="<?php echo $resultadoBuscarRelacaoDAO["preco"]?>">
                    <input id="solicitarOrcamento" class="btxg" type="button" value="Solicitar Orçamento">
                </form>
            </div>
        </div>
        <div class="popup realizarOrcamento">
            <h4>Orçamento - </h4>
            <div id="popup-p-group">
                <p>Data: </p>
                <p>Hora Inicial: </p>
                <p>Hora Final: </p>
                <p>Profissional: </p>
                <p>Preço por hora: </p>
                <p>Total a pagar: </p>
            </div>
            <div id="popup-bt-group">
                <input class="btm" type="submit" form="realizarOrcamento" value="Confirmar">
                <input id="popCancel" class="btm bts" type="button" value="Cancelar">
            </div>

        </div>
</div>
</main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>