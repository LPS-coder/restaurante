<?php
require_once __DIR__ . '/../infra/conexao.php';

$mensagem = '';

$stmt_users = $pdo->query("SELECT * FROM usuarios ORDER BY nome ASC");
$usuarios = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'] ?? '';
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = $_POST['preco'] ?? '';
    $categoria = trim($_POST['categoria'] ?? '');

    if (empty($usuario_id) || empty($nome) || empty($descricao) || empty($preco) || empty($categoria)) {
        $mensagem = "Preencha todos os campos!";
    } else {

        $sql = "INSERT INTO pratos (usuario_id, nome, descricao, preco, categoria) VALUES (:usuario_id, :nome, :descricao, :preco, :categoria)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':nome'       => $nome,
            ':descricao'  => $descricao,
            ':preco'      => $preco,
            ':categoria'  => $categoria
        ]);
        $mensagem = "Prato cadastrado com sucesso!";
    }
}
?>
