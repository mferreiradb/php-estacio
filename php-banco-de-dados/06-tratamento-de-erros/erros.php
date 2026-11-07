<?php

require __DIR__ . '/../01-conexao/conexao.php';

$pdo = conectar();

// Violação de UNIQUE: email duplicado
try {
    $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email) VALUES (:nome, :email)');
    $stmt->execute(['nome' => 'Outra Ana', 'email' => 'ana@exemplo.com']);
} catch (PDOException $e) {
    echo "Mensagem: " . $e->getMessage() . PHP_EOL;
    echo "SQLSTATE: " . $e->getCode() . PHP_EOL;
    print_r($e->errorInfo);
}

// SQL inválido
try {
    $pdo->query('SELECT * FROM tabela_inexistente');
} catch (PDOException $e) {
    echo "Erro de SQL: " . $e->getMessage() . PHP_EOL;
}

// Modos de erro: ERRMODE_SILENT (padrão antigo), ERRMODE_WARNING e ERRMODE_EXCEPTION
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo->query('SELECT * FROM tabela_inexistente'); // emite warning em vez de exceção
