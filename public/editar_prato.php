<?php
require_once __DIR__ . '/../infra/conexao.php';

$id = $_GET['id'] ?? '';

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM pratos WHERE id = :id");
$stmt->execute([':id' => $id]);
$prato = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$prato) {
    header("Location: index.php");
    exit;
}

$usuarios = $pdo->query("SELECT * FROM usuarios ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'] ?? '';
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = $_POST['preco'] ?? '';
    $categoria = trim($_POST['categoria'] ?? '');

    if (empty($usuario_id) || empty($nome) || empty($descricao) || empty($preco) || empty($categoria)) {
        $mensagem = "Preencha todos os campos!";
    } else {

        $sql = "UPDATE pratos SET usuario_id = :usuario_id, nome = :nome, descricao = :descricao, preco = :preco, categoria = :categoria WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':nome'       => $nome,
            ':descricao'  => $descricao,
            ':preco'      => $preco,
            ':categoria'  => $categoria,
            ':id'         => $id
        ]);
        header("Location: index.php");
        exit;
    }
}
?>
