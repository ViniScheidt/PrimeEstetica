<?php
session_start(); 


// Carregar as variáveis de ambiente do arquivo .env
$lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;
    list($name, $value) = explode('=', $line, 2);
    $_ENV[$name] = trim($value);
}

// Conectar ao banco de dados
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$pass = $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obter os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar a consulta SQL
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    

    // Verificar senha
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Login bem-sucedido

        // Armazenar informações do usuário na sessão
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_cargo'] = $usuario['id_cargo'];

        // Redirecionar para a página inicial
        header('Location: index.php');
        exit(); 
    } else {
        
    }

} catch (PDOException $e) {
    echo "Erro no login: " . $e->getMessage();
}
