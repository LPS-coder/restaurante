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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Prato</title>
</head>
<body>
    <h2>Editar Prato</h2>
    <?php if ($mensagem): ?><p><?= $mensagem ?></p><?php endif; ?>
    <form method="POST">
        <label>Usuário Responsável:</label><br>
        <select name="usuario_id" required>
            <?php foreach ($usuarios as $u): ?>
                <option value="<?= $u['id'] ?>" <?= $u['id'] == $prato['usuario_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($u['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Nome do Prato:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($prato['nome']) ?>" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao" required><?= htmlspecialchars($prato['descricao']) ?></textarea><br><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" value="<?= $prato['preco'] ?>" required><br><br>

        <label>Categoria:</label><br>
        <input type="text" name="categoria" value="<?= htmlspecialchars($prato['categoria']) ?>" required><br><br>

        <button type="submit">Atualizar</button>
    </form>
    <a href="index.php">Cancelar</a>
</body>
</html>

