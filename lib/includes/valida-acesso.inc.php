<?php
 //o código dentro desta include verifica se a variável de sessão existe ou se o valor da variável de sessão é diferente de true
 session_start();
 if(!isset($_SESSION['conectado']) OR $_SESSION['conectado'] != true)
  {
    exit("<p style='width: 50%; border: 1px solid #777;
    padding: 20px; text-align: center; margin: 20px auto;'> Caro usuário, você precisar efetuar o cadastro ou o login para acessar este conteúdo restrito. Tente novamente! <br> 
    <a href='../../index.php' style='color: #000; text-align: center;'> Ir para a página de login </a>
    </p>");
  }