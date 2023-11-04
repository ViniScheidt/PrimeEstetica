// Dados dos produtos com categoria
const produtos = [
    // Produtos para a categoria "Vidros"
    { id: 1, nome: "Limpa Vidros", preco: 25.99, descricao: "Produto para limpeza de vidros sem deixar marcas.", imagem: "url_da_imagem", categoria: "vidros" },
    { id: 2, nome: "Cristalizador de Vidros", preco: 35.99, descricao: "Cria uma camada protetora nos vidros.", imagem: "url_da_imagem", categoria: "vidros" },
    // Produtos para a categoria "Lataria"
    { id: 3, nome: "Cera de Polimento", preco: 59.99, descricao: "Cera de alta qualidade para polimento e brilho intenso.", imagem: "url_da_imagem", categoria: "lataria" },
    // ... Adicione mais produtos para as outras categorias ...
];

// Função para inicializar a listagem de produtos
function inicializarProdutos(categoria = '') {
    const container = document.getElementById('lista-produtos');
    container.innerHTML = ''; // Limpar a área de produtos

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

// Função para mostrar detalhes do produto
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

// Função para voltar para a lista de produtos
function voltarParaProdutos() {
    document.getElementById('detalhes-produto').style.display = 'none';
    document.getElementById('produtos').style.display = 'block';
    inicializarProdutos(); // Reexibir todos os produtos
}

// Função para filtrar produtos por categoria
function filtrarPorCategoria(categoria) {
    inicializarProdutos(categoria);
}

// Inicializando a listagem de produtos
document.addEventListener('DOMContentLoaded', () => inicializarProdutos());
