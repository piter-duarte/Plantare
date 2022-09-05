<?php include("../config/config.php"); ?>
<?php include(DIRREQ."/lib/html/header.php"); ?>

<h1> Login de usuário usando sessões em PHP </h1>
 <form action="<?php echo DIRPAGE.'/controllers/ControllerLoginUser.php'; ?>" method="post">
  <fieldset>
   <legend> Login do usuário </legend>
   
   <label class="alinha"> Login: </label>
   <input type="text" name="username" autofocus> <br>

   <label class="alinha"> Senha: </label>
   <input type="password" name="password"> <br>

   <input type="submit" id="login" value="login">
  </fieldset>
 </form> 

<?php include(DIRREQ."/lib/html/footer.php"); ?>