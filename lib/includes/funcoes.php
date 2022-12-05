<?php

use Models\PessoaFisica;

        function chamarHeader($nomePagina) 
        {
            echo
            "
            <header>
                <h4>$nomePagina</h4>
            </header>
            ";
        }
    
        function chamarNavbar($usuario)
        {
            echo '
                    <div class="navbar">
                    <div class="userInfo">
                        <img id="img-user" src="'.DIRPAGE.'/lib/img/userImage.png" alt="">
                        <h5>
                ';
                if($usuario instanceof PessoaFisica)
                {
                    echo $usuario->getNome();
                }
                else
                {
                    echo $usuario->getRazao_social();
                }
            echo '</h5>
                  <div class="stars">
                 ';
                if($usuario->getEhProvedor() == 1)
                {
                    switch ($usuario->getMedia()) 
                    {
                        case 1:
                            echo'
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm starEmpty"></i>
                                    <i class="fa-solid fa-star fa-sm starEmpty"></i>
                                    <i class="fa-solid fa-star fa-sm starEmpty"></i>
                                    <i class="fa-solid fa-star fa-sm starEmpty"></i>
                                ';
                            break;
                        case 2:
                            echo'
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm starEmpty"></i>
                                    <i class="fa-solid fa-star fa-sm starEmpty"></i>
                                    <i class="fa-solid fa-star fa-sm starEmpty"></i>
                                ';
                            break;
                        case 3:
                            echo'
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm starEmpty"></i>
                                    <i class="fa-solid fa-star fa-sm starEmpty"></i>
                                ';
                            break;
                        case 4:
                            echo'
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm starEmpty"></i>
                                ';
                            break;
                        default:
                            echo'
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm "></i>
                                    <i class="fa-solid fa-star fa-sm "></i>
                                ';
                            break;
                    }
                }
            echo '  </div>
    
                    </div>
                    <div class="divider"></div>
                    <div class="options">
                        <a href="meuPerfil.php">
                            <div class="item">
                                <i class="fa-solid fa-heart"></i>   
                                <h5>Meu Perfil</h5>
                            </div>
                        </a>
                        <a href="meuCalendario.php">
                        <div class="item">
                            <i class="fa-solid fa-heart"></i>   
                            <h5>Meu Calendário</h5>
                        </div>
                    </a>'; 
                    
            if($usuario->getEhProvedor() == 1)
            {
                echo '
                <a href='.DIRPAGE.'/views/manager/meusServicos.php>
                    <div class="item">
                        <i class="fa-solid fa-heart"></i>   
                        <h5>Meus Serviços</h5>
                    </div>
                </a>'; 
            }
            else
            {
                echo '
                <a href="cadastrarServicos.php">
                    <div class="item">
                        <i class="fa-solid fa-heart"></i>   
                        <h5>Cadastrar Serviços</h5>
                    </div>
                </a>';  
            }
            echo'
                        <a href="'.DIRPAGE.'/index.php">
                            <div class="item">
                                <i class="fa-solid fa-heart"></i>   
                                <h5>Sair</h5>
                            </div>
                        </a>
                    </div>
                </div>
            ';
        }
