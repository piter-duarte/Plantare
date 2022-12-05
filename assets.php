<?php 
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
?>

<h1>H1</h1>
<h2>H2</h2>
<h3>H3</h3>
<h4>H4</h4>
<h5>H5</h5>
<h6>H6</h6>

<br>

<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Velit excepturi fuga veritatis explicabo deleniti! Nulla
    tempora optio, impedit ducimus voluptatibus ea commodi sed? Ullam, doloremque. Asperiores officiis iste expedita
    culpa?</p>

<br>

<a href="">link</a>
<br> <br>

<button class="btg">CONECTE-SE</button>
<button class="btm">LOGIN</button>
<button class="btp">OK</button>
<br> <br>
<button class="btg bts">CONECTE-SE</button>
<button class="btm bts">LOGIN</button>
<button class="btp bts">OK</button>
<br> <br>
<input type="radio" name="test" id="1"> <label for="1"> Not checked </label>
<br>
<input type="radio" name="test" id="2" checked> <label for="2"> Checked </label>
<br><br>
<label class="checkbox" for="myCheckboxId1">
    <input class="checkbox__input" type="checkbox" name="myCheckboxName" id="myCheckboxId1">
    <div class="checkbox__box"></div>
    Not checked
</label>
<br><br>
<label class="checkbox" for="myCheckboxId2">
    <input class="checkbox__input" type="checkbox" name="myCheckboxName" id="myCheckboxId2" checked>
    <div class="checkbox__box"></div>
    Checked
</label>
<br><br>
<form id="registrationForm" action="">
    <div class="formGroup flex flex-col my-4">
        <label for="firstName">First Name</label>
        <div class="flex items-center">
            <input id="firstName" type="text" class="w-full border-b-2 border-black outline-none py-2" required
                minlength="2" custommaxlength="5">
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
        <label for="email">Email Address</label>
        <div class="flex items-center">
            <input id="email" type="email" class="w-full border-b-2 border-black outline-none py-2" required
                pattern="^(.+)@(.+)$">
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
        <label for="password">Password</label>
        <div class="flex items-center">
            <input id="password" type="password" class="w-full border-b-2 border-black outline-none py-2" required>
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
        <label for="confirmPassword">Confirm Password</label>
        <div class="flex items-center">
            <input id="confirmPassword" type="password" class="w-full border-b-2 border-black outline-none py-2"
                required match="password">
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
        <label for="date">Date</label>
        <div class="flex items-center">
            <input id="date" type="date" class="w-full border-b-2 border-black outline-none py-2" required>
            <span class="error-icon hidden -ml-6 text-red-700">
                <i class="fa-solid fa-circle-exclamation"></i>
            </span>
            <span class="success-icon hidden -ml-6 text-green-700">
                <i class="fa-solid fa-circle-check"></i>
            </span>
        </div>
        <div class="error text-red-700 py-2"></div>
    </div>

    <button id="testepop" type="submit">Register</button>
</form>

<?php include(DIRREQ."/lib/html/footer.php"); ?>