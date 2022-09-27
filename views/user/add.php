<?php
    include("../../config/config.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/html/header.php");
    $date=new \DateTime($_GET['date'], new \DateTimeZone('America/Sao_Paulo'));
    $objBDD            = new \Classes\ClassBDD();
    $resultadoServices = $objBDD->getServices();


    //cria o cookie hora para que na primeira leitura já seja atribuído no elemento html select#horaAtendimento a option 1 como selected
    if(isset($_COOKIE["hora"]) == false)
    {
        setcookie('hora','1', 0 ); 
    }

    //descobre a data atual
    $start=new \DateTime($date->format("Y-m-d").' '.$date->format("H:i"), new \DateTimeZone('America/Sao_Paulo'));
    
    //realiza a busca no banco de dados na primeira vez que a página foi carregada e nenhum dado dos selects foi manipulado
    if(!isset($_COOKIE["hora"]) AND !isset($_COOKIE["id"]))
    {
        $resultadoProvider = $objBDD->getProviders(1, $start->format("Y-m-d H:i:s"), $start->modify('+'.'1'.'hours')->format("Y-m-d H:i:s"), 1);
    }

?>

<form name="formAdd" id="formAdd" method="post"action="<?php echo DIRPAGE.'/controllers/ControllerAddEvent.php'; ?>">
    Data: <input type="date" name="date" id="date" value="<?php echo $date->format("Y-m-d"); ?>"> <br>
    Hora: <input type="time" name="time" id="time" value="<?php echo $date->format("H:i"); ?>"> <br>
    Serviço:
    <select name="title" id="title">
    <?php 
         foreach($resultadoServices as $linha)
         {
            $idServico = $linha['id'];
            $servico   = $linha['nomeS'];
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
    </select><br>
    Preço: <input type="text" name="description" id="description" value=""> <br>
    Quanto tempo deseja de atendimento: 
    <select name="horasAtendimento" id="horasAtendimento">
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
    </select><br>
    Profissional Responsável: <select name="provider_key">
    <?php
            if(isset($_COOKIE["id"]) AND isset($_COOKIE["hora"]))
            {

                $resultadoProvider = $objBDD->getProviders($_COOKIE["id"], $start->format("Y-m-d H:i:s"), $start->modify('+'.'1'.'hours')->format("Y-m-d H:i:s"), $_COOKIE["hora"]);
                foreach($resultadoProvider as $linha)
                {
                   $provider_nome  = $linha['nome'];
                   $provider_email = $linha['email'];
                   $provider_media = $linha['media'];
                   echo "<option value='$provider_email'>$provider_nome | $provider_media estrelas <br>";
                }
            }
            else
            {
                foreach($resultadoProvider as $linha)
                {
                    $provider_nome  = $linha['nome'];
                    $provider_email = $linha['email'];
                    $provider_media = $linha['media'];
                    echo "<option value='$provider_email'>$provider_nome | $provider_media estrelas </option> <br>";
                }
            }
    ?>
    <input type="submit" value="Solicitar Serviço">


</form>
<?php 
include(DIRREQ."/lib/html/footer.php"); ?>