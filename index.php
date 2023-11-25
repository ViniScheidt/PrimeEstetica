<?php
session_start(); // Inicia a sessão PHP

echo "Usuário Cargo: " . (isset($_SESSION['usuario_cargo']) ? $_SESSION['usuario_cargo'] : "não definido");


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Estética</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <a href="login.html">Login</a>
<a href="cadastro.html">Cadastro</a>

    <style>
        .card-produto {
            margin: 10px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
        .card-produto img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>ds
<body>
    <!-- Navbar com Dropdown -->
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
                <!-- ... Restante do código ... -->

<!-- Dropdown para Filtros -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="filtroDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Externo
    </a>
    <div class="dropdown-menu" aria-labelledby="filtroDropdown">
        <a class="dropdown-item" href="#" onclick="filtrarPorCategoria('vidros')">Vidros</a>
        <a class="dropdown-item" href="#" onclick="filtrarPorCategoria('lataria')">Lataria</a>
        <a class="dropdown-item" href="#" onclick="filtrarPorCategoria('rodas e pneus')">Rodas e Pneus</a>
        <a class="dropdown-item" href="#" onclick="filtrarPorCategoria('plasticos')">Plásticos</a>
    </div>

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





            </ul>
        </div>
    </nav>
    
    <div id="detalhes-produto" class="container mt-4" style="display: none;">
        <h2>Detalhes do Produto</h2>
        <div id="conteudo-produto">
            <!-- Detalhes do produto serão carregados aqui -->
        </div>
        <button onclick="voltarParaProdutos()" class="btn btn-primary">Voltar aos Produtos</button>
    </div>




    <!-- Seção de Produtos -->
    <div id="produtos" class="container mt-4">
        <h2>Produtos</h2>
        <div class="row" id="lista-produtos">
            <!-- Os produtos serão carregados aqui via JavaScript -->
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
