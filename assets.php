<?php 
    include("config/config.php");
    include(DIRREQ."/lib/html/header.php");
    $con= new Models\ModelConect;
    $con->conectDB();
?>

<h1>H1</h1>
<h2>H2</h2>
<h3>H3</h3>
<h4>H4</h4>
<h5>H5</h5>
<h6>H6</h6>

<br>

<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Velit excepturi fuga veritatis explicabo deleniti! Nulla tempora optio, impedit ducimus voluptatibus ea commodi sed? Ullam, doloremque. Asperiores officiis iste expedita culpa?</p>

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
<label class="custom-field">
    <input type="text" required>
    <span class="placeholder">Sem dados</span>
</label>

<label class="custom-field">
    <input type="number" required value="123">
    <span class="placeholder">Com dados preenchidos e validos</span>
</label>

<br><br>

<?php include(DIRREQ."/lib/html/footer.php"); ?>