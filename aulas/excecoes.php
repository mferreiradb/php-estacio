<?php

/*
Cada exemplo abaixo tem duas partes:
- o código mostrado na tela (dentro de <pre>), apenas como texto
- o mesmo código executado de verdade, no bloco verde
*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tratamento de exceções</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 0 16px;
            color: #222;
        }
        h1 {
            text-align: center;
        }
        h2 {
            margin-top: 40px;
            border-bottom: 2px solid #4a6fa5;
            padding-bottom: 4px;
        }
        pre {
            background: #f4f6fa;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 12px;
            overflow-x: auto;
        }
        pre.resultado {
            background: #e6f4ea;
            color: #1e5b2f;
            border-color: #b9dcc3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #4a6fa5;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f4f6fa;
        }
        code {
            background: #eef;
            padding: 2px 6px;
            border-radius: 3px;
        }
        table code {
            background: none;
            padding: 0;
        }
        .aviso {
            border-left: 5px solid #e0a800;
            background: #fffbe6;
            border-radius: 4px;
            padding: 8px 16px;
        }
    </style>
</head>
<body>
    <h1>Tratamento de exceções em PHP</h1>
    <p>Uma <strong>exceção</strong> é um objeto que representa um problema ocorrido durante a execução. Quando ela é lançada, o fluxo normal do programa é interrompido e o PHP procura um bloco que saiba tratá-la. Se ninguém tratar, o script termina com um erro fatal.</p>

    <h2>1. try e catch</h2>
    <p>O código que pode falhar vai em <code>try</code>. Se uma exceção for lançada ali dentro, o PHP pula para o <code>catch</code> correspondente.</p>
    <pre>try {
    echo "Antes\n";
    throw new Exception("Algo deu errado");
    echo "Depois (nunca executa)\n";
} catch (Exception $e) {
    echo "Capturada: " . $e->getMessage() . "\n";
}
echo "O programa continua";</pre>
    <pre class="resultado"><?php
    try {
        echo "Antes\n";
        throw new Exception("Algo deu errado");
        echo "Depois (nunca executa)\n";
    } catch (Exception $e) {
        echo "Capturada: " . $e->getMessage() . "\n";
    }
    echo "O programa continua";
    ?></pre>

    <h2>2. throw: lançando uma exceção</h2>
    <p>Use <code>throw new TipoDaExcecao("mensagem")</code> quando a função detectar uma situação inválida, em vez de devolver um valor estranho como <code>false</code> ou <code>-1</code>.</p>
    <pre>function dividir(float $a, float $b): float
{
    if ($b == 0) {
        throw new InvalidArgumentException("O divisor não pode ser zero");
    }
    return $a / $b;
}

try {
    echo dividir(10, 2) . "\n";
    echo dividir(10, 0) . "\n";
} catch (InvalidArgumentException $e) {
    echo "Erro: " . $e->getMessage();
}</pre>
    <pre class="resultado"><?php
    function dividir(float $a, float $b): float
    {
        if ($b == 0) {
            throw new InvalidArgumentException("O divisor não pode ser zero");
        }
        return $a / $b;
    }

    try {
        echo dividir(10, 2) . "\n";
        echo dividir(10, 0) . "\n";
    } catch (InvalidArgumentException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?></pre>

    <h2>3. Informações da exceção</h2>
    <p>O objeto capturado carrega dados sobre o problema:</p>
    <table>
        <thead>
            <tr>
                <th>Método</th>
                <th>Devolve</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><code>getMessage()</code></td><td>A mensagem informada ao criar a exceção</td></tr>
            <tr><td><code>getCode()</code></td><td>Um código numérico opcional</td></tr>
            <tr><td><code>getFile()</code></td><td>O arquivo onde foi lançada</td></tr>
            <tr><td><code>getLine()</code></td><td>A linha onde foi lançada</td></tr>
            <tr><td><code>getTrace()</code> / <code>getTraceAsString()</code></td><td>A pilha de chamadas até o ponto do erro</td></tr>
            <tr><td><code>getPrevious()</code></td><td>A exceção anterior, quando há encadeamento (exemplo 8)</td></tr>
        </tbody>
    </table>
    <pre>try {
    throw new RuntimeException("Falha ao processar", 42);
} catch (RuntimeException $e) {
    echo "Classe: " . get_class($e) . "\n";
    echo "Mensagem: " . $e->getMessage() . "\n";
    echo "Código: " . $e->getCode() . "\n";
    echo "Arquivo: " . basename($e->getFile());
}</pre>
    <pre class="resultado"><?php
    try {
        throw new RuntimeException("Falha ao processar", 42);
    } catch (RuntimeException $e) {
        echo "Classe: " . get_class($e) . "\n";
        echo "Mensagem: " . $e->getMessage() . "\n";
        echo "Código: " . $e->getCode() . "\n";
        echo "Arquivo: " . basename($e->getFile());
    }
    ?></pre>

    <h2>4. Hierarquia: Throwable, Exception e Error</h2>
    <p>Tudo que pode ser lançado com <code>throw</code> implementa a interface <code>Throwable</code>. Ela tem dois ramos principais:</p>
    <pre>Throwable
├── Exception            (problemas que o programa pode tratar)
│   ├── RuntimeException
│   ├── InvalidArgumentException
│   ├── LogicException
│   ├── PDOException
│   └── ...
└── Error                (erros internos da linguagem, PHP 7+)
    ├── TypeError
    ├── ValueError
    ├── ArgumentCountError
    ├── DivisionByZeroError
    └── ...</pre>
    <p>Capturar <code>Exception</code> <strong>não</strong> pega um <code>Error</code>. Para pegar os dois, use <code>Throwable</code>.</p>

    <h2>5. Vários catch e multi-catch</h2>
    <p>Pode haver vários <code>catch</code> em sequência. O PHP usa o <strong>primeiro</strong> que combina com o tipo, então coloque os mais específicos antes dos genéricos. Com <code>|</code> um mesmo bloco trata mais de um tipo (PHP 7.1+).</p>
    <pre>function processar(mixed $valor): void
{
    if (!is_numeric($valor)) {
        throw new InvalidArgumentException("Valor não numérico");
    }
    if ($valor &lt; 0) {
        throw new RangeException("Valor negativo");
    }
    echo "Processado: $valor\n";
}

foreach ([5, "abc", -3] as $v) {
    try {
        processar($v);
    } catch (InvalidArgumentException | RangeException $e) {
        echo get_class($e) . ": " . $e->getMessage() . "\n";
    } catch (Exception $e) {
        echo "Outro erro: " . $e->getMessage() . "\n";
    }
}</pre>
    <pre class="resultado"><?php
    function processar(mixed $valor): void
    {
        if (!is_numeric($valor)) {
            throw new InvalidArgumentException("Valor não numérico");
        }
        if ($valor < 0) {
            throw new RangeException("Valor negativo");
        }
        echo "Processado: $valor\n";
    }

    foreach ([5, "abc", -3] as $v) {
        try {
            processar($v);
        } catch (InvalidArgumentException | RangeException $e) {
            echo get_class($e) . ": " . $e->getMessage() . "\n";
        } catch (Exception $e) {
            echo "Outro erro: " . $e->getMessage() . "\n";
        }
    }
    ?></pre>

    <h2>6. finally</h2>
    <p>O bloco <code>finally</code> roda <strong>sempre</strong>, com ou sem exceção. É o lugar certo para liberar recursos: fechar arquivo, encerrar conexão, destravar algo.</p>
    <pre>function ler(bool $falhar): void
{
    echo "Abrindo recurso\n";
    try {
        if ($falhar) {
            throw new Exception("Erro na leitura");
        }
        echo "Leitura ok\n";
    } catch (Exception $e) {
        echo "Tratando: " . $e->getMessage() . "\n";
    } finally {
        echo "Fechando recurso\n\n";
    }
}

ler(false);
ler(true);</pre>
    <pre class="resultado"><?php
    function ler(bool $falhar): void
    {
        echo "Abrindo recurso\n";
        try {
            if ($falhar) {
                throw new Exception("Erro na leitura");
            }
            echo "Leitura ok\n";
        } catch (Exception $e) {
            echo "Tratando: " . $e->getMessage() . "\n";
        } finally {
            echo "Fechando recurso\n\n";
        }
    }

    ler(false);
    ler(true);
    ?></pre>

    <h2>7. Exceções personalizadas</h2>
    <p>Crie sua própria classe estendendo <code>Exception</code> (ou uma filha dela). Isso dá nome ao problema e permite <code>catch</code> específico e dados extras.</p>
    <pre>class SaldoInsuficienteException extends Exception
{
    public function __construct(private float $saldo, private float $valor)
    {
        parent::__construct("Saldo $saldo insuficiente para sacar $valor");
    }

    public function getFalta(): float
    {
        return $this->valor - $this->saldo;
    }
}

function sacar(float $saldo, float $valor): float
{
    if ($valor &gt; $saldo) {
        throw new SaldoInsuficienteException($saldo, $valor);
    }
    return $saldo - $valor;
}

try {
    echo sacar(100, 30) . "\n";
    echo sacar(50, 80) . "\n";
} catch (SaldoInsuficienteException $e) {
    echo $e->getMessage() . "\n";
    echo "Faltam: " . $e->getFalta();
}</pre>
    <pre class="resultado"><?php
    class SaldoInsuficienteException extends Exception
    {
        public function __construct(private float $saldo, private float $valor)
        {
            parent::__construct("Saldo $saldo insuficiente para sacar $valor");
        }

        public function getFalta(): float
        {
            return $this->valor - $this->saldo;
        }
    }

    function sacar(float $saldo, float $valor): float
    {
        if ($valor > $saldo) {
            throw new SaldoInsuficienteException($saldo, $valor);
        }
        return $saldo - $valor;
    }

    try {
        echo sacar(100, 30) . "\n";
        echo sacar(50, 80) . "\n";
    } catch (SaldoInsuficienteException $e) {
        echo $e->getMessage() . "\n";
        echo "Faltam: " . $e->getFalta();
    }
    ?></pre>

    <h2>8. Encadeamento de exceções (previous)</h2>
    <p>O terceiro argumento do construtor guarda a exceção original. Útil para traduzir um erro técnico em uma mensagem do seu domínio sem perder a causa.</p>
    <pre>function buscarUsuario(int $id): void
{
    try {
        throw new RuntimeException("Falha na conexão com o banco");
    } catch (RuntimeException $e) {
        throw new Exception("Não foi possível buscar o usuário $id", 0, $e);
    }
}

try {
    buscarUsuario(7);
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
    echo "Causa: " . $e->getPrevious()-&gt;getMessage();
}</pre>
    <pre class="resultado"><?php
    function buscarUsuario(int $id): void
    {
        try {
            throw new RuntimeException("Falha na conexão com o banco");
        } catch (RuntimeException $e) {
            throw new Exception("Não foi possível buscar o usuário $id", 0, $e);
        }
    }

    try {
        buscarUsuario(7);
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
        echo "Causa: " . $e->getPrevious()->getMessage();
    }
    ?></pre>

    <h2>9. Error: erros internos que viram exceção (PHP 7+)</h2>
    <p>Muitos erros fatais antigos agora são exceções da família <code>Error</code> e podem ser capturados com <code>Throwable</code>.</p>
    <pre>function somar(int $a, int $b): int
{
    return $a + $b;
}

try {
    echo 10 / 0;
} catch (DivisionByZeroError $e) {
    echo "Divisão por zero: " . $e->getMessage() . "\n";
}

try {
    echo somar("abc", 1);
} catch (TypeError $e) {
    echo "Tipo inválido (" . get_class($e) . ")\n";
}

try {
    echo strlen();
} catch (Throwable $e) {
    echo "Capturado como Throwable: " . get_class($e);
}</pre>
    <pre class="resultado"><?php
    function somar(int $a, int $b): int
    {
        return $a + $b;
    }

    try {
        echo 10 / 0;
    } catch (DivisionByZeroError $e) {
        echo "Divisão por zero: " . $e->getMessage() . "\n";
    }

    try {
        echo somar("abc", 1);
    } catch (TypeError $e) {
        echo "Tipo inválido (" . get_class($e) . ")\n";
    }

    try {
        echo strlen();
    } catch (Throwable $e) {
        echo "Capturado como Throwable: " . get_class($e);
    }
    ?></pre>

    <h2>10. Exceções com PDO</h2>
    <p>Com <code>PDO::ERRMODE_EXCEPTION</code>, falhas de conexão e de SQL viram <code>PDOException</code>. Use o <code>try/catch</code> em volta das operações de banco e <code>rollBack()</code> em transações (veja a pasta <code>php-banco-de-dados</code>).</p>
    <pre>try {
    $pdo = new PDO('sqlite::memory:', null, null, [
        PDO::ATTR_ERRMODE =&gt; PDO::ERRMODE_EXCEPTION,
    ]);
    $pdo-&gt;exec('CREATE TABLE t (id INTEGER PRIMARY KEY)');
    $pdo-&gt;exec('INSERT INTO tabela_inexistente VALUES (1)');
} catch (PDOException $e) {
    echo "Erro de banco: " . $e-&gt;getMessage();
}</pre>
    <pre class="resultado"><?php
    if (!extension_loaded('pdo_sqlite')) {
        echo "Extensão pdo_sqlite não habilitada neste PHP. Habilite no php.ini para ver o resultado.";
    } else {
        try {
            $pdo = new PDO('sqlite::memory:', null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $pdo->exec('CREATE TABLE t (id INTEGER PRIMARY KEY)');
            $pdo->exec('INSERT INTO tabela_inexistente VALUES (1)');
        } catch (PDOException $e) {
            echo "Erro de banco: " . htmlspecialchars($e->getMessage());
        }
    }
    ?></pre>

    <h2>11. Exceção não capturada e set_exception_handler</h2>
    <p>Se nenhuma exceção for capturada, o PHP exibe <code>Fatal error: Uncaught ...</code> e encerra o script. Com <code>set_exception_handler</code> é possível registrar uma função de último recurso, por exemplo para registrar em log e mostrar uma mensagem amigável.</p>
    <pre>set_exception_handler(function (Throwable $e) {
    error_log($e-&gt;getMessage());
    echo "Ocorreu um erro inesperado. Tente novamente mais tarde.";
});

throw new Exception("Ninguém captura isto");</pre>
    <p class="aviso">Este exemplo não é executado aqui porque encerraria a página. O handler roda uma vez e o script termina logo depois.</p>

    <h2>12. Boas práticas</h2>
    <ul>
        <li>Capture apenas o que você sabe tratar. Um <code>catch (Exception $e) {}</code> vazio esconde erros.</li>
        <li>Prefira o tipo mais específico (<code>PDOException</code>, <code>InvalidArgumentException</code>) ao genérico <code>Exception</code>.</li>
        <li>Lance exceções para situações excepcionais, não para controlar o fluxo normal do programa.</li>
        <li>Nunca mostre <code>getMessage()</code> ou o trace ao usuário final em produção: podem vazar caminhos, SQL e credenciais. Registre em log e exiba uma mensagem genérica.</li>
        <li>Use <code>finally</code> para liberar recursos e <code>rollBack()</code> para desfazer transações.</li>
        <li>Ao reencapsular uma exceção, passe a original como <code>previous</code> para não perder a causa.</li>
    </ul>

    <h2>Referência rápida</h2>
    <table>
        <thead>
            <tr>
                <th>Recurso</th>
                <th>Para que serve</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><code>try { }</code></td><td>Envolve o código que pode lançar exceção</td></tr>
            <tr><td><code>catch (Tipo $e) { }</code></td><td>Trata a exceção do tipo indicado</td></tr>
            <tr><td><code>catch (A | B $e)</code></td><td>Trata mais de um tipo no mesmo bloco</td></tr>
            <tr><td><code>finally { }</code></td><td>Executa sempre, com ou sem exceção</td></tr>
            <tr><td><code>throw new Tipo("msg")</code></td><td>Lança uma exceção</td></tr>
            <tr><td><code>extends Exception</code></td><td>Cria uma exceção personalizada</td></tr>
            <tr><td><code>Throwable</code></td><td>Captura tanto <code>Exception</code> quanto <code>Error</code></td></tr>
            <tr><td><code>getPrevious()</code></td><td>Recupera a exceção original de um encadeamento</td></tr>
            <tr><td><code>set_exception_handler</code></td><td>Define o tratador de exceções não capturadas</td></tr>
        </tbody>
    </table>
</body>
</html>
