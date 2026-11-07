<?php

require __DIR__ . '/../01-conexao/conexao.php';

$pdo = conectar();

// Create
$stmt = $pdo->prepare('INSERT OR IGNORE INTO usuarios (nome, email) VALUES (:nome, :email)');
$stmt->execute(['nome' => 'Carla', 'email' => 'carla@exemplo.com']);
echo "Inserido com id " . $pdo->lastInsertId() . PHP_EOL;

// Read
foreach ($pdo->query('SELECT * FROM usuarios') as $u) {
    echo "{$u['id']} - {$u['nome']} ({$u['email']})" . PHP_EOL;
}

// Update
$stmt = $pdo->prepare('UPDATE usuarios SET nome = :nome WHERE email = :email');
$stmt->execute(['nome' => 'Carla Silva', 'email' => 'carla@exemplo.com']);
echo "Linhas atualizadas: " . $stmt->rowCount() . PHP_EOL;

// Delete
$stmt = $pdo->prepare('DELETE FROM usuarios WHERE email = :email');
$stmt->execute(['email' => 'carla@exemplo.com']);
echo "Linhas removidas: " . $stmt->rowCount() . PHP_EOL;
