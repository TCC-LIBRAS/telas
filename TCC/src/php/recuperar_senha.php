<?php
session_start();
include_once "config.php"; // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificador = trim($_POST['identificador']); // Captura o valor enviado pelo formulário



    // Verificar se o identificador é um email válido ou um nick
    if (filter_var($identificador, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT id_usuario FROM usuarios WHERE email = ?";
    } else {
        $sql = "SELECT id_usuario FROM usuarios WHERE nick = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $identificador);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario);
        $stmt->fetch();

        // Armazenar o ID do usuário na sessão para ser usado na próxima etapa
        $_SESSION['id_usuario'] = $id_usuario;

        // Redirecionar para a página de redefinição de senha
        header('Location: http://localhost/tcc/red.senha.html');
        exit();
    } else {
        echo "<script>alert('Usuário ou email não encontrado.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Acesso inválido.'); window.location.href = 'http://localhost/tcc/index.php';</script>";
}
?>
