<?php

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

    // Buscar tipos
    $stmtTipos = $pdo->query("SELECT id, nome FROM tipo");
    $tipos = $stmtTipos->fetchAll(PDO::FETCH_ASSOC);

    // Buscar subtipos
    $stmtSubtipos = $pdo->query("SELECT id, nome FROM subtipo");
    $subtipos = $stmtSubtipos->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Coleta os dados do formulário
        $nome = $_POST["nome"];
        $preco = $_POST["preco"];
        $descricao = $_POST["descricao"];
        $tipoId = $_POST["tipo"];  // ID do tipo selecionado
        $subtipoId = $_POST["subtipo"];  // ID do subtipo selecionado

        // Trata o upload da imagem
        $imagem = $_FILES["imagem"]["name"];
        $imagem_temp = $_FILES["imagem"]["tmp_name"];

        // AWS S3
        $s3Client = new Aws\S3\S3Client([
            'version'     => 'latest',
            'region'      => $_ENV['AWS_DEFAULT_REGION'],
            'credentials' => [
                'key'    => $_ENV['AWS_ACCESS_KEY_ID'],
                'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
            ],
        ]);

        $bucketName = $_ENV['S3_BUCKET_NAME'];
        $key = 'uploads/' . basename($imagem);

        try {
            // Upload da imagem para o S3
            $result = $s3Client->putObject([
                'Bucket' => $bucketName,
                'Key'    => $key,
                'SourceFile' => $imagem_temp,
                'ContentType' => $_FILES["imagem"]["type"]
            ]);

            $imagemUrl = $result['ObjectURL'];

            // Prepara a instrução SQL para inserção
            $sql = "INSERT INTO produtos (nome, preco, descricao, id_tipo, id_subtipo, imagem) VALUES (?, ?, ?, ?, ?, ?)";

            // Prepara a instrução e faz o bind dos parâmetros
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $preco, $descricao, $tipoId, $subtipoId, $imagemUrl]);

            echo "Produto inserido com sucesso.";
        } catch (Aws\S3\Exception\S3Exception $e) {
            echo "Erro no upload da imagem: " . $e->getMessage();
        }
    }
    if (isset($_GET['action']) && $_GET['action'] == 'fetch_options') {
        try {
            $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Buscar tipos e subtipos
            $stmtTipos = $pdo->query("SELECT id, nome FROM tipo");
            $tipos = $stmtTipos->fetchAll(PDO::FETCH_ASSOC);
    
            $stmtSubtipos = $pdo->query("SELECT id, nome FROM subtipo");
            $subtipos = $stmtSubtipos->fetchAll(PDO::FETCH_ASSOC);
    
            // Responder com JSON
            header('Content-Type: application/json');
            echo json_encode(['tipos' => $tipos, 'subtipos' => $subtipos]);
            exit;
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }


} catch (PDOException $e) {
    echo "Erro de conexão com o banco: " . $e->getMessage();
}

?>
