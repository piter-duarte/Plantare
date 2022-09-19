<?php
   include("../../config/config.php");
   require_once "../../lib/includes/valida-acesso.inc.php";
   include(DIRREQ."/lib/html/header.php");
?>
 <h1> Cadastro de usuário </h1>
 <form action="<?php echo DIRPAGE.'/controllers/ControllerInserirServicosManager.php'; ?>" method="post">

   <legend class="continua"> <p> Continuação dos Dados cadastrais como Provedor de Serviço </p> 
   <table class="tabela-bruno">
      <tr>
         <th> Serviço</th>
         <th> Preço por hora</th>
      </tr>
      <tr>
            <td> <input type="checkbox" name="servico[]" value="Cortar Grama"><label>Cortar Grama</label></td>
            <td> <input type="number" name="precoGrama" min="0" step="0.01"><label></label></td>
      </tr>
      <tr>
            <td> <input type="checkbox" name="servico[]" value="Realizar Poda"><label>Realizar Poda</label></td>
            <td> <input type="number" name="precoPoda" min="0" step="0.01"><label></label></td>
      </tr>
      <tr>
            <td> <input type="checkbox" name="servico[]" value="Aplicar Fertilizante"><label>Aplicar Fertilizante</label></td>
            <td> <input type="number" name="precoFertilizante" min="0" step="0.01"><label></label></td>
      </tr>
      <tr>
            <td> <input type="checkbox" name="servico[]" value="Aplicar Pesticida"><label>Aplicar Pesticida</label></td>
            <td> <input type="number" name="precoPesticida" min="0" step="0.01"><label></label></td>
      </tr>
   </table>


   <input class="button" type="submit" value="Finalizar Cadastro">

   </legend>
 </form>
 <?php 
    include(DIRREQ."/lib/html/footer.php");
 ?>