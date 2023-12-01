# Sistema E-Commerce Prime Estética

Este repositório hospeda o sistema Prime Estética, uma solução e-commerce desenvolvida como projeto de conclusão de curso em Engenharia de Software pela Universidade Católica de Joinville-SC. O sistema oferece uma plataforma integrada para a visualização e aquisição de produtos de estética, proporcionando aos clientes uma ampla variedade de itens e uma experiência de compra confiável e segura.

## Visão Geral

O Prime Estética é uma aplicação web desenhada para otimizar a experiência de compra online no segmento de estética. Com funcionalidades como visualização detalhada de produtos, sistema de carrinho de compras, facilidade na adição de novos produtos pelo administrador, e filtros eficientes, o sistema visa melhorar significativamente a jornada de compra do usuário.

## Funcionalidades

- **Visualização de Itens**: Exibição clara com descrições detalhadas dos produtos.
- **Sistema de Carrinho**: Funcionalidade intuitiva para adicionar produtos ao carrinho de compras.
- **Gerenciamento de Produtos**: Interface administrativa simplificada para inserção e gestão de produtos.
- **Filtros Avançados**: Capacidade de filtrar produtos por tipo, subtipo e outras categorias.
- **Navegação Facilitada**: Interface projetada para facilitar a busca e seleção de produtos desejados pelo cliente.

## Tecnologias Utilizadas

- **Frontend**: HTML, CSS, SCSS, JavaScript.
- **Backend**: PHP.
- **Análise de Código**: PHPStan para assegurar a qualidade do código PHP.
- **Monitoramento de Desempenho**: New Relic para observabilidade e monitoramento em tempo real.
- **Banco de Dados**: PostgreSQL no AWS RDS.
- **Servidor**: AWS EC2 utilizando Ubuntu Server.

## Pré-requisitos

- Conhecimento em PHP, PostgreSQL, HTML, CSS, JavaScript e Ubuntu Server.
- Conta na AWS para utilização dos serviços RDS e EC2.

## Instalação e Configuração

### Instalação

1. Clone o repositório: `git clone https://github.com/seu-nome/PrimeEstetica.git`
2. Instale as dependências necessárias (PHP, PostgreSQL) no servidor.

### Configuração no AWS

#### Banco de Dados no RDS

1. Crie uma instância PostgreSQL no AWS RDS.
2. Configure o acesso público e ajuste as regras de segurança adequadas.

#### Servidor EC2

1. Crie uma instância EC2 com Ubuntu Server.
2. Configure as regras de segurança (HTTP, HTTPS, SSH).
3. Acesse a instância via SSH e configure o ambiente (Apache, PHP, etc.).

#### Hospedagem e Execução

1. Transfira os arquivos do projeto para a instância EC2.
2. Configure o Apache para servir os arquivos do projeto.
3. Atualize o arquivo `.env` com as credenciais do RDS.
4. Teste o sistema acessando o site.

## Uso do New Relic

O sistema utiliza o New Relic para monitoramento e análise de desempenho em tempo real. Esta ferramenta é essencial para identificar gargalos, monitorar transações e compreender a experiência do usuário, assegurando uma performance otimizada e uma rápida resolução de problemas.

## Testes de Funcionalidades

### Como Cliente

1. Acesse [Prime Estética](http://18.228.11.56).
2. Cadastre-se e faça login.
3. Navegue pelos produtos, selecione a quantidade desejada e adicione ao carrinho.
4. Finalize a compra, realize o pagamento via PIX e envie o comprovante.

### Como Administrador

1. Acesse o sistema com as credenciais de administrador (prime@estetica.com / 1234).
2. Na aba de administração, adicione novos produtos fornecendo os detalhes necessários.
3. Teste as funcionalidades de gestão de produtos.


## Contato

Para dúvidas ou colaborações, entre em contato com o autor, Vinicius Scheidt , pelo e-mail: vinische@hotmail.com.
