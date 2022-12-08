<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");
    
    $usuario = unserialize($_SESSION['usuario']);
    
    $relacaoDAO = new \Classes\RelacaoDAO();
    $resultado = $relacaoDAO->buscarTodosPrecosUsuario($usuario);
   
?>


<div class="container">
    <?php 
        chamarHeader('Meus Serviços');
    ?>
    <main class="logadoPage">
        <?php
       chamarNavbar($usuario);
        ?>
        <div class="conteudo meusServicos">
            <form id="formMeusServicos" method="post"
                action="<?php echo DIRPAGE.'/controllers/meusServicosController.php'; ?>">
                <?php
                     foreach($resultado as $linha)
                     {
                         $idServico = $linha['idServico'];
                         $preco   = $linha['preco'];
                         if($idServico == 1)
                         {
                             echo "<div class='formGroup flex flex-col my-4'>
                             <label for='precoGrama'>Cortar Grama</label>
                             <div class='flex items-center'>
                                 <input id='precoGrama' name='precoGrama' type='number' min='0' step='0.01'
                                     class='w-full border-b-2 border-black outline-none py-2'
                                     value='$preco' disabled>
                                 <span class='error-icon hidden -ml-6 text-red-700'>
                                     <i class='fa-solid fa-circle-exclamation'></i>
                                 </span>
                                 <span class='success-icon hidden -ml-6 text-green-700'>
                                     <i class='fa-solid fa-circle-check'></i>
                                 </span>
                             </div>
                             <div class='error text-red-700 py-2'></div>
                         </div>";
                         }
                     }
                     foreach($resultado as $linha)
                     {
                         $idServico = $linha['idServico'];
                         $preco   = $linha['preco'];
                         if($idServico == 2)
                         {
                             echo "<div class='formGroup flex flex-col my-4'>
                             <label for='precoPoda'>Realizar Poda</label>
                             <div class='flex items-center'>
                                 <input id='precoPoda' name='precoPoda' type='number' min='0' step='0.01'
                                     class='w-full border-b-2 border-black outline-none py-2'
                                     value='$preco' disabled>
                                 <span class='error-icon hidden -ml-6 text-red-700'>
                                     <i class='fa-solid fa-circle-exclamation'></i>
                                 </span>
                                 <span class='success-icon hidden -ml-6 text-green-700'>
                                     <i class='fa-solid fa-circle-check'></i>
                                 </span>
                             </div>
                             <div class='error text-red-700 py-2'></div>
                         </div>";
                         }
                     }
                     foreach($resultado as $linha)
                     {
                         $idServico = $linha['idServico'];
                         $preco   = $linha['preco'];
                         if($idServico == 3)
                         {
                             echo "<div class='formGroup flex flex-col my-4'>
                             <label for='precoPesticida'>Aplicar Pesticida</label>
                             <div class='flex items-center'>
                                 <input id='precoPesticida' name='precoPesticida' type='number' min='0' step='0.01'
                                     class='w-full border-b-2 border-black outline-none py-2'
                                     value='$preco' disabled>
                                 <span class='error-icon hidden -ml-6 text-red-700'>
                                     <i class='fa-solid fa-circle-exclamation'></i>
                                 </span>
                                 <span class='success-icon hidden -ml-6 text-green-700'>
                                     <i class='fa-solid fa-circle-check'></i>
                                 </span>
                             </div>
                             <div class='error text-red-700 py-2'></div>
                         </div>";
                         }
                     }
                     foreach($resultado as $linha)
                     {
                         $idServico = $linha['idServico'];
                         $preco   = $linha['preco'];
                         if($idServico == 4)
                         {
                             echo "<div class='formGroup flex flex-col my-4'>
                             <label for='precoFertilizante'>Aplicar Fertilizante</label>
                             <div class='flex items-center'>
                                 <input id='precoFertilizante' name='precoFertilizante' type='number' min='0' step='0.01'
                                     class='w-full border-b-2 border-black outline-none py-2'
                                     value='$preco' disabled>
                                 <span class='error-icon hidden -ml-6 text-red-700'>
                                     <i class='fa-solid fa-circle-exclamation'></i>
                                 </span>
                                 <span class='success-icon hidden -ml-6 text-green-700'>
                                     <i class='fa-solid fa-circle-check'></i>
                                 </span>
                             </div>
                             <div class='error text-red-700 py-2'></div>
                         </div>";
                         }
                     }
                ?>
                <div id="btGroup">
                    <button id="salvar" class="btm bts" disabled>Salvar</button>
                    <button id="editar" class="btm" formaction="javascript:void(0);">Editar</button>
                </div>
            </form>
        </div>
    </main>
</div>
</main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>