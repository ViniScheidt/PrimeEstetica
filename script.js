document.addEventListener('DOMContentLoaded', function () {
    // Pega o ID do produto da URL
    const urlParams = new URLSearchParams(window.location.search);
    const produtoId = urlParams.get('id');
    
    if (produtoId) {
        fetch(`produto.php?id=${produtoId}`)
            .then(response => response.json())
            .then(produto => {
                document.getElementById('produto-nome').textContent = produto.nome;
                document.getElementById('produto-imagem').src = produto.imagem;
                document.getElementById('produto-descricao').textContent = produto.descricao;
                document.getElementById('produto-preco').textContent = `R$ ${produto.preco}`;
                
                // Evento de clique no botão "Adicionar ao Carrinho"
                document.getElementById('produto-comprar').addEventListener('click', function(event) {
                    event.preventDefault();
                    const produtoData = {
                        id: produtoId,
                        nome: produto.nome,
                        imagem: produto.imagem,
                        descricao: produto.descricao,
                        preco: produto.preco,
                        quantidade: document.getElementById('quantity').value
                    };
                       // Adiciona ao carrinho
                      localStorage.setItem(produtoId, JSON.stringify(produtoData));
                      alert('Produto adicionado ao carrinho! Clique em OK para ir para o carrinho.');
                      window.location.href = 'carrinho.html';
                });
            })
            .catch(error => {
                console.error('Erro ao buscar detalhes do produto:', error);
            });
    } else {
        console.error('ID do produto não especificado na URL');
    }
});
