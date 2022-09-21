<?php
    include("../../config/config.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/html/header.php");
    $date=new \DateTime($_GET['date'], new \DateTimeZone('America/Sao_Paulo'));
    $objBDD            = new \Classes\ClassBDD();
    $resultadoServices = $objBDD->getServices();
    $resultadoProvider = $objBDD->getProviders(1);
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
            if($idServico == $_GET['id'])
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
        <option value="1">1h</option>
        <option value="2">2h</option>
        <option value="3">3h</option>
    </select><br>
    Profissional Responsável: <select name="provider_key">
    <?php
            if(isset($_GET['id']))
            {

                $resultadoProvider = $objBDD->getProviders($_GET['id']);
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