<?php include("../../config/config.php"); ?>
<?php include(DIRREQ."/lib/html/header.php"); ?>
 <h1> Cadastro de usuário </h1>
 <form action="<?php echo DIRPAGE.'/controllers/ControllerAddUser.php'; ?>" method="post">
  <fieldset>
   <legend> Dados cadastrais do usuário </legend>
   
   <label class="alinha"> Nome completo: </label>
   <input type="text" name="name" placeholder="Forneça o seu nome..." autofocus> <br>

   <label class="alinha"> Usuario (login): </label>
   <input type="text" name="username"> <br>

   <label class="alinha"> Senha: </label>
   <input type="password" name="password"> <br>

   <input type="submit" value="Cadastrar">
  </fieldset>
 </form>
 <?php include(DIRREQ."/lib/html/footer.php"); ?>