<?php 
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
    include(DIRREQ."/lib/includes/funcoes.php");

?>


<div class="container">
    <?php 
        chamarHeader('Status dos Pedidos');
    ?>
    <main class="logadoPage">
        <?php
            chamarNavbar('Pagina em Desenvolvimento do Bruno');
        ?>
        <div class="conteudo realizarOrcamento">
            <div class="space80">
                <form class="containerform" id="realizarOrcamento" action="">
                    <div class="formGroup flex flex-col my-4">
                        <label for="date">Data</label>
                        <div class="flex items-center">

                            <input id="date" type="date" class="w-full border-b-2 border-black outline-none py-2"
                                required>
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
                        <label for="date">Hora Inicial</label>
                        <div class="flex items-center">

                            <input id="time" type="time" class="w-full border-b-2 border-black outline-none py-2"
                                required>
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
                        <label for="time">Tempo Atendimento</label>
                        <div class="flex items-center">
                            <select name="horasAtendimento" id="horasAtendimento"
                                class="w-full border-b-2 border-black outline-none py-2">
                                <!-- Options do Select-->
                            </select>
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
                        <label for="title">Serviço</label>
                        <div class="flex items-center">

                            <select name="title" id="title" class="w-full border-b-2 border-black outline-none py-2">
                                <!-- Options do Select-->
                            </select>
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
                        <label for="provider_key">Profissional</label>
                        <div class="flex items-center">
                            <select name="provider_key" id="provider_key"
                                class="w-full border-b-2 border-black outline-none py-2">
                                <!-- Options do Select-->
                            </select>
                            <span class="error-icon hidden -ml-6 text-red-700">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </span>
                            <span class="success-icon hidden -ml-6 text-green-700">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                        </div>
                        <div class="error text-red-700 py-2"></div>
                    </div>
                    
                    <input class="btxg" type="button" value="Solicitar Orçamento">
                </form>
            </div>
        </div>
</div>
</main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>