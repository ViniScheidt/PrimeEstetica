<?php
use PHPUnit\Framework\TestCase;

class CadastroProdutoTest extends TestCase
{
    private $pdo;
    private $stmtMock;

    protected function setUp(): void
    {
       
        $this->pdo = $this->createMock(PDO::class);

        
        $this->stmtMock = $this->createMock(PDOStatement::class);
        $this->stmtMock->method('execute')->willReturn(true);

       
        $this->pdo->method('prepare')->willReturn($this->stmtMock);

        
        global $pdo;
        $pdo = $this->pdo;

        
        $_POST = [
            "nome" => "Produto Teste",
            "preco" => "100",
            "descricao" => "Descrição do produto teste",
            "tipo" => 1,
            "subtipo" => 1
        ];

        $_FILES = [
            "imagem" => [
                "name" => "imagem_teste.jpg",
                "tmp_name" => "/caminho/temporario/imagem_teste.jpg",
                "type" => "image/jpeg"
            ]
        ];
    }

    public function testInsercaoDeProduto()
    {
        
        include 'caminho/para/seu/cadastro_produto.php';

        
        $this->pdo->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo('INSERT INTO produtos (nome, preco, descricao, id_tipo, id_subtipo, imagem) VALUES (?, ?, ?, ?, ?, ?)'));

        
        $this->stmtMock->expects($this->once())
            ->method('execute');
    }

    protected function tearDown(): void
    {
        $_POST = [];
        $_FILES = [];
    }
}
