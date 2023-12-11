document.addEventListener('DOMContentLoaded', function () {
    // Pega o ID do produto da URL
    const urlParams = new URLSearchParams(window.location.search);
    const produtoId = urlParams.get('id');
    
    // Verifique se o ID do produto está presente
    if (produtoId) {
        // Faça uma solicitação AJAX para buscar os detalhes do produto
        fetch(`produto.php?id=${produtoId}`)
            .then(response => response.json())
            .then(produto => {
                // Preencha os elementos HTML com os detalhes do produto
                document.getElementById('produto-nome').textContent = produto.nome;
                document.getElementById('produto-imagem').src = produto.imagem;
                document.getElementById('produto-descricao').textContent = produto.descricao;
                document.getElementById('produto-preco').textContent = `R$ ${produto.preco}`;
                document.getElementById('produto-comprar').href = `comprar.php?id=${produtoId}`;
            })
            .catch(error => {
                console.error('Erro ao buscar detalhes do produto:', error);
               
            });
    } else {
        console.error('ID do produto não especificado na URL');
   
    }
});


// Captura o botão "Adicionar ao Carrinho" e o campo de quantidade
const addToCartButton = document.getElementById('produto-comprar');
const quantityInput = document.getElementById('quantity');

// Define o evento de clique no botão "Adicionar ao Carrinho"
addToCartButton.addEventListener('click', function() {
    // Obtém a quantidade selecionada pelo usuário
    const quantity = quantityInput.value;
    
    // Atualiza o valor do campo oculto no formulário
    document.getElementById('quantidade-input').value = quantity;
    
    // Submete o formulário para a página carrinho.html
    document.getElementById('carrinho-form').submit();
});

// Define o evento de clique no botão "Adicionar ao Carrinho"
addToCartButton.addEventListener('click', function() {
    // Obtém a quantidade selecionada pelo usuário
    const quantity = quantityInput.value;
    
    // Obtém os dados do produto
    const produtoNome = document.getElementById('produto-nome').textContent;
    const produtoImagem = document.getElementById('produto-imagem').src;
    const produtoDescricao = document.getElementById('produto-descricao').textContent;
    const produtoPreco = document.getElementById('produto-preco').textContent;
    
    // Cria uma URL com os parâmetros
    const carrinhoUrl = `carrinho.html?quantidade=${quantity}&nome=${produtoNome}&imagem=${produtoImagem}&descricao=${produtoDescricao}&preco=${produtoPreco}`;
    
    // Redireciona o usuário para a página carrinho.html com os parâmetros
    window.location.href = carrinhoUrl;
});

document.addEventListener('DOMContentLoaded', function() {
    // Obtém os parâmetros da URL
    const urlParams = new URLSearchParams(window.location.search);
    const quantidade = urlParams.get('quantidade');
    const produtoNome = urlParams.get('nome');
    const produtoImagem = urlParams.get('imagem');
    const produtoDescricao = urlParams.get('descricao');
    const produtoPreco = urlParams.get('preco');

    // Exibe os dados do item do carrinho na página
    document.getElementById('carrinho-quantidade').textContent = quantidade;
    document.getElementById('carrinho-nome').textContent = produtoNome;
    document.getElementById('carrinho-imagem').src = produtoImagem;
    document.getElementById('carrinho-descricao').textContent = produtoDescricao;
    document.getElementById('carrinho-preco').textContent = produtoPreco;
});


