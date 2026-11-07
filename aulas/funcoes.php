<?php

// Mostra o resultado do var_dump de forma segura dentro do HTML
function mostrar(mixed ...$valores): void
{
    ob_start();
    var_dump(...$valores);
    echo htmlspecialchars(ob_get_clean());
}

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
    <title>Funções</title>
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
        h4 {
            margin-bottom: 6px;
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
        section.destaque {
            border-left: 5px solid #e0a800;
            background: #fffbe6;
            border-radius: 4px;
            padding: 4px 16px 12px;
            margin-top: 40px;
        }
        section.destaque h2 {
            margin-top: 12px;
        }
        section.destaque pre {
            background: #fff;
        }
        section.destaque pre.resultado {
            background: #e6f4ea;
        }
        .selo {
            display: inline-block;
            background: #e0a800;
            color: #fff;
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 10px;
            vertical-align: middle;
            margin-left: 6px;
        }
    </style>
</head>
<body>
    <h1>Funções em PHP</h1>
    <p>Parte 1: funções em geral (exemplos 1 a 11). Parte 2: funções de arrays, com destaque para <code>print_r</code>, <code>count</code>, <code>unset</code> e <code>array_splice</code>. Parte 3: métodos estáticos e o operador <code>::</code>.</p>

    <!-- ============================== PARTE 1 ============================== -->
    <h1>Parte 1: Funções</h1>
    <p>Uma função é um bloco de código com nome, que pode ser chamado várias vezes. Evita repetir código e deixa o programa organizado.</p>

    <h2>1. Definir e chamar</h2>
    <p>Declara-se com <code>function nome() { ... }</code> e chama-se escrevendo o nome seguido de parênteses.</p>
    <pre>function saudar()
{
    echo "Olá, mundo!";
}

saudar();
saudar();</pre>
    <pre class="resultado"><?php
    function saudar()
    {
        echo "Olá, mundo!\n";
    }

    saudar();
    saudar();
    ?></pre>

    <h2>2. Parâmetros e retorno</h2>
    <p>Parâmetros são os valores que a função recebe. <code>return</code> devolve um resultado e encerra a função.</p>
    <pre>function somar($a, $b)
{
    return $a + $b;
}

$resultado = somar(2, 3);
echo $resultado;
echo somar(10, 20);</pre>
    <pre class="resultado"><?php
    function somar($a, $b)
    {
        return $a + $b;
    }

    $resultado = somar(2, 3);
    echo $resultado . "\n";
    echo somar(10, 20);
    ?></pre>

    <h2>3. Valores padrão</h2>
    <p>Um parâmetro com valor padrão se torna opcional. Coloque os opcionais por último.</p>
    <pre>function cumprimentar($nome, $saudacao = "Olá")
{
    return "$saudacao, $nome!";
}

echo cumprimentar("Maria");
echo cumprimentar("João", "Bom dia");</pre>
    <pre class="resultado"><?php
    function cumprimentar($nome, $saudacao = "Olá")
    {
        return "$saudacao, $nome!";
    }

    echo cumprimentar("Maria") . "\n";
    echo cumprimentar("João", "Bom dia");
    ?></pre>

    <h2>4. Tipos nos parâmetros e no retorno</h2>
    <p>Declarar tipos documenta a função e evita erros. O tipo depois dos <code>:</code> é o do retorno.</p>
    <pre>function dividir(float $a, float $b): float
{
    return $a / $b;
}

function descricao(?string $texto = null): string
{
    return $texto ?? "sem descrição";
}

echo dividir(10, 4);
echo descricao();</pre>
    <pre class="resultado"><?php
    function dividir(float $a, float $b): float
    {
        return $a / $b;
    }

    function descricao(?string $texto = null): string
    {
        return $texto ?? "sem descrição";
    }

    echo dividir(10, 4) . "\n";
    echo descricao();
    ?></pre>

    <h2>5. Retornar vários valores</h2>
    <p>Uma função só tem um <code>return</code>, mas esse valor pode ser um array. Com <code>[$a, $b] = ...</code> você separa os valores.</p>
    <pre>function minimoEMaximo(array $numeros): array
{
    return [min($numeros), max($numeros)];
}

[$menor, $maior] = minimoEMaximo([7, 3, 9, 5]);
echo "Menor: $menor, maior: $maior";</pre>
    <pre class="resultado"><?php
    function minimoEMaximo(array $numeros): array
    {
        return [min($numeros), max($numeros)];
    }

    [$menor, $maior] = minimoEMaximo([7, 3, 9, 5]);
    echo "Menor: $menor, maior: $maior";
    ?></pre>

    <h2>6. Argumentos nomeados (PHP 8+)</h2>
    <p>Permitem passar os argumentos pelo nome, em qualquer ordem, e pular os opcionais.</p>
    <pre>function criarUsuario(string $nome, int $idade = 18, string $cidade = "Recife"): string
{
    return "$nome, $idade anos, $cidade";
}

echo criarUsuario("Ana");
echo criarUsuario(nome: "Bia", cidade: "Olinda"); // pula a idade</pre>
    <pre class="resultado"><?php
    function criarUsuario(string $nome, int $idade = 18, string $cidade = "Recife"): string
    {
        return "$nome, $idade anos, $cidade";
    }

    echo criarUsuario("Ana") . "\n";
    echo criarUsuario(nome: "Bia", cidade: "Olinda");
    ?></pre>

    <h2>7. Número variável de argumentos (...)</h2>
    <p>Os três pontos juntam todos os argumentos recebidos em um array.</p>
    <pre>function somarTodos(int ...$numeros): int
{
    return array_sum($numeros);
}

echo somarTodos(1, 2, 3);
echo somarTodos(10, 20, 30, 40);

$lista = [5, 5, 5];
echo somarTodos(...$lista); // espalha um array como argumentos</pre>
    <pre class="resultado"><?php
    function somarTodos(int ...$numeros): int
    {
        return array_sum($numeros);
    }

    echo somarTodos(1, 2, 3) . "\n";
    echo somarTodos(10, 20, 30, 40) . "\n";

    $lista = [5, 5, 5];
    echo somarTodos(...$lista);
    ?></pre>

    <h2>8. Passagem por valor e por referência</h2>
    <p>
        Por padrão, a função recebe uma <strong>cópia</strong> do valor: mudar o parâmetro não altera a variável original.
        Com <code>&amp;</code>, ela recebe uma <strong>referência</strong> e altera a original.
    </p>
    <pre>function incrementarCopia(int $n)
{
    $n++;
}

function incrementarOriginal(int &amp;$n)
{
    $n++;
}

$x = 5;
incrementarCopia($x);
echo $x; // 5

incrementarOriginal($x);
echo $x; // 6</pre>
    <pre class="resultado"><?php
    function incrementarCopia(int $n)
    {
        $n++;
    }

    function incrementarOriginal(int &$n)
    {
        $n++;
    }

    $x = 5;
    incrementarCopia($x);
    echo $x . "\n";

    incrementarOriginal($x);
    echo $x;
    ?></pre>
    <p>Várias funções de arrays, como <code>sort</code> e <code>array_splice</code>, usam referência e por isso alteram o array original.</p>

    <h2>9. Escopo de variáveis</h2>
    <p>Uma variável criada fora da função <strong>não existe</strong> dentro dela, e vice-versa. Para guardar um valor entre chamadas, use <code>static</code>.</p>
    <pre>$mensagem = "variável de fora";

function testarEscopo()
{
    // echo $mensagem; // erro: variável não definida aqui
    $local = "variável de dentro";
    return $local;
}

function contador(): int
{
    static $vezes = 0; // mantém o valor entre as chamadas
    return ++$vezes;
}

echo testarEscopo();
echo contador();
echo contador();
echo contador();</pre>
    <pre class="resultado"><?php
    $mensagem = "variável de fora";

    function testarEscopo()
    {
        $local = "variável de dentro";
        return $local;
    }

    function contador(): int
    {
        static $vezes = 0;
        return ++$vezes;
    }

    echo testarEscopo() . "\n";
    echo contador() . " ";
    echo contador() . " ";
    echo contador();
    ?></pre>
    <p>Existe também <code>global $variavel</code> para usar uma variável de fora, mas é melhor passar o valor como parâmetro.</p>

    <h2>10. Funções anônimas e arrow functions</h2>
    <p>Funções sem nome, guardadas em variáveis ou passadas como argumento. A arrow function (<code>fn</code>) é a forma curta e enxerga as variáveis de fora automaticamente.</p>
    <pre>$dobro = function ($n) {
    return $n * 2;
};

$triplo = fn($n) => $n * 3;

$fator = 10;
$vezesFator = fn($n) => $n * $fator; // usa $fator de fora

echo $dobro(4);
echo $triplo(4);
echo $vezesFator(4);</pre>
    <pre class="resultado"><?php
    $dobro = function ($n) {
        return $n * 2;
    };

    $triplo = fn($n) => $n * 3;

    $fator = 10;
    $vezesFator = fn($n) => $n * $fator;

    echo $dobro(4) . " ";
    echo $triplo(4) . " ";
    echo $vezesFator(4);
    ?></pre>

    <h2>11. Funções nativas do PHP</h2>
    <p>O PHP já vem com milhares de funções prontas. Algumas das mais usadas:</p>
    <table>
        <thead>
            <tr>
                <th>Área</th>
                <th>Funções</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Texto</td><td><code>strlen</code>, <code>strtoupper</code>, <code>strtolower</code>, <code>str_replace</code>, <code>substr</code>, <code>trim</code>, <code>explode</code>, <code>implode</code></td></tr>
            <tr><td>Números</td><td><code>abs</code>, <code>round</code>, <code>floor</code>, <code>ceil</code>, <code>max</code>, <code>min</code>, <code>rand</code>, <code>sqrt</code></td></tr>
            <tr><td>Tipos</td><td><code>gettype</code>, <code>var_dump</code>, <code>is_int</code>, <code>is_array</code>, <code>intval</code></td></tr>
            <tr><td>Datas</td><td><code>date</code>, <code>time</code>, <code>strtotime</code></td></tr>
            <tr><td>Arrays</td><td>Veja a Parte 2</td></tr>
        </tbody>
    </table>
    <pre>echo strtoupper("php");
echo round(3.14159, 2);
echo str_replace("mundo", "PHP", "Olá, mundo!");</pre>
    <pre class="resultado"><?php
    echo strtoupper("php") . "\n";
    echo round(3.14159, 2) . "\n";
    echo str_replace("mundo", "PHP", "Olá, mundo!");
    ?></pre>

    <!-- ============================== PARTE 2 ============================== -->
    <h1>Parte 2: Funções de arrays</h1>
    <p>O PHP tem dezenas de funções para trabalhar com arrays. As quatro marcadas em amarelo são as principais deste estudo.</p>

    <section class="destaque">
        <h2>12. print_r <span class="selo">destaque</span></h2>
        <p>
            Mostra o conteúdo de um array (ou de qualquer variável) de forma legível para humanos.
            É a função mais usada para inspecionar arrays durante o desenvolvimento.
        </p>
        <pre>$pessoa = ["nome" => "Maria", "idade" => 30, "cidade" => "Recife"];
print_r($pessoa);</pre>
        <pre class="resultado"><?php
        $pessoa = ["nome" => "Maria", "idade" => 30, "cidade" => "Recife"];
        print_r($pessoa);
        ?></pre>

        <h4>Com array multidimensional</h4>
        <pre>$alunos = [
    ["nome" => "Maria", "nota" => 8.5],
    ["nome" => "João", "nota" => 6.0],
];
print_r($alunos);</pre>
        <pre class="resultado"><?php
        $alunos = [
            ["nome" => "Maria", "nota" => 8.5],
            ["nome" => "João", "nota" => 6.0],
        ];
        print_r($alunos);
        ?></pre>

        <h4>Guardar o resultado em uma variável</h4>
        <p>Com o segundo parâmetro <code>true</code>, o <code>print_r</code> <strong>devolve</strong> o texto em vez de imprimir.</p>
        <pre>$texto = print_r([1, 2, 3], true);
echo strlen($texto);</pre>
        <pre class="resultado"><?php
        $texto = print_r([1, 2, 3], true);
        echo strlen($texto);
        ?></pre>

        <h4>print_r x var_dump</h4>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th><code>print_r</code></th>
                    <th><code>var_dump</code></th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Saída</td><td>Compacta e legível</td><td>Detalhada, com tipo e tamanho</td></tr>
                <tr><td>Mostra o tipo</td><td>Não</td><td>Sim (<code>int(30)</code>, <code>string(5) "Maria"</code>)</td></tr>
                <tr><td>Pode devolver o texto</td><td>Sim, com <code>true</code></td><td>Não</td></tr>
                <tr><td>Distingue <code>false</code> de vazio</td><td>Não (<code>false</code> vira texto vazio)</td><td>Sim (<code>bool(false)</code>)</td></tr>
            </tbody>
        </table>
        <p>No navegador, a saída do <code>print_r</code> usa quebras de linha simples. Para ela aparecer organizada, coloque-a dentro de <code>&lt;pre&gt;</code>, como nestes exemplos.</p>
    </section>

    <section class="destaque">
        <h2>13. count <span class="selo">destaque</span></h2>
        <p>Devolve a quantidade de elementos de um array. Seu apelido é <code>sizeof</code>.</p>
        <pre>$frutas = ["maçã", "banana", "uva"];
echo count($frutas);

$vazio = [];
echo count($vazio);

$pessoa = ["nome" => "Maria", "idade" => 30];
echo count($pessoa); // conta os pares chave/valor</pre>
        <pre class="resultado"><?php
        $frutas = ["maçã", "banana", "uva"];
        echo count($frutas) . "\n";

        $vazio = [];
        echo count($vazio) . "\n";

        $pessoa = ["nome" => "Maria", "idade" => 30];
        echo count($pessoa);
        ?></pre>

        <h4>Em arrays multidimensionais</h4>
        <p>Por padrão, conta só o primeiro nível. Com <code>COUNT_RECURSIVE</code>, conta todos os níveis (cada array interno também conta como um elemento).</p>
        <pre>$matriz = [
    [1, 2, 3],
    [4, 5, 6],
];

echo count($matriz);                  // 2 (as duas linhas)
echo count($matriz, COUNT_RECURSIVE); // 8 (2 linhas + 6 valores)
echo count($matriz[0]);               // 3 (itens de uma linha)</pre>
        <pre class="resultado"><?php
        $matriz = [
            [1, 2, 3],
            [4, 5, 6],
        ];

        echo count($matriz) . "\n";
        echo count($matriz, COUNT_RECURSIVE) . "\n";
        echo count($matriz[0]);
        ?></pre>

        <h4>Uso comum: percorrer com for e verificar se está vazio</h4>
        <pre>$nomes = ["Ana", "Bia", "Caio"];

for ($i = 0; $i &lt; count($nomes); $i++) {
    echo "$i: $nomes[$i]\n";
}

if (count($nomes) === 0) {
    echo "Lista vazia";
}
// também funciona: if (empty($nomes))</pre>
        <pre class="resultado"><?php
        $nomes = ["Ana", "Bia", "Caio"];

        for ($i = 0; $i < count($nomes); $i++) {
            echo "$i: $nomes[$i]\n";
        }

        if (count($nomes) === 0) {
            echo "Lista vazia";
        }
        ?></pre>
        <p>No PHP 8, passar algo que não é array (nem <code>Countable</code>) ao <code>count</code>, como <code>count(null)</code> ou <code>count("texto")</code>, lança um <code>TypeError</code>.</p>
    </section>

    <section class="destaque">
        <h2>14. unset <span class="selo">destaque</span></h2>
        <p>
            Remove uma variável ou um elemento de um array.
            Tecnicamente <code>unset</code> não é uma função, e sim uma <strong>construção da linguagem</strong>, por isso não precisa de valor de retorno.
        </p>
        <pre>$cores = ["vermelho", "verde", "azul", "amarelo"];
unset($cores[1]); // remove "verde"
print_r($cores);</pre>
        <pre class="resultado"><?php
        $cores = ["vermelho", "verde", "azul", "amarelo"];
        unset($cores[1]);
        print_r($cores);
        ?></pre>
        <p>
            Repare que os índices <strong>não são renumerados</strong>: ficou um "buraco" na posição 1.
            Para reorganizar, use <code>array_values()</code>.
        </p>
        <pre>$cores = array_values($cores);
print_r($cores);</pre>
        <pre class="resultado"><?php
        $cores = array_values($cores);
        print_r($cores);
        ?></pre>

        <h4>Remover uma chave de um array associativo</h4>
        <pre>$pessoa = ["nome" => "Maria", "idade" => 30, "cidade" => "Recife"];
unset($pessoa["idade"]);
print_r($pessoa);</pre>
        <pre class="resultado"><?php
        $pessoa = ["nome" => "Maria", "idade" => 30, "cidade" => "Recife"];
        unset($pessoa["idade"]);
        print_r($pessoa);
        ?></pre>

        <h4>Remover uma variável inteira</h4>
        <pre>$temporario = "valor";
unset($temporario);
var_dump(isset($temporario)); // false: a variável não existe mais</pre>
        <pre class="resultado"><?php
        $temporario = "valor";
        unset($temporario);
        mostrar(isset($temporario));
        ?></pre>

        <h4>Remover vários de uma vez e remover dentro de um foreach</h4>
        <pre>$numeros = [1, 2, 3, 4, 5, 6];
unset($numeros[0], $numeros[1]); // vários de uma vez

foreach ($numeros as $chave => $valor) {
    if ($valor % 2 == 0) {
        unset($numeros[$chave]); // remove os pares
    }
}
print_r($numeros);</pre>
        <pre class="resultado"><?php
        $numeros = [1, 2, 3, 4, 5, 6];
        unset($numeros[0], $numeros[1]);

        foreach ($numeros as $chave => $valor) {
            if ($valor % 2 == 0) {
                unset($numeros[$chave]);
            }
        }
        print_r($numeros);
        ?></pre>

        <h4>unset x array_splice x array_pop / array_shift</h4>
        <table>
            <thead>
                <tr>
                    <th>Quer...</th>
                    <th>Use</th>
                    <th>Renumera os índices?</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Remover qualquer posição ou chave</td><td><code>unset($a[2])</code></td><td>Não</td></tr>
                <tr><td>Remover e reorganizar os índices</td><td><code>array_splice($a, 2, 1)</code></td><td>Sim</td></tr>
                <tr><td>Remover o último</td><td><code>array_pop($a)</code></td><td>Sim</td></tr>
                <tr><td>Remover o primeiro</td><td><code>array_shift($a)</code></td><td>Sim</td></tr>
            </tbody>
        </table>
    </section>

    <section class="destaque">
        <h2>15. array_splice <span class="selo">destaque</span></h2>
        <p>
            Remove uma parte do array e, se quiser, coloca outros elementos no lugar.
            Altera o <strong>array original</strong> (recebe por referência) e <strong>devolve os elementos removidos</strong>.
        </p>
        <pre>array_splice(array &amp;$array, int $posicao, ?int $quantidade = null, mixed $substituto = [])</pre>
        <ul>
            <li><code>$posicao</code>: onde começar (0 é o primeiro; negativo conta a partir do fim).</li>
            <li><code>$quantidade</code>: quantos elementos remover (se omitido, remove até o fim).</li>
            <li><code>$substituto</code>: o que colocar no lugar (opcional).</li>
        </ul>

        <h4>Remover</h4>
        <pre>$letras = ["a", "b", "c", "d", "e"];
$removidos = array_splice($letras, 1, 2); // a partir da posição 1, remove 2

print_r($letras);
print_r($removidos);</pre>
        <pre class="resultado"><?php
        $letras = ["a", "b", "c", "d", "e"];
        $removidos = array_splice($letras, 1, 2);

        print_r($letras);
        print_r($removidos);
        ?></pre>

        <h4>Inserir sem remover</h4>
        <p>Com quantidade <code>0</code>, nada é removido e os substitutos são inseridos na posição.</p>
        <pre>$letras = ["a", "d", "e"];
array_splice($letras, 1, 0, ["b", "c"]);
print_r($letras);</pre>
        <pre class="resultado"><?php
        $letras = ["a", "d", "e"];
        array_splice($letras, 1, 0, ["b", "c"]);
        print_r($letras);
        ?></pre>

        <h4>Substituir</h4>
        <pre>$letras = ["a", "b", "c", "d", "e"];
array_splice($letras, 1, 2, "X"); // troca "b" e "c" por "X"
print_r($letras);</pre>
        <pre class="resultado"><?php
        $letras = ["a", "b", "c", "d", "e"];
        array_splice($letras, 1, 2, "X");
        print_r($letras);
        ?></pre>

        <h4>Posição negativa e remover até o fim</h4>
        <pre>$letras = ["a", "b", "c", "d", "e"];
array_splice($letras, -2); // remove os 2 últimos
print_r($letras);

$letras = ["a", "b", "c", "d", "e"];
array_splice($letras, 2);  // remove da posição 2 até o fim
print_r($letras);</pre>
        <pre class="resultado"><?php
        $letras = ["a", "b", "c", "d", "e"];
        array_splice($letras, -2);
        print_r($letras);

        $letras = ["a", "b", "c", "d", "e"];
        array_splice($letras, 2);
        print_r($letras);
        ?></pre>

        <h4>array_splice x array_slice</h4>
        <p>Os nomes são parecidos, mas fazem coisas diferentes.</p>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th><code>array_splice</code></th>
                    <th><code>array_slice</code></th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Altera o array original</td><td>Sim</td><td>Não</td></tr>
                <tr><td>Devolve</td><td>Os elementos removidos</td><td>Uma cópia do trecho</td></tr>
                <tr><td>Permite substituir</td><td>Sim</td><td>Não</td></tr>
                <tr><td>Índices numéricos</td><td>Sempre renumerados</td><td>Renumerados (ou mantidos com <code>true</code> no 4º parâmetro)</td></tr>
            </tbody>
        </table>
        <pre>$letras = ["a", "b", "c", "d", "e"];
$trecho = array_slice($letras, 1, 2);

print_r($letras); // continua com os 5 itens
print_r($trecho);</pre>
        <pre class="resultado"><?php
        $letras = ["a", "b", "c", "d", "e"];
        $trecho = array_slice($letras, 1, 2);

        print_r($letras);
        print_r($trecho);
        ?></pre>
        <p>Em arrays associativos, o <code>array_splice</code> preserva as chaves de texto dos elementos que ficam, mas renumera as chaves numéricas.</p>
    </section>

    <h2>16. Adicionar e remover elementos</h2>
    <pre>$fila = [1, 2, 3];

array_push($fila, 4, 5);   // adiciona ao final
array_unshift($fila, 0);   // adiciona no início
$ultimo = array_pop($fila);   // remove e devolve o último
$primeiro = array_shift($fila); // remove e devolve o primeiro

print_r($fila);
echo "$ultimo e $primeiro";</pre>
    <pre class="resultado"><?php
    $fila = [1, 2, 3];

    array_push($fila, 4, 5);
    array_unshift($fila, 0);
    $ultimo = array_pop($fila);
    $primeiro = array_shift($fila);

    print_r($fila);
    echo "$ultimo e $primeiro";
    ?></pre>

    <h2>17. Buscar e verificar</h2>
    <pre>$frutas = ["maçã", "banana", "uva"];
$pessoa = ["nome" => "Maria", "idade" => 30];

var_dump(in_array("uva", $frutas));        // o valor existe?
var_dump(array_search("banana", $frutas)); // em que posição?
var_dump(array_key_exists("nome", $pessoa)); // a chave existe?
print_r(array_keys($pessoa));              // só as chaves
print_r(array_values($pessoa));            // só os valores</pre>
    <pre class="resultado"><?php
    $frutas = ["maçã", "banana", "uva"];
    $pessoa = ["nome" => "Maria", "idade" => 30];

    mostrar(in_array("uva", $frutas));
    mostrar(array_search("banana", $frutas));
    mostrar(array_key_exists("nome", $pessoa));
    print_r(array_keys($pessoa));
    print_r(array_values($pessoa));
    ?></pre>
    <p>Cuidado: <code>array_search</code> devolve <code>false</code> se não achar, mas a posição <code>0</code> também é "falsa". Compare com <code>=== false</code>.</p>

    <h2>18. Transformar: array_map, array_filter e array_reduce</h2>
    <p>Recebem uma função (geralmente uma arrow function) e a aplicam aos elementos.</p>
    <pre>$numeros = [1, 2, 3, 4, 5, 6];

// map: transforma cada item
print_r(array_map(fn($n) => $n * 2, $numeros));

// filter: mantém só os itens que passam no teste
print_r(array_filter($numeros, fn($n) => $n % 2 == 0));

// reduce: reduz tudo a um único valor
echo array_reduce($numeros, fn($acumulado, $n) => $acumulado + $n, 0);</pre>
    <pre class="resultado"><?php
    $numeros = [1, 2, 3, 4, 5, 6];

    print_r(array_map(fn($n) => $n * 2, $numeros));
    print_r(array_filter($numeros, fn($n) => $n % 2 == 0));
    echo array_reduce($numeros, fn($acumulado, $n) => $acumulado + $n, 0);
    ?></pre>
    <p>O <code>array_filter</code> mantém as chaves originais (repare em 1, 3 e 5 no resultado). Use <code>array_values()</code> se quiser renumerar.</p>

    <h2>19. Ordenar</h2>
    <table>
        <thead>
            <tr>
                <th>Função</th>
                <th>Ordena por</th>
                <th>Mantém as chaves?</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><code>sort</code> / <code>rsort</code></td><td>Valor (crescente / decrescente)</td><td>Não</td></tr>
            <tr><td><code>asort</code> / <code>arsort</code></td><td>Valor (crescente / decrescente)</td><td>Sim</td></tr>
            <tr><td><code>ksort</code> / <code>krsort</code></td><td>Chave (crescente / decrescente)</td><td>Sim</td></tr>
            <tr><td><code>usort</code></td><td>Regra própria (função)</td><td>Não</td></tr>
        </tbody>
    </table>
    <pre>$numeros = [7, 3, 9, 5];
sort($numeros);
echo implode(", ", $numeros);

$precos = ["b" => 3, "a" => 1, "c" => 2];
asort($precos); // por valor, mantendo as chaves
print_r($precos);
ksort($precos); // por chave
print_r($precos);

$alunos = [["nome" => "Maria", "nota" => 8], ["nome" => "João", "nota" => 6]];
usort($alunos, fn($a, $b) => $a["nota"] &lt;=> $b["nota"]);
echo $alunos[0]["nome"];</pre>
    <pre class="resultado"><?php
    $numeros = [7, 3, 9, 5];
    sort($numeros);
    echo implode(", ", $numeros) . "\n";

    $precos = ["b" => 3, "a" => 1, "c" => 2];
    asort($precos);
    print_r($precos);
    ksort($precos);
    print_r($precos);

    $alunos = [["nome" => "Maria", "nota" => 8], ["nome" => "João", "nota" => 6]];
    usort($alunos, fn($a, $b) => $a["nota"] <=> $b["nota"]);
    echo $alunos[0]["nome"];
    ?></pre>
    <p>Todas as funções de ordenação alteram o array original e devolvem <code>true</code>, não o array ordenado.</p>

    <h2>20. Combinar, recortar e transformar</h2>
    <pre>$a = [1, 2, 3];
$b = [3, 4, 5];

print_r(array_merge($a, $b));          // junta (pode repetir valores)
print_r([...$a, ...$b]);               // mesmo resultado com o operador ...
print_r(array_unique(array_merge($a, $b))); // sem repetidos
print_r(array_reverse($a));            // inverte a ordem
print_r(array_combine(["x", "y"], [10, 20])); // monta chaves e valores
print_r(range(1, 5));                  // cria uma sequência
print_r(explode(",", "ana,bia,caio")); // texto vira array
echo implode(" - ", ["ana", "bia", "caio"]); // array vira texto
echo array_sum([1, 2, 3]);             // soma</pre>
    <pre class="resultado"><?php
    $a = [1, 2, 3];
    $b = [3, 4, 5];

    print_r(array_merge($a, $b));
    print_r([...$a, ...$b]);
    print_r(array_unique(array_merge($a, $b)));
    print_r(array_reverse($a));
    print_r(array_combine(["x", "y"], [10, 20]));
    print_r(range(1, 5));
    print_r(explode(",", "ana,bia,caio"));
    echo implode(" - ", ["ana", "bia", "caio"]) . "\n";
    echo array_sum([1, 2, 3]);
    ?></pre>

    <!-- ============================== PARTE 3 ============================== -->
    <h1>Parte 3: Métodos estáticos e o operador ::</h1>
    <p>O operador <code>::</code> (resolução de escopo, ou "dois pontos duplos") acessa membros que pertencem à <strong>classe</strong>, sem precisar criar um objeto. Para membros de um <strong>objeto</strong>, usa-se <code>-&gt;</code>.</p>

    <h2>21. Constantes e métodos estáticos</h2>
    <p>Uma constante de classe (<code>const</code>) e um método <code>static</code> são chamados direto pelo nome da classe, seguido de <code>::</code>.</p>
    <pre>class Matematica
{
    const PI = 3.14159;

    public static function dobro(int $n): int
    {
        return $n * 2;
    }
}

echo Matematica::PI;
echo Matematica::dobro(4);</pre>
    <pre class="resultado"><?php
    class Matematica
    {
        const PI = 3.14159;

        public static function dobro(int $n): int
        {
            return $n * 2;
        }
    }

    echo Matematica::PI . " ";
    echo Matematica::dobro(4);
    ?></pre>

    <h2>22. Propriedades estáticas e self::</h2>
    <p>Uma propriedade <code>static</code> é compartilhada por toda a classe e acessada com <code>Classe::$nome</code> (o <code>$</code> fica depois do <code>::</code>). Dentro da própria classe, use <code>self::</code> no lugar do nome dela.</p>
    <pre>class Contador
{
    public static int $total = 0;

    public static function incrementar(): void
    {
        self::$total++;
    }
}

Contador::incrementar();
Contador::incrementar();
echo Contador::$total;</pre>
    <pre class="resultado"><?php
    class Contador
    {
        public static int $total = 0;

        public static function incrementar(): void
        {
            self::$total++;
        }
    }

    Contador::incrementar();
    Contador::incrementar();
    echo Contador::$total;
    ?></pre>

    <h2>23. parent:: e ::class</h2>
    <p><code>parent::</code> chama um método da classe pai. <code>NomeDaClasse::class</code> devolve o nome completo da classe como texto.</p>
    <pre>class Animal
{
    public function falar(): string
    {
        return "...";
    }
}

class Cachorro extends Animal
{
    public function falar(): string
    {
        return parent::falar() . " Au!";
    }
}

$c = new Cachorro();
echo $c->falar();
echo Cachorro::class;</pre>
    <pre class="resultado"><?php
    class Animal
    {
        public function falar(): string
        {
            return "...";
        }
    }

    class Cachorro extends Animal
    {
        public function falar(): string
        {
            return parent::falar() . " Au!";
        }
    }

    $c = new Cachorro();
    echo $c->falar() . " ";
    echo Cachorro::class;
    ?></pre>

    <h2>:: ou -&gt;?</h2>
    <table>
        <thead>
            <tr>
                <th>Operador</th>
                <th>Acessa</th>
                <th>Precisa de objeto?</th>
                <th>Exemplo</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><code>::</code></td><td>Constantes, métodos e propriedades estáticas, <code>self</code>, <code>parent</code>, <code>static</code>, <code>class</code></td><td>Não</td><td><code>PDO::FETCH_ASSOC</code>, <code>Status::Ativo</code></td></tr>
            <tr><td><code>-&gt;</code></td><td>Propriedades e métodos de um objeto</td><td>Sim</td><td><code>$pdo-&gt;query(...)</code></td></tr>
        </tbody>
    </table>
    <p>É por isso que, no estudo de PDO, aparece <code>PDO::FETCH_ASSOC</code> (constante da classe) e <code>$pdo-&gt;prepare(...)</code> (método do objeto criado).</p>

    <h2>Referência rápida</h2>
    <table>
        <thead>
            <tr>
                <th>Função</th>
                <th>O que faz</th>
                <th>Altera o original?</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><code>print_r</code></td><td>Mostra o conteúdo de forma legível</td><td>Não</td></tr>
            <tr><td><code>count</code></td><td>Conta os elementos</td><td>Não</td></tr>
            <tr><td><code>unset</code></td><td>Remove um elemento ou variável</td><td>Sim</td></tr>
            <tr><td><code>array_splice</code></td><td>Remove, insere ou substitui um trecho</td><td>Sim</td></tr>
            <tr><td><code>array_push</code> / <code>array_pop</code></td><td>Adiciona / remove no final</td><td>Sim</td></tr>
            <tr><td><code>array_unshift</code> / <code>array_shift</code></td><td>Adiciona / remove no início</td><td>Sim</td></tr>
            <tr><td><code>in_array</code> / <code>array_search</code></td><td>Verifica / acha a posição de um valor</td><td>Não</td></tr>
            <tr><td><code>array_key_exists</code></td><td>Verifica se uma chave existe</td><td>Não</td></tr>
            <tr><td><code>array_keys</code> / <code>array_values</code></td><td>Devolve só as chaves / só os valores</td><td>Não</td></tr>
            <tr><td><code>array_map</code> / <code>array_filter</code> / <code>array_reduce</code></td><td>Transforma / filtra / reduz</td><td>Não</td></tr>
            <tr><td><code>sort</code>, <code>asort</code>, <code>ksort</code>, <code>usort</code></td><td>Ordena</td><td>Sim</td></tr>
            <tr><td><code>array_merge</code></td><td>Junta arrays</td><td>Não</td></tr>
            <tr><td><code>array_slice</code></td><td>Recorta um trecho</td><td>Não</td></tr>
            <tr><td><code>array_unique</code> / <code>array_reverse</code></td><td>Remove repetidos / inverte</td><td>Não</td></tr>
            <tr><td><code>implode</code> / <code>explode</code></td><td>Array para texto / texto para array</td><td>Não</td></tr>
            <tr><td><code>range</code> / <code>array_combine</code></td><td>Cria sequência / une chaves e valores</td><td>Não</td></tr>
            <tr><td><code>Classe::</code></td><td>Acessa constante, método ou propriedade estática (Parte 3)</td><td>Não se aplica</td></tr>
        </tbody>
    </table>
</body>
</html>
