<?php
   include("../../config/config.php");
   require_once "../../lib/includes/valida-acesso.inc.php";
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
                action="<?php echo DIRPAGE.'/controllers/ControllerInserirServicosManager.php'; ?>" method="post">

                <div class="continuacaoContainer">
                    <div id="heading">
                        <div id="servico">
                            <h4>Serviço</h4>
                        </div>
                        <div id="valorHora">
                            <h4>Valor por Hora</h4>
                        </div>

                    </div>
                    <div id="body">
                        <div id="bodyContent1">
                            <label class="checkbox" for="servicoGrama">
                                <input class="checkbox__input" type="checkbox" name="servico[]" id="servicoGrama"
                                    value="Cortar Grama">
                                <div class="checkbox__box"></div>
                                Cortar Grama
                            </label>
                            <label class="checkbox" for="servicoPoda">
                                <input class="checkbox__input" type="checkbox" name="servico[]" id="servicoPoda"
                                    value="Realizar Poda">
                                <div class="checkbox__box"></div>
                                Realizar Poda
                            </label>
                            <label class="checkbox" for="servicoFertiliza">
                                <input class="checkbox__input" type="checkbox" name="servico[]" id="servicoFertiliza"
                                    value="Aplicar Fertilizante">
                                <div class="checkbox__box"></div>
                                Aplicar Fertilizante
                            </label>
                            <label class="checkbox" for="servicoPesticida">
                                <input class="checkbox__input" type="checkbox" name="servico[]" id="servicoPesticida"
                                    value="Aplicar Pesticida">
                                <div class="checkbox__box"></div>
                                Aplicar Pesticida
                            </label>
                        </div>
                        <div id="bodyContent2">
                            <div class="formGroup flex flex-col my-4">
                                <label for="precoGrama">Preço Grama</label>
                                <div class="flex items-center">
                                    <input id="precoGrama" name="precoGrama" type="number"
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
                            <div class="formGroup flex flex-col my-4">
                                <label for="precoPoda">Preço Poda</label>
                                <div class="flex items-center">
                                    <input id="precoPoda" name="precoPoda" type="number"
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
                            <div class="formGroup flex flex-col my-4">
                                <label for="precoFertilizante">Preço Fertilizante</label>
                                <div class="flex items-center">
                                    <input id="precoFertilizante" name="precoFertilizante" type="number"
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
                            <div class="formGroup flex flex-col my-4">
                                <label for="precoPesticida">Preço Pesticida</label>
                                <div class="flex items-center">
                                    <input id="precoPesticida" name="precoPesticida" type="number"
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
                    <button type="submit">Finalizar</button>
                </div>


            </form>
        </div>
    </main>
</div>

<?php 
    include(DIRREQ."/lib/html/footer.php");
 ?>