<?php
   include ("../config/config.php");
   session_start();
   $_SESSION['usuarioCadastrado'] = true;
   echo "<script>window.location.replace('".DIRPAGE."/views/manager/continuacaoCadastro.php');</script>";
?>