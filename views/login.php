<?php
    include("../config/config.php");
    include(DIRREQ."/lib/html/header.php");
?>

<h1> Login de usuário usando sessões em PHP </h1>
 <form action="<?php echo DIRPAGE.'/controllers/ControllerLoginUser.php'; ?>" method="post">
  <fieldset>
   <legend> Login do usuário </legend>
   
   <label class="alinha"> Login: </label>
   <input type="text" name="email" autofocus> <br>

   <label class="alinha"> Senha: </label>
   <input type="password" name="senha"> <br>

   <input class="button" type="submit" value="Login">
  </fieldset>
 </form> 

<?php include(DIRREQ."/lib/html/footer.php"); ?>