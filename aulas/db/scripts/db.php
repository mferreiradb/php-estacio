<?php

// Erros de tipo viram exceções em vez de conversão silenciosa
declare(strict_types=1);

$host   = getenv('DB_HOST')     ?: 'localhost';
$port   = getenv('DB_PORT')     ?: '5432';
$dbname = getenv('DB_NAME')     ?: 'app';
$user   = getenv('DB_USER')     ?: 'app';
$pass   = getenv('DB_PASSWORD') ?: 'secret';

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException) {
    http_response_code(503);
    exit('Não foi possível conectar ao banco de dados.');
}
// $pdo = null não é necessário: PHP destrói o objeto automaticamente ao fim da requisição
