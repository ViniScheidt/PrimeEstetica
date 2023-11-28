<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$pass = $_ENV['DB_PASSWORD'];

try {
    // Crie uma nova conexão PDO
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifique se o ID do produto foi fornecido na URL
    if (isset($_GET['id'])) {
        $produtoId = $_GET['id'];

        // Consulta SQL para buscar os detalhes do produto com base no ID
        $stmt = $pdo->prepare("SELECT nome, descricao, preco, imagem FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $produtoId);
        $stmt->execute();

        // Verifique se o produto foi encontrado
        if ($stmt->rowCount() > 0) {
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            // Retorne os detalhes do produto como JSON
            header('Content-Type: application/json');
            echo json_encode($produto);
        } else {
            // Produto não encontrado, retorne um JSON com uma mensagem de erro
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Produto não encontrado']);
        }
    } else {
        // ID do produto não foi fornecido na URL, retorne um JSON com uma mensagem de erro
        header('Content-Type: application/json');
        echo json_encode(['error' => 'ID do produto não especificado']);
    }
} catch (PDOException $e) {
    // Em caso de erro, retorne um JSON com uma mensagem de erro
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Erro na consulta ao banco de dados: ' . $e->getMessage()]);
}
?>
