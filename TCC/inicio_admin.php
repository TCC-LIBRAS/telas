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
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="./src/css/StyleHome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Home</title>
</head>

<body>
    <nav id="sidebar">
        <div id="sidebar_content">
            <div id="img">
                <img src="src/imagens/Maãos-removebg-preview 1.png" alt="">
            </div>

            <ul id="side_items">
                <li class="side-item active">
                    <a href="inicio_admin.php">
                        <i class="fa-solid fa-house" style="color: #000000;"></i>
                        <span class="item-description">
                            Home
                        </span>
                    </a>
                </li>

                <li class="side-item">
                    <a href="painel_admin.php">
                        <i class="fa-solid fa-qrcode" style="color: #000000;"></i>
                        <span class="item-description">
                            Admin
                        </span>
                    </a>
                </li>

                <li class="side-item">
                    <a href="perfilPessoa_admin.php">
                        <i class="fa-solid fa-user" style="color: #000000;"></i>
                        <span class="item-description">
                            Perfil
                        </span>
                    </a>
                </li>
            </ul>

    </nav>
    <main>
        <div class="conquistas">

            <h1 class="titulo-conquista">Conquistas</h1>
            <ol class="lista-conquistas">
                <li class="conquista">
                    <div class="titulo-conquista-dash">

                        <span class="material-symbols-outlined">
                            dashboard_customize
                        </span>
                        <h4>Módulos completos</h4>
                    </div>
                    <p class="num-att">
                     0
                </li>
                <li class="conquista">
                    <div class="titulo-conquista-dash">
                        <span class="material-symbols-outlined">
                            check
                        </span>
                        <h4>Certificados</h4>
                    </div>
                    <p class="num-att">
                  0
                    </p>
                </li>
                <li class="conquista">
                    <div class="titulo-conquista-dash">
                        <span class="material-symbols-outlined">
                            clock_loader_60
                        </span>
                        <h4>Em andamento</h4>
                    </div>
                    <p class="num-att">
                   0
                    </p>
                </li>
                <li class="conquista">
                    <div class="titulo-conquista-dash">
                        <span class="material-symbols-outlined">
                            schedule
                        </span>
                        <h4>Horas estudadas</h4>
                    </div>
                    <p class="num-att">
                
       0
                    </p>
                </li>
            </ol>

        </div>

        <div class="modulos-rec">
            <h1 class="titulo-modulos">Módulos recomendados</h1>
            <div class="container">
                <div>
                    <div class="card">
                        <a href="Mod.acessado.php">
                        <div class="card-main">
                            <img src="./src/imagens/ImagemModulo1.png">
                            <div class="main-infos-um">
                                <h3>O que é Libras e como foi criada</h3>
                            </div>
                            <div class="main-infos-dois">
                                <p>20 lições 40h</p>
                                <button><span class='material-symbols-outlined'>bookmark </span></button>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                
                <div>
                    <div class="card">
                        <a href="Mod.acessado.php">
                        <div class="card-main">
                            <img src="./src/imagens/Pessoas libras.png">
                            <div class="main-infos-um">
                                <h3>Gestos do dia a dia em libras</h3>
                            </div>
                            <div class="main-infos-dois">
                                <p>20 lições 40h</p>
                                <button><span class='material-symbols-outlined'>bookmark </span></button>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>

                <div>
                    <div class="card">
                        <a href="Mod.acessado.php">
                        <div class="card-main">
                            <img src="./src/imagens/ImagemModulo1.png">
                            <div class="main-infos-um">
                                <h3>Pedindo comida em um restaurante</h3>
                            </div>
                            <div class="main-infos-dois">
                                <p>20 lições 40h</p>
                                <button><span class='material-symbols-outlined'>bookmark </span></button>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="progresso">
            <h1>Meus módulos</h1>
            <div class="tabela-progresso">
                <table>
                    <thead>
                        <tr>
                            <th>Módulos</th>
                            <th>Lições</th>
                            <th>Status</th>
                            <th>Nível</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Iniciando em libras</td>
                            <td>5</td>
                            <td>Em andamento</td>
                            <td>Iniciante</td>
                        </tr>
                        <tr>
                            <td>Iniciando em libras</td>
                            <td>5</td>
                            <td>Em andamento</td>
                            <td>Iniciante</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="./src/javascript/script.js"></script>
    <script src="./src/javascript/teste.js"></script>
</body>

</html>