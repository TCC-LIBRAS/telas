<?php
include_once 'config.php'; // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificador = trim($_POST['identificador']);
    $nova_senha = trim($_POST['nova_senha']);
    $confirmar_senha = trim($_POST['confirmar_senha']);

    // Verificar se os campos foram preenchidos
    if (empty($identificador) || empty($nova_senha) || empty($confirmar_senha)) {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.history.back();</script>";
        exit();
    }

    // Verificar se as novas senhas coincidem
    if ($nova_senha !== $confirmar_senha) {
        echo "<script>alert('As novas senhas não coincidem.'); window.history.back();</script>";
        exit();
    }

    // Buscar o usuário pelo e-mail ou apelido
    $sql = "SELECT id_usuario FROM usuarios WHERE email = ? OR nick = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $identificador, $identificador);
    $stmt->execute();
    $stmt->bind_result($id_usuario);
    $stmt->fetch();
    $stmt->close();

    // Verificar se o usuário foi encontrado
    if (!$id_usuario) {
        echo "<script>alert('Usuário não encontrado.'); window.history.back();</script>";
        exit();
    }

    // Atualizar a senha no banco de dados
    $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    $sql_update = "UPDATE usuarios SET senha = ? WHERE id_usuario = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('si', $nova_senha_hash, $id_usuario);

    if ($stmt_update->execute()) {
        echo "<script>alert('Senha redefinida com sucesso!'); window.location.href = 'http://localhost/tcc/index.php';</script>";
    } else {
        echo "<script>alert('Erro ao redefinir a senha. Tente novamente.'); window.history.back();</script>";
    }

    $stmt_update->close();
    $conn->close();
} else {
    echo "<script>alert('Acesso inválido.'); window.location.href = 'http://localhost/tcc/index.php';</script>";
}
?>
