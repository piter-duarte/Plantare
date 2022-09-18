<?php
    include("../../config/config.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/html/header.php");
    $date=new \DateTime($_GET['date'], new \DateTimeZone('America/Sao_Paulo'));
    $objBDD            = new \Classes\ClassBDD();
    $resultadoServices = $objBDD->getServices();
    $resultadoProvider = $objBDD->getProviders();
?>

<form name="formAdd" id="formAdd" method="post"action="<?php echo DIRPAGE.'/controllers/ControllerAddEvent.php'; ?>">
    Data: <input type="date" name="date" id="date" value="<?php echo $date->format("Y-m-d"); ?>"> <br>
    Hora: <input type="time" name="time" id="time" value="<?php echo $date->format("H:i"); ?>"> <br>
    Serviço:
    <select name="title" id="title">
    <?php 
         foreach($resultadoServices as $linha)
         {
            $servico = $linha['nome'];
            echo "<option value='$servico'>$servico</option>";
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
        foreach($resultadoProvider as $linha)
        {
            $provider_email = $linha['email'];
            echo "<option value='$provider_email'>$provider_email</option>";
        }
    ?>
    <input type="submit" value="Solicitar Serviço">


</form>

<?php include(DIRREQ."/lib/html/footer.php"); ?>