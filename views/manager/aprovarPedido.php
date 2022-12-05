<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php"); 
?>

<?php
   $objEvents= new \Classes\ClassEvents();
   $events=$objEvents->getEventsById($_GET['id']);
   $dateInicio    = new \DateTime($events['start']);
   $dateFim       = new \DateTime($events['end']);
   $usuario = unserialize($_SESSION['usuario']);
?>

<div class="container">
    <?php 
        chamarHeader('Aprovar Pedido');
    ?>
    <main class="logadoPage">
        <?php
       chamarNavbar($usuario);
        ?>
        <div class="conteudo aprovarPedido">
            <form name="formAprovarPedido" id="formAprovarPedido" method="post">
                <input type="hidden" name="idEvento" id="idEvento" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="description" id="description" value="<?php echo $events['description']; ?>">

                <div class="formGroup flex flex-col my-2">
                    <label for="date">Data</label>
                    <div class="flex items-center">

                        <input name="date" id="date" type="date"
                            class="w-full border-b-2 border-black outline-none py-2" required
                            value="<?php echo $dateInicio->format("Y-m-d"); ?>" readonly>
                        <span class="error-icon hidden -ml-6 text-red-700">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>
                        <span class="success-icon hidden -ml-6 text-green-700">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>
                    </div>
                    <div class="error text-red-700 py-2"></div>
                </div>
                <div class="formGroup flex flex-col my-2">
                    <label for="time">Hora Inicial</label>
                    <div class="flex items-center">

                        <input name="time" id="time" type="time"
                            class="w-full border-b-2 border-black outline-none py-2" required
                            value="<?php echo $dateInicio->format("H:i"); ?>" readonly>
                        <span class="error-icon hidden -ml-6 text-red-700">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>
                        <span class="success-icon hidden -ml-6 text-green-700">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>
                    </div>
                    <div class="error text-red-700 py-2"></div>
                </div>
                <div class="formGroup flex flex-col my-2">
                    <label for="time">Hora Final</label>
                    <div class="flex items-center">

                        <input name="time" id="time" type="time"
                            class="w-full border-b-2 border-black outline-none py-2" required
                            value="<?php echo $dateFim->format("H:i"); ?>" readonly>
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
                        <input name="title" id="title" type="text"
                            class="w-full border-b-2 border-black outline-none py-2" required readonly
                            value="<?php echo $events['title']; ?>">
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
                                <label for="valorServiço">Valor</label>
                                <div class="flex items-center">
                                    <input id="valorServiço" name="valorServiço" type="number"
                                        class="w-full border-b-2 border-black outline-none py-2" min="0" step="0.01"
                                        required readonly value="<?php echo $events['preco']; ?>">
                                    <span class="error-icon hidden -ml-6 text-red-700">
                                        <i class="fa-solid fa-circle-exclamation"></i>
                                    </span>
                                    <span class="success-icon hidden -ml-6 text-green-700">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </span>
                                </div>
                                <div class="error text-red-700 py-2"></div>
                            </div>
                <div>
                    <input class="btm" type="submit"
                        formaction="<?php echo DIRPAGE.'/controllers/ControllerConfirmEvent.php'; ?>" value="Aceitar">
                    <input class="btm bts" type="submit"
                        formaction="<?php echo DIRPAGE.'/controllers/ControllerCancelEvent.php'; ?>" value="Cancelar">
                </div>


            </form>
        </div>
</div>


<?php
    include(DIRREQ."/lib/html/footer.php");
?>