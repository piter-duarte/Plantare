<?php
    include("../../config/config.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/html/header.php");
    $date=new \DateTime($_GET['date'], new \DateTimeZone('America/Sao_Paulo'));
    $objBDD            = new \Classes\ClassBDD();
    $resultadoServices = $objBDD->getServices();
    $resultadoProvider = $objBDD->getProviders(1);
    if(isset($_COOKIE["hora"]) == false)
    {
        setcookie('hora','1', 0 ); 
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
            if(isset($_COOKIE["id"]))
            {

                $resultadoProvider = $objBDD->getProviders($_COOKIE["id"]);
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
//echo var_dump($resultadoProvider);
include(DIRREQ."/lib/html/footer.php"); ?>