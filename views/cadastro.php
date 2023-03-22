<?php
   include("../config/config.php");
   include(DIRREQ."/lib/html/header.php");
?>

<div class="container">
    <header>
        <div class="logo">
            <a class="img-logo" href="<?php echo DIRPAGE.'/index.php'; ?>">
                <img class="img-logo" src="<?php echo DIRPAGE.'/lib/img/LogoAlterada.png'; ?>">
            </a>
            <h5>Plantare</h5>
        </div>
    </header>
    <main class="cadastroPage">
        <div class="formAlign">
            <form id="formCadastro" action="<?php echo DIRPAGE.'/controllers/cadastroController.php'; ?>"
                method="post">
                <div class="formCadastro_radiobox">
                    <div class="formCadastro_radios">
                        <input type="radio" name="tipo_pessoa" id="tipo_pessoa_f" value="0" checked> <label
                            for="tipo_pessoa_f">Pessoa Física</label>
                    </div>
                    <div class="formCadastro_radios">
                        <input type="radio" name="tipo_pessoa" id="tipo_pessoa_j" value="1"> <label
                            for="tipo_pessoa_j">Pessoa Jurídica</label>
                    </div>
                </div>
                <div class="formCadastro_content">
                    <div id="form-pessoa-fisica">
                        <div class="formGroup flex flex-col my-2">
                            <label for="nome">Nome Completo</label>
                            <div class="flex items-center">
                                <input id="nome" name="nome" type="text"
                                    class="w-full border-b-2 border-black outline-none py-2" required>
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
                    <div id="form-pessoa-juridica" style="display: none;">
                        <div class="formGroup flex flex-col my-2">
                            <label for="razao_social">Razão Social</label>
                            <div class="flex items-center">
                                <input id="razao_social" name="razao_social" type="text"
                                    class="w-full border-b-2 border-black outline-none py-2">
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

                    <div class="formGroup flex flex-col my-2">
                        <label for="email">E-mail</label>
                        <div class="flex items-center">
                            <input id="email" name="email" type="email"
                                class="w-full border-b-2 border-black outline-none py-2" required pattern="^(.+)@(.+)$">
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
                        <label for="senha">Senha</label>
                        <div class="flex items-center">
                            <input id="senha" name="senha" type="password"
                                class="w-full border-b-2 border-black outline-none py-2" required>
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
                        <label for="confirmeSenha">Confirme sua senha</label>
                        <div class="flex items-center">
                            <input id="confirmeSenha" type="password"
                                class="w-full border-b-2 border-black outline-none py-2" required match="senha">
                            <span class="error-icon hidden -ml-6 text-red-700">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </span>
                            <span class="success-icon hidden -ml-6 text-green-700">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                        </div>
                        <div class="error text-red-700 py-2"></div>
                    </div>

                    <div class="formEnd">
                        <label class="checkbox" for="ehProvedorId">
                            <input class="checkbox__input" type="checkbox" name="ehProvedor" id="ehProvedorId">
                            <div class="checkbox__box"></div>
                            Deseja prestar serviços ?
                        </label>

                        <input class="button" type="submit" value="Cadastrar">
                    </div>
                </div>
            </form>
        </div>
    </main>
    <?php 
    include(DIRREQ."/lib/html/footer.php");
 ?>