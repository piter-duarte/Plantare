<?php 
    include("../../config/config.php");
    include(DIRREQ."/lib/html/header.php");
    require_once DIRREQ."/lib/includes/valida-acesso.inc.php";
    include(DIRREQ."/lib/includes/funcoes.php");

?>


<div class="container">
    <?php 
        chamarHeader('Meu Perfil');
    ?>
    <main class="logadoPage">
        <?php
       chamarNavbar($_SESSION["nome"], $_SESSION["razao_social"], $_SESSION["media"], $_SESSION["ehProvedor"]);
        ?>
        <div class="conteudo meuPerfil">
            <?php
                //Descobrindo o que tem na variável de sessão
                // echo '<pre>';
                // var_dump($_SESSION);
                // echo '</pre> <br>';
            ?>
            <form id="formMeuPerfil" method="post" action="<?php echo DIRPAGE.'/controllers/ControllerUpdateUser.php'; ?>">
            <?php
                
                if($_SESSION["ehJuridica"] == 0)
                {
                    echo'<div class="formGroup flex flex-col my-4">
                    <label for="nome">Nome Completo</label>
                    <div class="flex items-center">
                        <input id="nome" name="nome" type="text" class="w-full border-b-2 border-black outline-none py-2" value="'.$_SESSION["nome"].'" disabled>
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
                <label for="cpf">CPF</label>
                <div class="flex items-center">
                    <input id="cpf" name="cpf" type="text" class="w-full border-b-2 border-black outline-none py-2" value="'.$_SESSION['cpf'].'" disabled>
                    <span class="error-icon hidden -ml-6 text-red-700">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </span>
                    <span class="success-icon hidden -ml-6 text-green-700">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                </div>
                <div class="error text-red-700 py-2"></div>
            </div>
            <div class="formGroup flex flex-col my-4" style="display: none;">
                <label for="razao_social">Razão Social</label>
                <div class="flex items-center">
                    <input id="razao_social" name="razao_social" type="text" class="w-full border-b-2 border-black outline-none py-2" value="'.$_SESSION['razao_social'].'" disabled>
                    <span class="error-icon hidden -ml-6 text-red-700">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </span>
                    <span class="success-icon hidden -ml-6 text-green-700">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                </div>
                <div class="error text-red-700 py-2"></div>
            </div>
            <div class="formGroup flex flex-col my-4" style="display: none;">
                <label for="cnpj">CNPJ</label>
                <div class="flex items-center">
                    <input id="cnpj" name="cnpj" type="text" class="w-full border-b-2 border-black outline-none py-2" value="'.$_SESSION['cnpj'].'" disabled>
                    <span class="error-icon hidden -ml-6 text-red-700">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </span>
                    <span class="success-icon hidden -ml-6 text-green-700">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                </div>
                <div class="error text-red-700 py-2"></div>
            </div>';
                }
                else
                {
                    echo'<div class="formGroup flex flex-col my-4" style="display: none;">
                    <label for="nome">Nome Completo</label>
                    <div class="flex items-center">
                        <input id="nome" name="nome" type="text" class="w-full border-b-2 border-black outline-none py-2" value="'.$_SESSION["nome"].'" disabled>
                        <span class="error-icon hidden -ml-6 text-red-700">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>
                        <span class="success-icon hidden -ml-6 text-green-700">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>
                    </div>
                    <div class="error text-red-700 py-2"></div>
                </div>
                <div class="formGroup flex flex-col my-4" style="display: none;">
                <label for="cpf">CPF</label>
                <div class="flex items-center">
                    <input id="cpf" name="cpf" type="text" class="w-full border-b-2 border-black outline-none py-2" value="'.$_SESSION['cpf'].'" disabled>
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
                <label for="razao_social">Razão Social</label>
                <div class="flex items-center">
                    <input id="razao_social" name="razao_social" type="text" class="w-full border-b-2 border-black outline-none py-2" value="'.$_SESSION['razao_social'].'" disabled>
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
                <label for="cnpj">CNPJ</label>
                <div class="flex items-center">
                    <input id="cnpj" name="cnpj" type="text" class="w-full border-b-2 border-black outline-none py-2" value="'.$_SESSION['cnpj'].'" disabled>
                    <span class="error-icon hidden -ml-6 text-red-700">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </span>
                    <span class="success-icon hidden -ml-6 text-green-700">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                </div>
                <div class="error text-red-700 py-2"></div>
            </div>';
                }
            ?>
                <div class="formGroup flex flex-col my-4">
                    <label for="telefone">Telefone</label>
                    <div class="flex items-center">
                        <input id="telefone" name="telefone" type="text" class="w-full border-b-2 border-black outline-none py-2" value="<?php echo ''.$_SESSION['telefone'].'';?>" disabled>
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
                    <label for="cep">CEP</label>
                    <div class="flex items-center">
                        <input id="cep" name="cep" type="text" class="w-full border-b-2 border-black outline-none py-2" value="<?php echo ''.$_SESSION['cep'].'';?>" disabled>
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
                    <label for="endereco">Endereço</label>
                    <div class="flex items-center">
                        <input id="endereco" name="endereco" type="text" class="w-full border-b-2 border-black outline-none py-2" value="<?php echo ''.$_SESSION['endereco'].'';?>" disabled>
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
                    <label for="email">E-mail</label>
                    <div class="flex items-center">
                        <input id="email" name="email" type="text" class="w-full border-b-2 border-black outline-none py-2" value="<?php echo ''.$_SESSION['email'].'';?>" readonly>
                        <span class="error-icon hidden -ml-6 text-red-700">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>
                        <span class="success-icon hidden -ml-6 text-green-700">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>
                    </div>
                    <div class="error text-red-700 py-2"></div>
                </div>
                <div id="btGroup">
                    <button id="salvar" class="btm bts" disabled>Salvar</button>
                    <button id="editar" class="btm" formaction="javascript:void(0);">Editar</button>
                </div>
            </form>
        </div>
    </main>

</div>

<?php include(DIRREQ."/lib/html/footer.php"); ?>