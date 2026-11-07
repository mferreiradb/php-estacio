<?php

require __DIR__ . '/../01-conexao/conexao.php';

$pdo = conectar();

$entrada = "' OR '1'='1";

// VULNERÁVEL: concatenação direta
$inseguro = $pdo->query("SELECT * FROM usuarios WHERE nome = '$entrada'")->fetchAll();
echo "Inseguro retornou " . count($inseguro) . " linhas" . PHP_EOL;

// SEGURO: prepared statement
$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE nome = :nome');
$stmt->execute(['nome' => $entrada]);
echo "Seguro retornou " . count($stmt->fetchAll()) . " linhas" . PHP_EOL;
