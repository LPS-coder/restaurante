# Sistema de Gerenciamento de Pratos - Restaurante

Sistema web para controle centralizado e gestão de pratos cadastrados pelos colaboradores de um restaurante, desenvolvido em PHP, MySQL, HTML5 e CSS3. A aplicação utiliza Prepared Statements (PDO) para garantia de segurança e executa em ambiente local via XAMPP.

---

## Nota sobre o Desenvolvimento Individual

Este projeto foi originalmente proposto como uma atividade em dupla. Devido a problemas de saúde que causaram minha ausência no primeiro dia da atividade, o trabalho foi realizado e concluído individualmente por mim (Artur Lopes). Durante o desenvolvimento da estrutura e lógica do sistema, utilizei ferramentas de inteligência artificial como suporte técnico para consulta e apoio no aprendizado.

---

## Funcionalidades Implementadas

O sistema atende aos seguintes requisitos:

- **Cadastro de Usuários:** Permite cadastrar colaboradores informando nome e e-mail.
- **Cadastro de Pratos:** Associa cada prato ao usuário responsável pelo registro, salvando nome, descrição, preço e categoria.
- **Listagem Geral:** Exibe todos os pratos cadastrados e identifica o colaborador responsável por cada um.
- **Edição de Registros:** Permite alterar as informações de pratos previamente salvos.
- **Exclusão de Registros:** Permite remover pratos do banco de dados.
- **Filtro por Usuário:** Permite filtrar e visualizar apenas os pratos vinculados a um usuário específico.
- **Validação:** Impede o envio de formulários com campos obrigatórios vazios.
- **Segurança de Dados:** Utiliza Prepared Statements (PDO) nas consultas ao banco de dados para prevenção contra SQL Injection.

---

## Estrutura do Projeto

O código foi organizado separando os arquivos da camada pública das configurações de infraestrutura:

```text
restaurante/
├── infra/
│   ├── conexao.php      # Arquivo de conexão PDO com o MySQL
│   └── database.sql     # Script de criação do banco de dados e tabelas
└── public/
    ├── cadastrar_prato.php   # Formulário e inserção de pratos
    ├── cadastrar_usuario.php # Formulário e inserção de usuários
    ├── editar_prato.php      # Edição dos pratos cadastrados
    ├── excluir_prato.php     # Exclusão de pratos
    └── index.php             # Dashboard com a tabela principal e filtros

---

http://localhost:444/artur_lopes_2026/restaurante/public/index.php 


