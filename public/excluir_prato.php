<?php
require_once __DIR__ . '/../infra/conexao.php';

$id = $_GET['id'] ?? '';

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM pratos WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header("Location: index.php");
exit;
?>
