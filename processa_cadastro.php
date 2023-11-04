<?php

// Configurações do banco de dados
$host = "127.0.0.1"; // Endereço do servidor de banco de dados local
$user = "root"; // Usuário padrão do MySQL
$password = ""; // Senha (vazia por padrão em ambientes locais)
$dbname = "primeestetica"; // Nome do seu banco de dados

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verifica se houve erro de conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Recebendo os dados do formulário
$email = $conn->real_escape_string($_POST['email']);
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
$nome = $conn->real_escape_string($_POST['nome']);
$cpf = $conn->real_escape_string($_POST['cpf']);
$data_nascimento = $conn->real_escape_string($_POST['data_nascimento']);
$endereco = $conn->real_escape_string($_POST['endereco']);

// Query SQL para inserir os dados na tabela
$sql = "INSERT INTO usuarios (email, senha, nome, cpf, data_nascimento, endereco) 
        VALUES ('$email', '$senha', '$nome', '$cpf', '$data_nascimento', '$endereco')";

// Executa a query
if ($conn->query($sql) === TRUE) {
    echo "Novo registro criado com sucesso";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Fecha a conexão
$conn->close();
?>
