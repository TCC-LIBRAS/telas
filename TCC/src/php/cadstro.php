<?php
// Credenciais do banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$bdname = "sinaliza";

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $pass, $bdname);

// Verificação de erro de conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
} else {
    // Captura os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');
    $nascimento = filter_input(INPUT_POST, 'nascimento');
    $nomeUsuario = filter_input(INPUT_POST, 'nomeUsuario');
    $telefone = filter_input(INPUT_POST, 'telefone');

    // Verificação simples de campos vazios
    if (empty($nome) || empty($email) || empty($senha) || empty($nascimento) || empty($nomeUsuario) || empty($telefone)) {
        echo "<script>alert('Por favor, preencha todos os campos.'); history.back();</script>";
        exit();
    }

    // Verificar se o e-mail já existe no banco de dados
    $sql_check_email = "SELECT email FROM usuarios WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check_email);
    $stmt_check->bind_param('s', $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo "<script>alert('Este e-mail já está cadastrado.'); history.back();</script>";
        exit();
    }

    // Hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Definir o nível do usuário (por padrão 'usuario')
    $nivel = 'usuario'; // Para um usuário comum. Pode ser alterado para 'admin' em outro contexto.

    // Preparar a consulta para inserir dados no banco
    $sql = "INSERT INTO usuarios (nome, email, senha, nascimento, telefone, nick, nivel) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssss', $nome, $email, $senhaHash, $nascimento, $telefone, $nomeUsuario, $nivel);

    // Executar a consulta
    if ($stmt->execute()) {
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = 'http://localhost/tcc/index.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar usuário. Tente novamente.'); history.back();</script>";
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}
?>
