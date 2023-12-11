<?php
session_start(); // Inicia a sessão PHP

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php'; 

// Carrega o arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Conexão com o banco de dados PostgreSQL
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$pass = $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Busca os produtos no banco de dados
    $stmt = $pdo->query("SELECT id, nome, preco, imagem FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro de conexão com o banco: " . $e->getMessage();
    $produtos = []; // Define produtos como um array vazio em caso de erro
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Estética</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-produto {
            margin: 10px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
        .card-produto img {
            max-width: auto;
            height: 150;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Prime Estética</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item dropdown">
                <?php
                if (isset($_SESSION['usuario_cargo']) && $_SESSION['usuario_cargo'] == 2) {
                    echo '<a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    echo 'Administração';
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="adminDropdown">';
                    echo '<a class="dropdown-item" href="cadastro_produto.html">Cadastro de Produto</a>';
                    // Adicione mais links de administração aqui se necessário
                    echo '</div>';
                }
                ?>
            </li>
            <!-- Verifica se o usuário tem cargo 1 ou 2 -->
            <?php if (isset($_SESSION['usuario_cargo']) && in_array($_SESSION['usuario_cargo'], [1, 2])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="sair.php">Sair</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="cadastro.html">Cadastre-se</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.html">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Seção de Produtos -->
<div id="produtos" class="container mt-4">
    <h2>Produtos</h2>
    <div class="row" id="lista-produtos">
        <?php foreach ($produtos as $produto): ?>
            <div class="col-md-4 card-produto">
            <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" width="100" height="100">
                <h3><?= htmlspecialchars($produto['nome']) ?></h3>
                <p>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                <a href="produto.html?id=<?= $produto['id'] ?>" class="btn btn-primary">Ver mais detalhes</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script.js"></script>
</body>
</html>
