<?php

include_once "config.php";

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