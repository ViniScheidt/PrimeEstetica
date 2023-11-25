


function inicializarProdutos(categoria = '') {
    const container = document.getElementById('lista-produtos');
    container.innerHTML = ''; 

    let produtosFiltrados = produtos;
    if (categoria) {
        produtosFiltrados = produtos.filter(produto => produto.categoria === categoria);
    }

    produtosFiltrados.forEach(produto => {
        container.innerHTML += `
            <div class="col-md-4 card-produto">
                <img src="${produto.imagem}" alt="${produto.nome}">
                <h3>${produto.nome}</h3>
                <p>R$ ${produto.preco}</p>
                <button onclick="mostrarDetalhes(${produto.id})">Ver Detalhes</button>
            </div>
        `;
    });
}


function mostrarDetalhes(id) {
    const produto = produtos.find(p => p.id === id);
    const conteudo = `
        <h3>${produto.nome}</h3>
        <img src="${produto.imagem}" alt="${produto.nome}">
        <p>${produto.descricao}</p>
        <p>Preço: R$ ${produto.preco}</p>
    `;
    document.getElementById('conteudo-produto').innerHTML = conteudo;
    document.getElementById('produtos').style.display = 'none';
    document.getElementById('detalhes-produto').style.display = 'block';
}


function voltarParaProdutos() {
    document.getElementById('detalhes-produto').style.display = 'none';
    document.getElementById('produtos').style.display = 'block';
    inicializarProdutos(); // Reexibir todos os produtos
}


function filtrarPorCategoria(categoria) {
    inicializarProdutos(categoria);
}


document.addEventListener('DOMContentLoaded', () => inicializarProdutos());
