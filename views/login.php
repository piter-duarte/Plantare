<?php
    include("../config/config.php");
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
    <main class="loginPage">
        <form id="loginForm" action="<?php echo DIRPAGE.'/controllers/ControllerLoginUser.php'; ?>" method="post">    
            <div class="formGroup flex flex-col my-4">
            <label for="email">Email</label>
            <div class="flex items-center">
                <input
                    name="email"
                    id="email"
                    type="email"
                    class="w-full border-b-2 border-black outline-none py-2"
                    required 
                    pattern="^(.+)@(.+)$"
                    autofocus
                >
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
                <label  for="senha">Senha</label>
                <div class="flex items-center">
                    <input
                        name="senha"
                        id="senha"
                        type="password"
                        class="w-full border-b-2 border-black outline-none py-2"
                        required 
                    >
                    <span class="error-icon hidden -ml-6 text-red-700">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </span>
                    <span class="success-icon hidden -ml-6 text-green-700">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                </div>
                <div class="error text-red-700 py-2"></div>
            </div>
            <button class="btg" type="submit">LOGIN</button>
        </form> 
    </main>
</div>

 

<?php include(DIRREQ."/lib/html/footer.php"); ?>