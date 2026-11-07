<?php

require __DIR__ . '/../01-conexao/conexao.php';

$pdo = conectar();

// Parâmetros nomeados com bindValue (valor é copiado no momento do bind)
$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE saldo >= :minimo');
$stmt->bindValue(':minimo', 60, PDO::PARAM_INT);
$stmt->execute();
print_r($stmt->fetchAll());

// Parâmetros posicionais
$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE nome = ? AND saldo >= ?');
$stmt->execute(['Ana', 10]);
print_r($stmt->fetchAll());

// bindParam (vincula a variável por referência; vale o valor no momento do execute)
$email = 'ana@exemplo.com';
$stmt = $pdo->prepare('SELECT nome FROM usuarios WHERE email = :email');
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
echo $stmt->fetchColumn() . PHP_EOL;

$email = 'bruno@exemplo.com'; // reaproveita o mesmo statement com outro valor
$stmt->execute();
echo $stmt->fetchColumn() . PHP_EOL;
