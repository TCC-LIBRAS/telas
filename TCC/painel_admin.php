<?php
session_start();

// Verificar se o usuário está logado e se é um administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['nivel'] != 'admin') {
    header('Location: http://localhost/tcc/index.php'); // Redireciona para o login se não for admin
    exit();
}

// Inclui o arquivo de configuração e a lógica para listar e alterar usuários
include_once "src/php/config.php"; 

// Listar usuários
$sql = "SELECT id_usuario, nome, email, nivel FROM usuarios";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Painel de Administração</title>
</head>
<body>

    <h1>Bem-vindo ao Painel de Administração!</h1>
    <p>Aqui você pode gerenciar os usuários e outras funcionalidades de administrador.</p>

    <?php
    if ($result->num_rows > 0) {
        echo "<h2>Usuários Cadastrados</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nível</th>
                    <th>Ações</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['nivel'] . "</td>";
            echo "<td>
                    <form action='src/php/alterar_nivel.php' method='post'>
                        <input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>
                        <select name='nivel'>
                            <option value='usuario'" . ($row['nivel'] == 'usuario' ? ' selected' : '') . ">Usuário</option>
                            <option value='admin'" . ($row['nivel'] == 'admin' ? ' selected' : '') . ">Administrador</option>
                        </select>
                        <input type='submit' value='Alterar'>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nenhum usuário encontrado.";
    }
    ?>

    <p><a href="logout.php">Sair</a></p>

    <p><a href="inicio_admin.php">acesso</a></p>

</body>
</html>

<?php
$conn->close();
?>
