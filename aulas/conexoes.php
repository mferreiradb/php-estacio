<?php

/*
Cada exemplo abaixo tem duas partes:
- o código mostrado na tela (dentro de <pre>), apenas como texto
- o mesmo código executado de verdade, no bloco verde (quando possível)
Os exemplos executados usam SQLite em memória, então não precisam de servidor de banco.
*/
$temSqlite = extension_loaded('pdo_sqlite');
$semSqlite = "Extensão pdo_sqlite não habilitada neste PHP. Habilite no php.ini para ver o resultado.";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexões e conexões persistentes</title>
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
    <h1>Conexões e conexões persistentes em PHP</h1>
    <p>Para falar com um banco de dados, o PHP precisa abrir uma <strong>conexão</strong>: um canal entre o script e o servidor do banco. Esta página usa PDO. Primeiro vem a conexão comum; depois, a persistente e quando vale a pena usá-la.</p>

    <h2>1. Abrindo uma conexão com PDO</h2>
    <p>Criar o objeto <code>PDO</code> abre a conexão. Ele recebe o <strong>DSN</strong> (qual driver e onde está o banco), usuário, senha e opções.</p>
    <pre>$pdo = new PDO('sqlite::memory:', null, null, [
    PDO::ATTR_ERRMODE =&gt; PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE =&gt; PDO::FETCH_ASSOC,
]);

