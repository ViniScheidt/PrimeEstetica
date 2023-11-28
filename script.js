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


// Array para armazenar os itens no carrinho
let carrinhoItens = [];

// Função para adicionar um item ao carrinho
function adicionarItemAoCarrinho(produto) {
    const itemExistente = carrinhoItens.find(item => item.produto.id === produto.id);

    if (itemExistente) {
        itemExistente.quantidade += 1;
    } else {
        carrinhoItens.push({ produto, quantidade: 1 });
    }

    atualizarCarrinho();
}

// Função para remover um item do carrinho
function removerItemDoCarrinho(produtoId) {
    carrinhoItens = carrinhoItens.filter(item => item.produto.id !== produtoId);
    atualizarCarrinho();
}

// Função para atualizar a exibição do carrinho de compras
function atualizarCarrinho() {
    const carrinhoItemsContainer = document.getElementById('carrinho-items');
    carrinhoItemsContainer.innerHTML = '';

    carrinhoItens.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.produto.nome}</td>
            <td>R$ ${item.produto.preco.toFixed(2)}</td>
            <td>
                <input type="number" value="${item.quantidade}" min="1" onchange="atualizarQuantidade(${item.produto.id}, this.value)">
            </td>
            <td>R$ ${(item.produto.preco * item.quantidade).toFixed(2)}</td>
        `;

        carrinhoItemsContainer.appendChild(row);
    });
}

// Função para atualizar a quantidade de um item no carrinho
function atualizarQuantidade(produtoId, novaQuantidade) {
    novaQuantidade = parseInt(novaQuantidade);
    const itemExistente = carrinhoItens.find(item => item.produto.id === produtoId);

    if (itemExistente && novaQuantidade >= 1) {
        itemExistente.quantidade = novaQuantidade;
        atualizarCarrinho();
    }
}

// Função para exibir o carrinho na página
function exibirCarrinho() {
    atualizarCarrinho();
}

// Chamada da função para exibir o carrinho quando a página carregar
exibirCarrinho();

// Captura elementos HTML
const decrementButton = document.getElementById('decrement');
const incrementButton = document.getElementById('increment');
const quantityInput = document.getElementById('quantity');
const addToCartButton = document.getElementById('produto-comprar');

// Define o evento de clique no botão de incremento
incrementButton.addEventListener('click', function() {
    // Incrementa a quantidade em 1
    quantityInput.value = parseInt(quantityInput.value) + 1;
});

// Define o evento de clique no botão de decremento
decrementButton.addEventListener('click', function() {
    // Verifica se a quantidade é maior que 1 antes de decrementar
    if (parseInt(quantityInput.value) > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
    }
});

// Define o evento de clique no botão "Adicionar ao Carrinho"
addToCartButton.addEventListener('click', function() {
    // Redireciona para a página carrinho.html e envia a quantidade como parâmetro
    const quantity = quantityInput.value;
    window.location.href = `carrinho.html?quantidade=${quantity}`;
});




