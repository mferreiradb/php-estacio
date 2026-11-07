<?php

declare(strict_types=1);

require __DIR__ . '/db.php';

$pdo->exec("
    CREATE TABLE IF NOT EXISTS usuarios (
        id       SERIAL PRIMARY KEY,
        email    VARCHAR(255) NOT NULL UNIQUE,
        senha    VARCHAR(255) NOT NULL,
        criado_em TIMESTAMP DEFAULT NOW()
    )
");

echo "Tabela 'usuarios' pronta.\n";