echo $pdo-&gt;query('SELECT 1 + 1 AS soma')-&gt;fetchColumn();</pre>
    <pre class="resultado"><?php
    if (!$temSqlite) {
        echo $semSqlite;
    } else {
        $pdo = new PDO('sqlite::memory:', null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        echo $pdo->query('SELECT 1 + 1 AS soma')->fetchColumn();
    }
    ?></pre>

    <h2>2. DSN de cada banco</h2>
    <p>Só o DSN (e as credenciais) muda de um banco para outro. O restante do código PDO é o mesmo.</p>
    <table>
        <thead>
            <tr>
                <th>Banco</th>
                <th>DSN</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>SQLite (arquivo)</td><td><code>sqlite:/caminho/banco.db</code></td></tr>
            <tr><td>SQLite (memória)</td><td><code>sqlite::memory:</code></td></tr>
            <tr><td>MySQL</td><td><code>mysql:host=localhost;port=3306;dbname=estudo;charset=utf8mb4</code></td></tr>
            <tr><td>PostgreSQL</td><td><code>pgsql:host=localhost;port=5432;dbname=estudo</code></td></tr>
        </tbody>
    </table>

    <h2>3. Falha na conexão</h2>
    <p>Se o servidor estiver fora do ar, o banco não existir ou a senha estiver errada, o construtor lança <code>PDOException</code>. Sempre envolva a conexão em <code>try/catch</code>.</p>
    <pre>try {
    $pdo = new PDO('sqlite:/pasta/que/nao/existe/banco.db');
} catch (PDOException $e) {
    echo "Não foi possível conectar.";
}</pre>
    <pre class="resultado"><?php
    if (!$temSqlite) {
        echo $semSqlite;
    } else {
        try {
            $pdo = new PDO('sqlite:/pasta/que/nao/existe/banco.db');
        } catch (PDOException $e) {
            echo "Não foi possível conectar.";
        }
    }
    ?></pre>
    <p class="aviso">Nunca exiba <code>$e-&gt;getMessage()</code> ao usuário: a mensagem pode revelar host, usuário do banco e caminhos. Registre em log e mostre um texto genérico.</p>

    <h2>4. Ciclo de vida: uma conexão por requisição</h2>
    <p>No PHP tradicional (Apache, PHP-FPM), cada requisição HTTP roda um script do zero. Por padrão, a conexão:</p>
    <ul>
        <li>é aberta quando o script executa <code>new PDO(...)</code>;</li>
        <li>é fechada automaticamente quando o script termina (ou quando não há mais referências ao objeto);</li>
        <li>não é compartilhada entre requisições: cada visita abre e fecha a sua.</li>
    </ul>
    <p>Para fechar antes do fim do script, descarte todas as referências ao objeto:</p>
    <pre>$pdo = new PDO('sqlite::memory:');
// ... usa a conexão ...
$pdo = null; // fecha a conexão</pre>

    <h2>5. Reaproveitar a conexão na mesma requisição</h2>
    <p>Abrir uma conexão é a parte cara. Dentro de <em>uma</em> requisição, crie a conexão uma vez e reutilize. Uma forma comum é uma classe com método estático (veja o operador <code>::</code> em <code>funcoes.php</code>, Parte 3).</p>
    <pre>class Conexao
{
    private static ?PDO $pdo = null;

    public static function obter(): PDO
    {
        if (self::$pdo === null) {
            echo "Abrindo nova conexão\n";
            self::$pdo = new PDO('sqlite::memory:', null, null, [
                PDO::ATTR_ERRMODE =&gt; PDO::ERRMODE_EXCEPTION,
            ]);
        }
        return self::$pdo;
    }
}

$a = Conexao::obter();
$b = Conexao::obter();
var_dump($a === $b);</pre>
    <pre class="resultado"><?php
    if (!$temSqlite) {
        echo $semSqlite;
    } else {
        class Conexao
        {
            private static ?PDO $pdo = null;

            public static function obter(): PDO
            {
                if (self::$pdo === null) {
                    echo "Abrindo nova conexão\n";
                    self::$pdo = new PDO('sqlite::memory:', null, null, [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    ]);
                }
                return self::$pdo;
            }
        }

        $a = Conexao::obter();
        $b = Conexao::obter();
        var_dump($a === $b);
    }
    ?></pre>
    <p>A mensagem aparece uma vez só e <code>$a === $b</code> é <code>true</code>: as duas chamadas devolvem o mesmo objeto.</p>

    <h2>6. Conexão persistente</h2>
    <p>Uma conexão <strong>persistente</strong> não é fechada quando o script termina. O PHP a mantém aberta no processo e a reaproveita nas próximas requisições que pedirem a mesma conexão. Ativa-se com a opção <code>PDO::ATTR_PERSISTENT</code>, informada ao criar o PDO.</p>
    <pre>$pdo = new PDO(
    'mysql:host=localhost;dbname=estudo;charset=utf8mb4',
    'usuario',
    'senha',
    [
        PDO::ATTR_PERSISTENT =&gt; true,
        PDO::ATTR_ERRMODE =&gt; PDO::ERRMODE_EXCEPTION,
    ]
);</pre>
    <p>Para conferir se a opção foi aplicada:</p>
    <pre>$pdo = new PDO('sqlite::memory:', null, null, [
    PDO::ATTR_PERSISTENT =&gt; true,
]);

var_dump($pdo-&gt;getAttribute(PDO::ATTR_PERSISTENT));</pre>
    <pre class="resultado"><?php
    if (!$temSqlite) {
        echo $semSqlite;
    } else {
        $pdo = new PDO('sqlite::memory:', null, null, [
            PDO::ATTR_PERSISTENT => true,
        ]);

        var_dump($pdo->getAttribute(PDO::ATTR_PERSISTENT));
    }
    ?></pre>

    <h3>Como funciona</h3>
    <ul>
        <li>O PHP guarda a conexão num pool <strong>por processo</strong> (por exemplo, por worker do PHP-FPM ou do Apache). Processos diferentes não compartilham conexões.</li>
        <li>A conexão é reaproveitada quando DSN, usuário, senha e opções são os mesmos.</li>
        <li><code>$pdo = null</code> não fecha uma conexão persistente: ela volta ao pool.</li>
        <li>Em execução por linha de comando (CLI), o processo termina com o script, então a persistência não tem efeito.</li>
    </ul>

    <h2>7. Comum vs persistente</h2>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Comum</th>
                <th>Persistente</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Quando fecha</td><td>No fim do script</td><td>Fica aberta no processo</td></tr>
            <tr><td>Custo de abrir</td><td>A cada requisição</td><td>Só na primeira vez de cada processo</td></tr>
            <tr><td>Número de conexões no servidor do banco</td><td>Acompanha as requisições simultâneas</td><td>Acompanha o número de processos do PHP, mesmo ociosos</td></tr>
            <tr><td>Estado da sessão do banco</td><td>Sempre limpo</td><td>Pode sobrar da requisição anterior</td></tr>
            <tr><td>Ativação</td><td>Padrão</td><td><code>PDO::ATTR_PERSISTENT =&gt; true</code></td></tr>
        </tbody>
    </table>

    <h3>Vantagens</h3>
    <ul>
        <li>Evita o custo de abrir uma conexão a cada requisição (rede, autenticação, TLS). O ganho é maior com bancos remotos ou com TLS.</li>
        <li>Pode reduzir a latência em aplicações com muitas requisições curtas.</li>
    </ul>

    <h3>Cuidados</h3>
    <ul>
        <li><strong>Limite de conexões:</strong> o total de conexões abertas passa a ser o número de processos PHP vezes o número de bancos/usuários distintos. Isso pode estourar o <code>max_connections</code> do banco.</li>
        <li><strong>Estado herdado:</strong> variáveis de sessão do banco, tabelas temporárias, charset e travas podem sobrar da requisição anterior. Não deixe transações abertas nem trave tabelas sem liberar.</li>
        <li><strong>Conexão morta:</strong> se o banco derrubar a conexão ociosa, a requisição seguinte pode receber uma conexão inválida e falhar.</li>
        <li><strong>Pouco ganho em banco local:</strong> com SQLite ou com MySQL na mesma máquina, abrir a conexão já é barato.</li>
    </ul>

    <h2>8. Quando usar</h2>
    <table>
        <thead>
            <tr>
                <th>Situação</th>
                <th>Recomendação</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Estudo, projetos pequenos, SQLite</td><td>Conexão comum</td></tr>
            <tr><td>Banco remoto, muitas requisições curtas, servidor com poucos processos PHP</td><td>Considerar persistente, medindo antes</td></tr>
            <tr><td>Hospedagem compartilhada ou limite baixo de conexões no banco</td><td>Conexão comum</td></tr>
            <tr><td>Alta escala</td><td>Um pool externo (como PgBouncer ou ProxySQL) costuma ser mais seguro que a persistência do PHP</td></tr>
        </tbody>
    </table>

    <h2>9. Boas práticas</h2>
    <ul>
        <li>Guarde DSN, usuário e senha fora do código (arquivo de configuração ou variáveis de ambiente), e não os coloque no controle de versão.</li>
        <li>Defina <code>ERRMODE_EXCEPTION</code> e o charset (<code>utf8mb4</code> no MySQL) ao conectar.</li>
        <li>Abra a conexão uma vez por requisição e passe o objeto adiante, em vez de abrir uma em cada função.</li>
        <li>Capture <code>PDOException</code> na conexão e não exiba a mensagem original ao usuário.</li>
        <li>Se usar persistente, termine transações e não dependa de estado da sessão do banco.</li>
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
            <tr><td><code>new PDO($dsn, $user, $pass, $opcoes)</code></td><td>Abre a conexão</td></tr>
            <tr><td><code>PDOException</code></td><td>Lançada quando a conexão falha</td></tr>
            <tr><td><code>$pdo = null</code></td><td>Fecha a conexão comum (descarta a referência)</td></tr>
            <tr><td><code>PDO::ATTR_PERSISTENT</code></td><td>Mantém a conexão aberta e reaproveitável entre requisições</td></tr>
            <tr><td><code>$pdo-&gt;getAttribute(...)</code></td><td>Consulta uma opção da conexão</td></tr>
            <tr><td><code>static</code> + <code>self::</code></td><td>Reaproveitar a mesma conexão dentro da requisição</td></tr>
        </tbody>
    </table>
</body>
</html>
