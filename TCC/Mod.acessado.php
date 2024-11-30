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
    <link rel="stylesheet" href="./src/css/StyleMod.Acessado.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <title>Aula</title>
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
    </nav>

    <header>
        <h1>Iniciando em libras</h1>
        <div class="progresso">
            <span class="material-symbols-outlined">
                schedule
            </span>
            <p class="cargaHoraria">Carga horaria 5h</p>            
        </div>
    </header>

    <main>
        <div class="container-esquerdo">
            <div class="botoes">
                <div class="botao-acesso">
                    <span class="material-symbols-outlined">
                        play_arrow
                    </span>
                    <a href="AulaAlfabeto.html">Acessar curso</a>
                </div>
                <div class="botao-favorito">
                    <span class="material-symbols-outlined">
                        star
                    </span>
                    <a href=" ">Favoritar</a>
                </div>
            </div>

            <div class="resumo">
                <h1>Aprenda nesse curso</h1>
                <ul>
                    <li>O básico para começar a se comunicar</li>
                    <li>O alfabeto e os números</li>
                    <li>Expressões diárias</li>
                </ul>
            </div>

            <div class="acesso-rapido">
                <div class="opcoes-aulas">
                    <a href="AulaAlfabeto.html" class="btn_text">Iniciando com alfabeto e números</a>
                    <p>25min</p>
                </div>
                <div class="opcoes-aulas">
                    <a href="AulaOI.html" class="btn_text">Expressões do dia a dia</a>
                    <p>25min</p>
                </div>
            </div>

        </div>

        <div class="container-direito">
            <div class="infos-prof">
                <h1 class="titulo-prof">Professor</h1>
                <div class="perfil-prof">
                    <img src="./src/imagens/Foto de Apresentação.jpg" class="foto-prof">
                    <h1 class="nome-prof">Kaytlen</h1>
                </div>
                <p class="descri-prof">
                    Licenciada e quase formanda pelo UniProjeção em Pedagogia, aspirante a
                    pesquisadora e professora docente nas linhas de pesquisas sobre Inteligência Artificial,
                    Gamificação e Heutagogia e estagiária na equipe acadêmica de Pós - graduação Stricto Sensu 
                    em Direito do Instituto Brasileiro de Ensino, Desenvolvimento e Pesquisa - IDP.
                    Estudos autodidatas com reforço de projetos sociais de ensino de libras para pessoas 
                    em vulnerabilidade social.
                </p>

            </div>
        </div>
    </main>

    <script src="./src/javascript/aulas.js"></script>
    
</body>
</html>


