<?php

require __DIR__ . '/../01-conexao/conexao.php';

class Usuario
{
    public int $id;
    public string $nome;
    public string $email;
    public float $saldo;
}

$pdo = conectar();

// Uma linha como array associativo
$linha = $pdo->query('SELECT * FROM usuarios LIMIT 1')->fetch(PDO::FETCH_ASSOC);
print_r($linha);

// Uma linha como objeto genérico (stdClass)
$obj = $pdo->query('SELECT * FROM usuarios LIMIT 1')->fetch(PDO::FETCH_OBJ);
echo $obj->nome . PHP_EOL;

// Todas as linhas mapeadas para uma classe
$usuarios = $pdo->query('SELECT * FROM usuarios')->fetchAll(PDO::FETCH_CLASS, Usuario::class);
foreach ($usuarios as $u) {
    echo "{$u->id}: {$u->nome}" . PHP_EOL;
}

// Um único valor
echo "Total: " . $pdo->query('SELECT COUNT(*) FROM usuarios')->fetchColumn() . PHP_EOL;

// Coluna inteira como lista
print_r($pdo->query('SELECT nome FROM usuarios')->fetchAll(PDO::FETCH_COLUMN));

// Pares chave => valor (primeira coluna é a chave)
print_r($pdo->query('SELECT id, nome FROM usuarios')->fetchAll(PDO::FETCH_KEY_PAIR));
