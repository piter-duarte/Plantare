<?php
   include("../../config/config.php");
   include(DIRREQ."/lib/html/header.php");
   
?>

<div class="container">
    <header>
        <div class="logo">
            <a class="img-logo" href="<?php echo DIRPAGE.'/assets.php'; ?>">
                <img class="img-logo" src="<?php echo DIRPAGE.'/lib/img/LogoAlterada.png'; ?>">
            </a>
            <h5>Plantare</h5>
        </div>
    </header>
    <main class="cadastroContinuacaoPage">
        <div class="formAlign">
            <form id="continuacaoCadastroForm"
                action="<?php echo DIRPAGE.'/controllers/continuacaoCadastroController.php'; ?>" method="post">

                <div class="continuacaoContainer">
                    <div id="heading">
                        <h4>Cadastro de Serviço</h4>
                    </div>
                    <div id="body">
                        <div id="bodyContent1">

                            <!--Cortar Grama-->

                            <div class="contorno">
                                <div class="labelcheckbox">
                                    <label class="checkbox" for="servicoGrama">
                                        <input class="checkbox__input" type="checkbox" name="servico[]"
                                            id="servicoGrama" value="Cortar Grama">
                                        <div class="checkbox__box"></div>
                                    </label>
                                </div>
                                <div class="formGroup flex flex-col my-4">
                                    <label for="precoGrama">Cortar Grama</label>
                                    <div class="flex items-center">
                                        <input class="price" id="precoGrama" name="precoGrama" type="number"
                                            placeholder="Informe valor por hora"
                                            class="w-full border-b-2 border-black outline-none py-2" min="0" step="0.01"
                                            disabled>
                                        <span class="error-icon hidden -ml-6 text-red-700">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                        </span>
                                        <span class="success-icon hidden -ml-6 text-green-700">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </span>
                                    </div>
                                    <div class="error text-red-700 py-2"></div>
                                </div>
                            </div>

                            <!--Realizar Poda-->

                            <div class="contorno">
                                <div class="labelcheckbox">
                                    <label class="checkbox" for="servicoPoda">
                                        <input class="checkbox__input" type="checkbox" name="servico[]" id="servicoPoda"
                                            value="Realizar Poda">
                                        <div class="checkbox__box"></div>
                                    </label>
                                </div>
                                <div class="formGroup flex flex-col my-4">
                                    <label for="precoPoda">Realizar Poda</label>
                                    <div class="flex items-center">
                                        <input class="price" id="precoPoda" name="precoPoda" type="number"
                                            placeholder="Informe valor por hora"
                                            class="w-full border-b-2 border-black outline-none py-2" min="0" step="0.01"
                                            disabled>
                                        <span class="error-icon hidden -ml-6 text-red-700">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                        </span>
                                        <span class="success-icon hidden -ml-6 text-green-700">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </span>
                                    </div>
                                    <div class="error text-red-700 py-2"></div>
                                </div>
                            </div>

                            <!--Aplicar Fertilizante-->

                            <div class="contorno">
                                <div class="labelcheckbox">
                                    <label class="checkbox" for="servicoFertiliza">
                                        <input class="checkbox__input" type="checkbox" name="servico[]"
                                            id="servicoFertiliza" value="Aplicar Fertilizante">
                                        <div class="checkbox__box"></div>
                                    </label>
                                </div>
                                <div class="formGroup flex flex-col my-4">
                                    <label for="precoFertilizante">Aplicar Fertilizante</label>
                                    <div class="flex items-center">
                                        <input class="price" id="precoFertilizante" name="precoFertilizante"
                                            type="number" placeholder="Informe valor por hora"
                                            class="w-full border-b-2 border-black outline-none py-2" min="0" step="0.01"
                                            disabled>
                                        <span class="error-icon hidden -ml-6 text-red-700">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                        </span>
                                        <span class="success-icon hidden -ml-6 text-green-700">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </span>
                                    </div>
                                    <div class="error text-red-700 py-2"></div>
                                </div>
                            </div>

                            <!--Aplicar Pesticida-->

                            <div class="contorno">
                                <div class="labelcheckbox">
                                    <label class="checkbox" for="servicoPesticida">
                                        <input class="checkbox__input" type="checkbox" name="servico[]"
                                            id="servicoPesticida" value="Aplicar Pesticida">
                                        <div class="checkbox__box"></div>
                                    </label>
                                </div>
                                <div class="formGroup flex flex-col my-4">
                                    <label for="precoPesticida">Aplicar Pesticida</label>
                                    <div class="flex items-center">
                                        <input class="price" id="precoPesticida" name="precoPesticida" type="number"
                                            placeholder="Informe valor por hora"
                                            class="w-full border-b-2 border-black outline-none py-2" min="0" step="0.01"
                                            disabled>
                                        <span class="error-icon hidden -ml-6 text-red-700">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                        </span>
                                        <span class="success-icon hidden -ml-6 text-green-700">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </span>
                                    </div>
                                    <div class="error text-red-700 py-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Botão Finalizar-->
                    <div class="botao">
                        <input class="btm" type="submit" value="Finalizar">
                        <input class="btm bts" id="cancelar" type="button" value="Cancelar">
                    </div>
            </form>
        </div>
    </main>
</div>

<?php 
    include(DIRREQ."/lib/html/footer.php");
 ?>