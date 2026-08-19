<?php
require_once __DIR__ . '/../infra/conexao.php';

$usuario_filtro = $_GET['usuario_id'] ?? '';

if (!empty($usuario_filtro)) {
    $sql = "SELECT pratos.*, usuarios.nome AS responsavel 
            FROM pratos 
            JOIN usuarios ON pratos.usuario_id = usuarios.id 
            WHERE pratos.usuario_id = :usuario_id 
            ORDER BY pratos.id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':usuario_id' => $usuario_filtro]);
} else {
    $sql = "SELECT pratos.*, usuarios.nome AS responsavel 
            FROM pratos 
            JOIN usuarios ON pratos.usuario_id = usuarios.id 
            ORDER BY pratos.id DESC";
    $stmt = $pdo->query($sql);
}

$pratos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$usuarios = $pdo->query("SELECT * FROM usuarios ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Pratos</title>
</head>
<body>
    <h1>Gerenciamento de Pratos</h1>

    <p>
        <a href="cadastrar_usuario.php">Cadastrar Usuário</a> | 
        <a href="cadastrar_prato.php">Cadastrar Prato</a>
    </p>

    <form method="GET">
        <label>Filtrar por Usuário :</label>
        <select name="usuario_id" onchange="this.form.submit()">
            <option value="">Todos os usuários</option>
            <?php foreach ($usuarios as $u): ?>
                <option value="<?= $u['id'] ?>" <?= $usuario_filtro == $u['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($u['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <a href="index.php">Limpar Filtro</a>
    </form>

    <br>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Responsável</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($pratos) > 0): ?>
                <?php foreach ($pratos as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['nome']) ?></td>
                        <td><?= htmlspecialchars($p['descricao']) ?></td>
                        <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($p['categoria']) ?></td>
                        <td><?= htmlspecialchars($p['responsavel']) ?></td>
                        <td>
                            <a href="editar_prato.php?id=<?= $p['id'] ?>">Editar</a> | 
                            <a href="excluir_prato.php?id=<?= $p['id'] ?>" onclick="return confirm('Deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">Nenhum prato encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>