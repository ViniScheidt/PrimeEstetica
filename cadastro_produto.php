

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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


    // Coleta os dados do formul�rio
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];
    
    // Trata o upload da imagem (voc� deve adicionar valida��o e seguran�a aqui)
    $imagem = $_FILES["imagem"]["name"];
    $imagem_temp = $_FILES["imagem"]["tmp_name"];
    
    // Move a imagem para um diret�rio de uploads
    move_uploaded_file($imagem_temp, "diretorio_de_uploads/" . $imagem);
    
    // Prepara a instru��o SQL para inser��o
    $sql = "INSERT INTO produtos (nome, preco, categoria, imagem) VALUES (?, ?, ?, ?)";
    
    // Prepara a instru��o e faz o bind dos par�metros
    $stmt = $$conn->prepare($sql);
    $stmt->bind_param("sdsb", $nome, $preco, $categoria, $imagem);

    // Executa a inser��o
    if ($stmt->execute()) {
        echo "Produto inserido com sucesso.";
    } else {
        echo "Erro ao inserir o produto: " . $stmt->error;
    }

    // Fecha a conex�o com o banco de dados
    $$conn->close();
}
?>
