<?php
   include("../config/config.php");
   include(DIRREQ."/lib/html/header.php");
?>
 <h1> Cadastro de usuário </h1>
 <form action="<?php echo DIRPAGE.'/controllers/ControllerInserirUsuario.php'; ?>" method="post">
  <fieldset>
   <legend> Dados cadastrais do usuário </legend>


   <label class="alinha"> Nome completo: </label>
   <input type="text" name="nome"> <br>

   <label class="alinha"> Telefone: </label>
   <input type="text" name="telefone"> <br>

   <label class="alinha"> Cep: </label>
   <input type="text" name="cep"> <br>
   
   <label class="alinha"> Endereço: </label>
   <input type="text" name="endereco"> <br>

   <input type="checkbox" name="ehProvedor"> Provedor de Serviços ?
   <br>

   <label class="alinha"> E-mail: </label>
   <input type="text" name="email"> <br>

   <label class="alinha"> Senha: </label>
   <input type="password" name="senha"> <br>

   <input type="submit" value="Cadastrar">
  </fieldset>
 </form>
 <?php 
    include(DIRREQ."/lib/html/footer.php");
 ?>