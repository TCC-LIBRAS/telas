<?php

// Inicia a sessão se ainda não estiver iniciada.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Declarando variáveis para conectar ao banco de dados.
$host = "localhost";
$username = "root";
$password = "";
$dbName = "sinaliza";

// Conectando ao servidor MySQL.
$conn = new mysqli($host, $username, $password);

// Verifica se houve erro na conexão com o servidor MySQL.
if ($conn->connect_error) {
    die("Erro ao conectar ao servidor de banco de dados: " . $conn->connect_error);
} else {
    // echo "Conectado ao servidor com sucesso!<br>";
}

// Criando o banco de dados 'sinaliza' se ele não existir.
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if ($conn->query($sql) === TRUE) {
    // echo "Banco de dados '$dbName' criado com sucesso!<br>";
} else {
    echo "Erro ao criar banco de dados: " . $conn->error;
}

// Reestabelece a conexão ao banco de dados específico 'sinaliza'.
$conn = new mysqli($host, $username, $password, $dbName);

// Verifica se houve erro na conexão com o banco de dados específico.
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Consultas para criar as tabelas, se não existirem.
$tableQueries = [
    "usuarios" => "CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    nascimento DATE NOT NULL,
    telefone INT(21) NULL,
    nome VARCHAR(100) NOT NULL,
    nick VARCHAR(100) DEFAULT NULL,
    nivel enum('usuario','admin') DEFAULT 'usuario'
)",

"modulos" => "CREATE TABLE IF NOT EXISTS modulos (
    id_modulo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(500) NULL
)",

"progresso_usuario" => "CREATE TABLE IF NOT EXISTS progresso_usuario (
    id_progresso_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT DEFAULT NULL,
    id_modulo INT DEFAULT NULL,
    status enum('iniciado', 'concluido') DEFAULT 'iniciado',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_modulo) REFERENCES modulos(id_modulo) ON DELETE CASCADE
)",

"recuperacao_senha" => "CREATE TABLE IF NOT EXISTS recuperacao_senha (
    id_recuperacao INT AUTO_INCREMENT PRIMARY KEY,
    id_usuarios INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    data_expiracao DATETIME NOT NULL,
    FOREIGN KEY (id_usuarios) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
)",

"videoaulas" => "CREATE TABLE IF NOT EXISTS videoaulas (
    id_videoaula INT AUTO_INCREMENT PRIMARY KEY,
    id_modulo INT DEFAULT NULL,
    titulo VARCHAR(100) NOT NULL,
    url_video VARCHAR(255) NOT NULL,
    descricao VARCHAR(500) NOT NULL,
    FOREIGN KEY (id_modulo) REFERENCES modulos(id_modulo) ON DELETE CASCADE
)",

"atividades" => "CREATE TABLE IF NOT EXISTS atividades (
    id_atividade INT AUTO_INCREMENT PRIMARY KEY,
    id_modulo INT NOT NULL,
    id_videoaula INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao VARCHAR(500) NULL,
    FOREIGN KEY (id_modulo) REFERENCES modulos(id_modulo) ON DELETE CASCADE,
    FOREIGN KEY (id_videoaula) REFERENCES videoaulas(id_videoaula) ON DELETE CASCADE
)"

];

// Itera sobre o array de consultas para criar as tabelas no banco de dados.
 foreach ($tableQueries as $tableName => $sqlTable) {
    if ($conn->query($sqlTable) === TRUE) {
        // echo "Tabela '$tableName' criada com sucesso!<br>";
    } else {
        echo "Erro ao criar a tabela '$tableName': " . $conn->error . "<br>";
    }
}