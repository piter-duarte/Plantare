<?php
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
?>

<form name="formAdd" id="formAdd" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"> <br>
    Avaliar:
    <select name="avaliacao">
        <option value="">Selecione</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select><br>
    <input type="submit" value="Avaliar" formaction="<?php echo DIRPAGE.'/controllers/ControllerUpdateRating.php'; ?>">
    <input type="submit" value="Cancelar" formaction="<?php echo 'http://localhost/Curso/views/user/index.php'; ?>">

</form>

<?php
    // $objEvents->updateRating($id);
    // echo "<script>window.location.replace('http://localhost/Curso/views/user/index.php');</script>";
    include(DIRREQ."/lib/html/footer.php");
?>