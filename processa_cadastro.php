<?php


$lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;
    list($name, $value) = explode('=', $line, 2);
    $_ENV[$name] = trim($value);
}


$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$pass = $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recebendo os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];

    // Preparando a consulta SQL para inserção dos dados
    $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha, nome, cpf, data_nascimento, endereco, id_cargo) VALUES (?, ?, ?, ?, ?, ?, 1)");
    $stmt->execute([$email, $senha, $nome, $cpf, $data_nascimento, $endereco]);
    

    echo "Usuário cadastrado com sucesso.";

} catch (PDOException $e) {
    die("Erro no cadastro: " . $e->getMessage());
}
