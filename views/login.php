<?php
    include("../config/config.php");
    include(DIRREQ."/lib/html/header.php");
?>

<div class="container-logo">
    <img class="img-logo" src="https://source.unsplash.com/random" width="265px" height="220px">
</div>

 <form action="<?php echo DIRPAGE.'/controllers/ControllerLoginUser.php'; ?>" method="post">
  <fieldset>
   <legend> Login do usuário </legend>
   
   <label class="alinha"> Login: </label>
   <input type="text" name="email" autofocus> <br>

   <label class="alinha"> Senha: </label>
   <input type="password" name="senha"> <br>

   <input class="button btm" type="submit" value="sim">
  </fieldset>
 </form> 

<?php include(DIRREQ."/lib/html/footer.php"); ?>