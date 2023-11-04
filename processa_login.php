<?php
// Conexão com o banco de dados
$host = "127.0.0.1"; // Endereço do servidor de banco de dados
$user = "root"; // Usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "primeestetica"; // Nome do banco de dados

// Criar conexão
$conn = new mysqli($host, $user, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificação e tratamento das entradas
$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

// Preparando a consulta SQL
$sql = "SELECT id, senha, id_cargo FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);

// Executa a consulta
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Verifica a senha
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha'])) {
        // Inicia a sessão e armazena o id_cargo
        session_start();
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['id_cargo'] = $row['id_cargo'];

        // Redireciona para a página principal
        header("Location: index.php");
        exit();
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Usuário não encontrado!";
}

// Fecha a conexão
$conn->close();
?>
