<?php
// Conectar ao banco de dados
include_once "config.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $nivel = $_POST['nivel'];

    // Alterar o nível do usuário
    $sql = "UPDATE usuarios SET nivel = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $nivel, $id_usuario);

    if ($stmt->execute()) {
        echo "<script>alert('Nível alterado com sucesso!'); window.location.href = '../../painel_admin.php';</script>";
    } else {
        echo "<script>alert('Erro ao alterar nível.'); window.location.href = '../../painel_admin.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
