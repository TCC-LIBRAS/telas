<?php
include_once "src/php/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./src/css/StyleLog.css">
</head>
<body>
    <main id="principal">
        <h1 id="principalTitulo">Login</h1>
        <form action="src/php/login.php" method="post">
           
            <section id="principalConteudo">
                <div id="principalCampos">
           
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="inputCampos" placeholder="Insira seu email" required>
           
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="inputCampos" placeholder="Insira sua senha" required>
           
                    <a href="Rec.senha.html">Esqueci minha senha</a>
           
                </div>

                <div id="principalBotoes">
            
                <input type="button" value="Cadastre-se" onclick="window.location.href='Cadastro.html';">
                <input type="submit" value="Entrar">

                </div>

            </section>
        </form>
    </main>
</body>
</html>