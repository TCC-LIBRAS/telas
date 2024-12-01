<?php
session_start(); // Inicia a sessão
ob_start(); // Habilita o buffer de saída
include_once "config.php"; // Conexão com o banco de dados

// Verificação de erro de conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Capturar dados do formulário
$usuario = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

// Verificar se os campos foram preenchidos
if (empty($usuario) || empty($senha)) {
    echo "<script>alert('Por favor, preencha todos os campos.'); window.location.href = 'http://localhost/tcc/index.php';</script>";
    exit();
}

// Preparar a consulta para verificar o e-mail
$sql = "SELECT id_usuario, email, senha, nome, telefone, nivel FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conn->error);
}

$stmt->bind_param('s', $usuario); // 's' indica que o parâmetro é uma string
$stmt->execute();
$stmt->store_result(); // Armazena os resultados para verificar se há linhas retornadas

// Verificar se o usuário foi encontrado
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $email, $senha_db, $nome, $telefone, $nivel); // Associa os resultados às variáveis
    $stmt->fetch(); // Busca os resultados

    // Verificar se a senha está correta
    if (password_verify($senha, $senha_db)) {
        // Configurar variáveis de sessão
        $_SESSION['id_usuario'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $nome;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['nivel'] = $nivel; // Armazena o nível do usuário na sessão

        // Redirecionar para a página principal com base no nível de acesso
        if ($nivel == 'admin') {
            header('Location: http://localhost/tcc/painel_admin.php'); // Página de administração
        } else {
            header('Location: http://localhost/tcc/home.php'); // Página normal do usuário
        }
        exit();
    } else {
        echo "<script>alert('Email ou senha incorreto.'); window.location.href = 'http://localhost/tcc/index.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Usuário não encontrado.'); window.location.href = 'http://localhost/tcc/index.php';</script>";
    exit();
}

// Fechar a conexão e o prepared statement
$stmt->close();
$conn->close();
?>
