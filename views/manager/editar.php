<?php
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
?>

<?php
   $objEvents= new \Classes\ClassEvents();
   $events=$objEvents->getEventsById($_GET['id']);
   $date=new \DateTime($events['start']);
?>

<form name="formEdit" id="formEdit" method="post">
    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>"> <br>
    Data: <input type="date" name="date" id="date" value="<?php echo $date->format("Y-m-d"); ?>"> <br>
    Hora: <input type="time" name="time" id="time" value="<?php echo $date->format("H:i"); ?>"> <br>
    Paciente: <input type="text" name="title" id="title" value="<?php echo $events['title']; ?>"> <br>
    Queixa: <input type="text" name="description" id="description" value="<?php echo $events['description']; ?>"> <br>
    <input type="submit" formaction="<?php echo DIRPAGE.'/controllers/ControllerEdit.php'; ?>" value="Aceitar">
    <input type="submit" formaction="<?php echo DIRPAGE.'/controllers/ControllerEditCancel.php'; ?>" value="Cancelar">

</form>

<?php
    include(DIRREQ."/lib/html/footer.php");
?>
