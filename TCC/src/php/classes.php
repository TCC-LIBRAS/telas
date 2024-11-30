<?php

class Usuario {

    // Propriedades privadas para armazenar informações do usuário
    private $id;      // ID do usuário
    private $nome;    // Nome do usuário
    private $email;   // Email do usuário
    private $senha;   // Senha do usuário

    private $conn;    // Conexão com o banco de dados

    // Construtor da classe
    public function __construct() {
        try {
            // Configuração da conexão com o banco de dados
            $caminho = "mysql:dbname=sinaliza;host=localhost"; // DSN do banco de dados
            $usuario = "root"; // Usuário do banco de dados
            $senha   = "";     // Senha do banco de dados

            // Cria uma nova conexão PDO
            $this->conn = new PDO($caminho, $usuario, $senha);
            // Define o modo de erro para lançar exceções
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // echo "Conectado! <br> <br> <br>";

        } catch (\Throwable $th) {
            // Captura erros de conexão e exibe mensagem
            echo "Não conectado =(";
        }
    }

    // Método para inserir um novo usuário no banco de dados
    public function inserirUsuario($nome, $email, $senha) {
        // SQL para inserir dados do usuário
        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (:n, :e, :s)";
        // Prepara a instrução SQL
        $stmt = $this->conn->prepare($sql);
        // Associa os parâmetros com os valores
        $stmt->bindValue(":n", $nome);
        $stmt->bindValue(":e", $email);
        $stmt->bindValue(":s", $senha); // **Aqui deve ser feita a hash da senha antes de armazenar**

        // Executa a instrução e retorna o resultado (true ou false)
        return $stmt->execute();
    }

 // Método para mostrar todos os dados dos usuários
 public function mostrarDados() {
    $sql = "SELECT * FROM teste";
    $res = $this->conn->query($sql);
    
    // Verifica se a consulta retornou resultados
    if ($res->rowCount() > 0) {
        return $res->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os resultados como um array
    } else {
        return []; // Retorna um array vazio se não houver resultados
    }
}
}
