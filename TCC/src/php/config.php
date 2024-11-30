<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$bdname = 'sinaliza';

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $pass, $bdname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
