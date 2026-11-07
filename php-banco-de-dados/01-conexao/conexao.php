<?php

function conectar(): PDO
{
    $pdo = new PDO('sqlite:' . __DIR__ . '/../estudo.db', null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $pdo->exec(file_get_contents(__DIR__ . '/../sql/schema.sql'));

    return $pdo;
}

// Para MySQL, troque o DSN:
// new PDO('mysql:host=localhost;dbname=estudo;charset=utf8mb4', 'usuario', 'senha', [...]);

if (realpath($argv[0] ?? '') === __FILE__) {
    $pdo = conectar();
    echo "Conectado. Usuários: " . $pdo->query('SELECT COUNT(*) FROM usuarios')->fetchColumn() . PHP_EOL;
}
