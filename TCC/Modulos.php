<?php
    session_start();
    ob_start();
    include_once "src/php/config.php";

    include 'src/php/verifica_autenticacao.php';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <title>Módulos</title>

</head>

<body>

    <nav id="sidebar">
        <div id="sidebar_content">
            <div id="img">
                <img src="src/imagens/Maãos-removebg-preview 1.png" alt="">
            </div>

            <ul id="side_items">
                <li class="side-item">
                    <a href="Home.php">
                        <i class="fa-solid fa-house" style="color: #000000;"></i>
                        <span class="item-description">
                            Home
                        </span>
                    </a>
                </li>

                <li class="side-item active">
                    <a href="Modulos.php">
                        <i class="fa-solid fa-qrcode" style="color: #000000;"></i>
                        <span class="item-description">
                            Modulos
                        </span>
                    </a>
                </li>

                <li class="side-item">
                    <a href="perfilPessoa.php">
                        <i class="fa-solid fa-user" style="color: #000000;"></i>
                        <span class="item-description">
                            Perfil
                        </span>
                    </a>
                </li>
            </ul>

            <button id="open_btn">
                <i id="open_btn_icon" class="fa-solid fa-chevron-right" style="color: #000000;"></i>
            </button>
        </div>

        <div class="sair">
            <button type="button"class="btn_sair" value="Sair">
                <i class="material-symbols-outlined">
                    logout
                </i>
                <span>
                    Sair
                </span>
            </button>
        </div>
    </nav>

    <header id="cabecalho">
        <div id="barraDePesquisa">
            <div id="icone">
                <span id="icone-pesquisa" class="material-symbols-outlined"> search </span> 
            </div>
            <input id="pesquisar" type="text" placeholder="Pesquisar módulos">
        </div>
    </header>

    <main>
        <div class="container">
            
        </div>

        

    </main>
    <script src="src/javascript/script.js"></script>
</body>

</html>
