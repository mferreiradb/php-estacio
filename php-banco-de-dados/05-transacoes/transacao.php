<?php

require __DIR__ . '/../01-conexao/conexao.php';

$pdo = conectar();

function transferir(PDO $pdo, string $de, string $para, float $valor): void
{
    $pdo->beginTransaction();

    try {
        $debito = $pdo->prepare('UPDATE usuarios SET saldo = saldo - :v WHERE email = :e AND saldo >= :v');
        $debito->execute(['v' => $valor, 'e' => $de]);

        if ($debito->rowCount() === 0) {
            throw new RuntimeException('Saldo insuficiente');
        }

        $credito = $pdo->prepare('UPDATE usuarios SET saldo = saldo + :v WHERE email = :e');
        $credito->execute(['v' => $valor, 'e' => $para]);

        $pdo->commit();
        echo "Transferência de $valor concluída" . PHP_EOL;
    } catch (Throwable $e) {
        $pdo->rollBack();
        echo "Falhou, rollback: " . $e->getMessage() . PHP_EOL;
    }
}

transferir($pdo, 'ana@exemplo.com', 'bruno@exemplo.com', 30);
transferir($pdo, 'ana@exemplo.com', 'bruno@exemplo.com', 1000);
