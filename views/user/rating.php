<?php
    include("../../config/config.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
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
    <input type="submit" value="Cancelar" formaction="<?php echo DIRPAGE.'/views/user/index.php'; ?>">

</form>

<?php
    include(DIRREQ."/lib/html/footer.php");
?>