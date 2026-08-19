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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Prato</title>
</head>
<body>
    <h2>Cadastrar Prato (RF2)</h2>
    <?php if ($mensagem): ?><p><?= $mensagem ?></p><?php endif; ?>
    <form method="POST">
        <label>Usuário Responsável:</label><br>
        <select name="usuario_id" required>
            <option value="">Selecione um usuário</option>
            <?php foreach ($usuarios as $u): ?>
                <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nome']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Nome do Prato:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao" required></textarea><br><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" required><br><br>

        <label>Categoria:</label><br>
        <input type="text" name="categoria" required><br><br>

        <button type="submit">Cadastrar Prato</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>

