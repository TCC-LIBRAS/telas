<?php
session_start();
ob_start();
include_once "src/php/config.php";

include 'src/php/verifica_autenticacao.php';


// Inicializa variáveis
$nome = $telefone = $email = "";

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta as informações do usuário no banco de dados
$sql = "SELECT nome, telefone, email FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param('i', $id_usuario); // 'i' indica que o parâmetro é um inteiro
    $stmt->execute();
    $stmt->bind_result($nome, $telefone, $email); // Atribui os resultados às variáveis
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Erro na consulta: " . $conn->error;
}
// Verifique se o usuário está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario']; // Obtemos o ID do usuário logado

// Consultar os dados atuais do usuário
$query = "SELECT nome, email, telefone, senha FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->bind_result($nome, $email, $telefone, $senha_atual);
$stmt->fetch();
$stmt->close();

// Atualizar Nome
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_nome']) && isset($_POST['nome_opcional'])) {
    $novo_nome = $_POST['nome_opcional'];
    
    // Definindo que o novo nickname será o mesmo que o novo nome
    $novo_nick = $novo_nome;  // Aqui, o nickname será igual ao nome
    
    if (!empty($novo_nome)) {
        // Corrigindo a consulta SQL
        $query = "UPDATE usuarios SET nome = ?, nick = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $novo_nome, $novo_nick, $id_usuario);  // Passando ambos os parâmetros para atualização
        $stmt->execute();
        $stmt->close();

        // Atualizando as variáveis para exibição
        $nome = $novo_nome;
        $nick = $novo_nick;

        echo "<script>alert('Nome e Nick atualizados com sucesso!'); history.back();</script>";
    } 
}

// Atualizar Senha
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_senha']) && isset($_POST['nova_senha']) && isset($_POST['confirmar_senha'])) {
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    if ($nova_senha === $confirmar_senha && !empty($nova_senha)) {
        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET senha = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $nova_senha_hash, $id_usuario);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Senha atualizada com sucesso!'); history.back();</script>";
    } else {
        echo "<script>alert('As senhas não coincidem ou estão vazias.'); history.back();</script>";
    }
}

// Atualizar E-mail
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_email']) && isset($_POST['novo_email']) && isset($_POST['confirmar_troca'])) {
    $novo_email = $_POST['novo_email'];
    $senha_confirmacao = $_POST['confirmar_troca'];
    if (filter_var($novo_email, FILTER_VALIDATE_EMAIL) && password_verify($senha_confirmacao, $senha_atual)) {
        $query = "UPDATE usuarios SET email = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $novo_email, $id_usuario);
        $stmt->execute();
        $stmt->close();
        $email = $novo_email; // Atualiza o e-mail para exibir na página
        echo "<script>alert('Email atualizado com sucesso!'); history.back();</script>";
    } else {
        echo "<script>alert('Senha incorreta ou e-mail inválido.'); history.back();</script>";
    }
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/StylePP.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <title>Perfil</title>
</head>
<body>
    <nav id="sidebar">
        <div id="sidebar_content">
            <div id="img">
                <img src="src/imagens/Maãos-removebg-preview 1.png" alt="">
            </div>

            <ul id="side_items">
                <li class="side-item">
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

                <li class="side-item active">
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
    <main>
        <div class="infos-perfil">
            <div class="Desc-perfil">
                <img class="fotoPerfil" src="./src/imagens/Pessoa Perfil.jpg">
                <p class="nome-perfil"><?php echo htmlspecialchars($nome); ?></p>
            </div>
            <div class="infos-contato">
                <p>Número: <?php echo htmlspecialchars($telefone); ?></p>
                <p>Email: <?php echo htmlspecialchars($email); ?></p>
            </div>
        </div>
        <div class="progresso-perfil">
            <h1>Meu cursos</h1>
            <div class="main-infos">
                <div class="cards-dash">
                    <ol class="lista-conquistas">
                        <li class="conquista">
                            <div class="titulo-conquista-dash">
                                <span class="material-symbols-outlined">
                                    dashboard_customize
                                </span>
                                <h4>Módulos completos</h4>
                            </div>
                            <p class="num-att">7</p>
                        </li>
                        <li class="conquista">
                            <div class="titulo-conquista-dash">
                                <span class="material-symbols-outlined">
                                    schedule
                                </span>
                                <h4>Horas estudadas</h4>
                            </div>
                            <p class="num-att">7</p>
                        </li>
                    </ol>
                </div>
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
            
        </div>

        <form action="" method="post">
    <div class="configs">
        <h1>Configurações gerais</h1>

        <!-- Atualizar Nome -->
        <label class="titulo-configs">Me chame de </label>
        <input type="text" name="nome_opcional" class="input-configs" value="" />

        <input type="submit" name="submit_nome" class="confirm" value="Confirmar Nome">

        <!-- Atualizar Senha -->
        <label class="titulo-configs">Nova senha </label>
        <input type="password" name="nova_senha" class="input-configs" />

        <label class="titulo-configs">Confirmar senha </label>
        <input type="password" name="confirmar_senha" class="input-configs" />

        <input type="submit" name="submit_senha" class="confirm" value="Confirmar Senha">

        <!-- Atualizar E-mail -->
        <label class="titulo-configs">Mudar email </label>
        <input type="email" name="novo_email" class="input-configs" value="" />

        <label class="titulo-configs">Confirmar com senha </label>
        <input type="password" name="confirmar_troca" class="input-configs" />

        <input type="submit" name="submit_email" class="confirm" value="Confirmar Email">
    </div>
</form>

        <form action="src/php/logout.php">
        <input type="submit" class="Sair" value="Sair">
        </form>

    </main>
    <script src="./src/javascript/script.js"></script>
</body>
</html>