<?php
   include("../config/config.php");
   include(DIRREQ."/lib/html/header.php");
?>
 <h1> Cadastro de usuário </h1>
 <form action="<?php echo DIRPAGE.'/controllers/ControllerInserirUsuario.php'; ?>" method="post">
  <fieldset>
   <legend> Dados cadastrais do usuário </legend>

   <input type="radio" name="tipo_pessoa" id="tipo_pessoa_f" value="0" checked>Pessoa Física
   <input type="radio" name="tipo_pessoa" id="tipo_pessoa_j" value="1">Pessoa Jurídica <br> <br>

   <div id="form-pessoa-fisica">
      <label class="alinha"> Nome completo: </label>
      <input type="text" name="nome"> <br>

      <label class="alinha"> CPF: </label>
      <input type="text" name="cpf"> <br>
   </div>

   <div id="form-pessoa-juridica" style="display: none;">
      <label class="alinha"> Razão Social: </label>
      <input type="text" name="razao_social"> <br>

      <label class="alinha"> CNPJ: </label>
      <input type="text" name="cnpj"> <br>
   </div>

   <label class="alinha"> Telefone: </label>
   <input type="text" name="telefone"> <br>

   <label class="alinha"> CEP: </label>
   <input type="text" name="cep"> <br>
   
   <label class="alinha"> Endereço: </label>
   <input type="text" name="endereco"> <br>

   <label class="alinha"> E-mail: </label>
   <input type="text" name="email"> <br>

   <label class="alinha"> Senha: </label>
   <input type="password" name="senha"> <br>

   <label class="checkbox" for="ehProvedorId">
        <input class="checkbox__input" type="checkbox" name="ehProvedor" id="ehProvedorId" checked>
        <div class="checkbox__box"></div>
        Provedor de Serviços ?
   </label>
   <br>

   <input class="button" type="submit" value="Cadastrar">

  </fieldset>
 </form>
 <?php 
    include(DIRREQ."/lib/html/footer.php");
 ?>