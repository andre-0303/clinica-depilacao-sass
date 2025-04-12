# 💆‍♀️ Sistema de Cadastro de Clientes - Depilação

Este é um sistema simples para cadastro, listagem e gerenciamento de clientes de um serviço de depilação. Desenvolvido com **PHP**, **MySQL** e **Tailwind CSS**, totalmente responsivo e fácil de usar.

## ✨ Funcionalidades

- Página inicial com acesso rápido para:
  - ✅ Cadastro de cliente
  - 📋 Listagem de clientes
- Cadastro de clientes:
  - Nome
  - Telefone com máscara (formato (00) 00000-0000, com até 11 dígitos)
  - Endereço
  - Seleção de múltiplos serviços com preços visíveis
  - Cálculo automático do valor total dos serviços escolhidos
- Listagem de clientes:
  - Exibe todos os dados cadastrados
  - Mostra os serviços escolhidos e o valor total
  - Mostra o status atual: `Pendente` ou `Concluído`
  - Botões de ação:
    - ✏️ Editar cliente
    - 🗑️ Excluir cliente
    - ✅ Marcar como concluído (sem recarregar a página)
  - Soma total de todos os serviços realizados

## 🛠 Tecnologias utilizadas

- **PHP** (backend)
- **MySQL** (banco de dados)
- **Tailwind CSS** (estilização responsiva)
- **JavaScript** (interações e requisições AJAX)
- **SweetAlert2** (para feedback visual moderno)

## 🔧 Como usar

1. Clone este repositório ou baixe os arquivos.
2. Crie o banco de dados MySQL:

```sql
CREATE DATABASE depilacao;
USE depilacao;

CREATE TABLE clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  telefone VARCHAR(20),
  endereco VARCHAR(255),
  servico TEXT,
  preco_total DECIMAL(10, 2),
  status VARCHAR(20) DEFAULT 'Pendente'
);
```

3. Altere os dados de conexão no arquivo `conexao.php`:

```php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "depilacao";
```

4. Execute o projeto localmente com um servidor como XAMPP, Laragon ou WAMP.
5. Acesse no navegador: `http://localhost/nome-da-pasta-do-projeto/`

## 📁 Estrutura de Arquivos

```
/seu-projeto
│
├── index.php             # Página inicial
├── cadastrar.php         # Formulário de cadastro
├── salvar_cliente.php    # Script que processa o cadastro
├── listar.php            # Lista os clientes cadastrados
├── editar.php            # Edita os dados de um cliente
├── excluir.php           # Exclui um cliente
├── concluir.php          # Marca cliente como concluído (via fetch)
├── conexao.php           # Arquivo de conexão com o banco
└── README.md             # Este arquivo
```

## 📱 Responsividade

O sistema foi desenvolvido com Tailwind CSS e se adapta automaticamente para celular, tablet ou desktop. A tabela de clientes é responsiva com rolagem horizontal em telas pequenas.

## 🤝 Contribuições

Você pode contribuir com melhorias, correções ou sugestões abrindo um pull request ou issue neste repositório.
