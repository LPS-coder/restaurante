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