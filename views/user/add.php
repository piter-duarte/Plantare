<?php
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
?>

<?php
    $date=new \DateTime($_GET['date'], new \DateTimeZone('America/Sao_Paulo'));
?>

<form name="formAdd" id="formAdd" method="post"action="<?php echo DIRPAGE.'/controllers/ControllerAddEvent.php'; ?>">
    Data: <input type="date" name="date" id="date" value="<?php echo $date->format("Y-m-d"); ?>"> <br>
    Hora: <input type="time" name="time" id="time" value="<?php echo $date->format("H:i"); ?>"> <br>
    Serviço:
    <select name="title" id="title">
        <option value="">Selecione</option>
        <option value="Cortar Grama">Cortar Grama</option>
        <option value="Podar">Podar</option>
        <option value="Aplicar Pesticida">Aplicar Pesticida</option>
        <option value="Aplicar Fertilizante">Aplicar Fertilizante</option>
    </select><br>
    Preço: <input type="text" name="description" id="description" value=""> <br>
    Quanto tempo deseja de atendimento: 
    <select name="horasAtendimento" id="horasAtendimento">
        <option value="">Selecione</option>
        <option value="1">1h</option>
        <option value="2">2h</option>
        <option value="3">3h</option>
    </select><br>
    Profissional Responsável: <input type="text" name="provider_key" id="provider_key"> <br>
    <input type="submit" value="Marcar Consulta">


</form>

<?php include(DIRREQ."/lib/html/footer.php"); ?>