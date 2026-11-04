<?php

class Pessoa
{
    public string $nome = "Maria";
    public int $idade = 30;

    public function apresentar(): string
    {
        return "Oi, eu sou $this->nome";
    }
}

enum Status: string
{
    case Ativo = "ativo";
    case Inativo = "inativo";
}

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
- o mesmo código executado de verdade, com o resultado do var_dump()
*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Dados</title>
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
    </style>
</head>
<body>
    <h1>Tipos de Dados em PHP</h1>
    <p>
        O PHP tem tipagem dinâmica: você não declara o tipo da variável, o PHP descobre pelo valor.
        A função <code>var_dump()</code> mostra o tipo e o conteúdo de um valor, e é usada nos resultados abaixo.
    </p>

    <h2>Visão geral</h2>
    <table>
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Tipo</th>
                <th>Exemplo</th>
            </tr>
        </thead>
        <tbody>
            <tr><td rowspan="4">Escalares</td><td><code>bool</code></td><td><code>true</code>, <code>false</code></td></tr>
            <tr><td><code>int</code></td><td><code>42</code></td></tr>
            <tr><td><code>float</code></td><td><code>3.14</code></td></tr>
            <tr><td><code>string</code></td><td><code>"texto"</code></td></tr>
            <tr><td rowspan="4">Compostos</td><td><code>array</code></td><td><code>[1, 2, 3]</code></td></tr>
            <tr><td><code>object</code></td><td><code>new Pessoa()</code></td></tr>
            <tr><td><code>callable</code></td><td><code>fn($x) => $x * 2</code></td></tr>
            <tr><td><code>iterable</code></td><td>array ou objeto que pode ir em um <code>foreach</code></td></tr>
            <tr><td rowspan="2">Especiais</td><td><code>null</code></td><td><code>null</code></td></tr>
            <tr><td><code>resource</code></td><td><code>fopen(...)</code></td></tr>
            <tr><td>Outros</td><td><code>enum</code></td><td><code>Status::Ativo</code> (PHP 8.1+)</td></tr>
        </tbody>
    </table>

    <h2>1. bool (booleano)</h2>
    <p>Só tem dois valores: <code>true</code> (verdadeiro) e <code>false</code> (falso). É o resultado de comparações e usado nos <code>if</code>.</p>
    <pre>$ativo = true;
$maior = 10 > 5;
var_dump($ativo, $maior);</pre>
    <pre class="resultado"><?php
    $ativo = true;
    $maior = 10 > 5;
    mostrar($ativo, $maior);
    ?></pre>
    <p>Valores que o PHP considera <code>false</code> em condições: <code>false</code>, <code>0</code>, <code>0.0</code>, <code>""</code>, <code>"0"</code>, <code>[]</code> e <code>null</code>. Todo o resto é <code>true</code>.</p>

    <h2>2. int (inteiro)</h2>
    <p>Números inteiros, positivos ou negativos, sem casas decimais. Aceita outras bases e o separador <code>_</code> para facilitar a leitura.</p>
    <pre>$idade = 30;
$negativo = -15;
$hexa = 0xFF;      // hexadecimal
$binario = 0b1010; // binário
$grande = 1_000_000;
var_dump($idade, $negativo, $hexa, $binario, $grande);
echo PHP_INT_MAX;</pre>
    <pre class="resultado"><?php
    $idade = 30;
    $negativo = -15;
    $hexa = 0xFF;
    $binario = 0b1010;
    $grande = 1_000_000;
    mostrar($idade, $negativo, $hexa, $binario, $grande);
    echo PHP_INT_MAX;
    ?></pre>
    <p>Se um inteiro passa de <code>PHP_INT_MAX</code>, ele vira <code>float</code>.</p>

    <h2>3. float (ponto flutuante)</h2>
    <p>Números com casas decimais. Use o ponto como separador decimal. Também aceita notação científica.</p>
    <pre>$preco = 19.99;
$cientifico = 1.5e3; // 1500
var_dump($preco, $cientifico);

var_dump(0.1 + 0.2 == 0.3);</pre>
    <pre class="resultado"><?php
    $preco = 19.99;
    $cientifico = 1.5e3;
    mostrar($preco, $cientifico);
    echo "\n";
    mostrar(0.1 + 0.2 == 0.3);
    ?></pre>
    <p>Cuidado: floats têm imprecisão. <code>0.1 + 0.2</code> não é exatamente <code>0.3</code>. Para comparar, use uma tolerância, por exemplo <code>abs($a - $b) &lt; 0.00001</code>. Para dinheiro, prefira guardar em centavos (int).</p>

    <h2>4. string (texto)</h2>
    <p>Sequência de caracteres. Aspas duplas interpretam variáveis e caracteres especiais (<code>\n</code>). Aspas simples mostram o texto literalmente.</p>
    <pre>$nome = "Maria";
echo "Olá, $nome";   // interpola a variável
echo 'Olá, $nome';   // mostra $nome literalmente
echo "Olá, " . $nome; // concatenação com ponto
var_dump(strlen("Olá"), strtoupper($nome));</pre>
    <pre class="resultado"><?php
    $nome = "Maria";
    echo "Olá, $nome\n";
    echo 'Olá, $nome' . "\n";
    echo "Olá, " . $nome . "\n";
    mostrar(strlen("Olá"), strtoupper($nome));
    ?></pre>
    <p><code>strlen("Olá")</code> dá 4, e não 3, porque conta bytes e o "á" ocupa 2. Para contar caracteres, use <code>mb_strlen()</code>.</p>
    <p>Para textos de várias linhas existem <code>heredoc</code> (<code>&lt;&lt;&lt;EOT</code>, interpreta variáveis) e <code>nowdoc</code> (<code>&lt;&lt;&lt;'EOT'</code>, não interpreta).</p>

    <h2>5. array unidimensional (indexado)</h2>
    <p>
        Um array unidimensional tem apenas um nível: uma lista simples de valores, sem outros arrays dentro.
        No tipo indexado, os valores são acessados por posição, começando em <code>0</code>.
        (O array associativo da próxima seção também é unidimensional, mas usa chaves com nome.)
    </p>

    <h3>Criar e acessar</h3>
    <pre>$frutas = ["maçã", "banana", "uva"];   // sintaxe curta
$numeros = array(10, 20, 30);          // sintaxe antiga, equivalente
$vazio = [];

echo $frutas[0];
echo $frutas[2];
var_dump($frutas);</pre>
    <pre class="resultado"><?php
    $frutas = ["maçã", "banana", "uva"];
    $numeros = array(10, 20, 30);
    $vazio = [];

    echo $frutas[0] . "\n";
    echo $frutas[2] . "\n";
    mostrar($frutas);
    ?></pre>

    <h3>Adicionar, alterar e remover</h3>
    <pre>$frutas[] = "pera";              // adiciona ao final
array_push($frutas, "kiwi");     // também adiciona ao final
array_unshift($frutas, "abacaxi"); // adiciona no início
$frutas[1] = "morango";          // altera a posição 1

array_pop($frutas);              // remove o último
array_shift($frutas);            // remove o primeiro
unset($frutas[1]);               // remove a posição 1 (deixa um "buraco")
$frutas = array_values($frutas); // reorganiza os índices

print_r($frutas);</pre>
    <pre class="resultado"><?php
    $f = ["maçã", "banana", "uva"];
    $f[] = "pera";
    array_push($f, "kiwi");
    array_unshift($f, "abacaxi");
    $f[1] = "morango";

    array_pop($f);
    array_shift($f);
    unset($f[1]);
    echo "Depois do unset (com buraco):\n";
    print_r($f);
    $f = array_values($f);
    echo "Depois do array_values:\n";
    print_r($f);
    ?></pre>
    <p>Depois do <code>unset</code>, o PHP não renumera os índices. Use <code>array_values()</code> se precisar deles em sequência.</p>

    <h3>Funções úteis</h3>
    <pre>$notas = [7, 3, 9, 5];

echo count($notas);             // quantidade de itens
echo array_sum($notas);         // soma
echo max($notas) . " " . min($notas);
var_dump(in_array(9, $notas));  // o valor existe?
var_dump(array_search(9, $notas)); // em que posição?

sort($notas);                   // ordena do menor para o maior
echo implode(", ", $notas);     // junta em texto
print_r(array_slice($notas, 1, 2)); // recorta 2 itens a partir da posição 1</pre>
    <pre class="resultado"><?php
    $notas = [7, 3, 9, 5];

    echo count($notas) . "\n";
    echo array_sum($notas) . "\n";
    echo max($notas) . " " . min($notas) . "\n";
    mostrar(in_array(9, $notas));
    mostrar(array_search(9, $notas));

    sort($notas);
    echo implode(", ", $notas) . "\n";
    print_r(array_slice($notas, 1, 2));
    ?></pre>

    <h3>Percorrer</h3>
    <pre>$frutas = ["maçã", "banana", "uva"];

foreach ($frutas as $fruta) {
    echo "$fruta\n";
}

for ($i = 0; $i &lt; count($frutas); $i++) {
    echo "$i: $frutas[$i]\n";
}</pre>
    <pre class="resultado"><?php
    $frutas = ["maçã", "banana", "uva"];

    foreach ($frutas as $fruta) {
        echo "$fruta\n";
    }

    for ($i = 0; $i < count($frutas); $i++) {
        echo "$i: $frutas[$i]\n";
    }
    ?></pre>

    <h2>6. array associativo</h2>
    <p>Cada valor é acessado por uma <strong>chave com nome</strong>, usando <code>chave => valor</code>. Os valores podem ter tipos diferentes.</p>
    <pre>$pessoa = ["nome" => "Maria", "idade" => 30, "cidade" => "Recife"];
echo $pessoa["nome"];
$pessoa["email"] = "maria@teste.com"; // adiciona uma chave
var_dump($pessoa);</pre>
    <pre class="resultado"><?php
    $pessoa = ["nome" => "Maria", "idade" => 30, "cidade" => "Recife"];
    echo $pessoa["nome"] . "\n";
    $pessoa["email"] = "maria@teste.com";
    mostrar($pessoa);
    ?></pre>

    <h3>Array associativo do PHP x objeto do JavaScript</h3>
    <p>No uso do dia a dia, o array associativo faz o papel do objeto literal do JavaScript, mas não são a mesma coisa.</p>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Array associativo (PHP)</th>
                <th>Objeto (JavaScript)</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Tipo</td><td><code>array</code></td><td><code>object</code></td></tr>
            <tr><td>Sintaxe</td><td><code>"chave" => valor</code></td><td><code>chave: valor</code></td></tr>
            <tr><td>Acesso</td><td><code>$pessoa["nome"]</code></td><td><code>pessoa.nome</code> ou <code>pessoa["nome"]</code></td></tr>
            <tr><td>Métodos próprios</td><td>Não, usa funções (<code>count()</code>, <code>array_keys()</code>)</td><td>Pode ter funções como valores</td></tr>
            <tr><td>Atribuição (<code>$b = $a</code>)</td><td>Copia o array</td><td>Copia só a referência</td></tr>
        </tbody>
    </table>
    <p>A diferença mais importante é a cópia:</p>
    <pre>$a = ["nome" => "Maria"];
$b = $a;
$b["nome"] = "Ana";
echo $a["nome"]; // o original não mudou</pre>
    <pre class="resultado"><?php
    $a = ["nome" => "Maria"];
    $b = $a;
    $b["nome"] = "Ana";
    echo $a["nome"];
    ?></pre>
    <p>No JavaScript, o equivalente com objetos (<code>const b = a; b.nome = "Ana"</code>) altera também o <code>a</code>, pois os dois apontam para o mesmo objeto.</p>
    <p>
        A conversão acontece no <code>json_encode()</code> (array associativo vira JSON) e no
        <code>resultado.json()</code> do JavaScript (JSON vira objeto), como no exemplo de AJAX de <code>aulas/formulario</code>.
    </p>

    <h2>7. array multidimensional</h2>
    <p>
        Array que contém outros arrays, formando mais de um nível. Cada nível extra é uma nova dimensão
        e adiciona um par de colchetes no acesso. Muito usado para tabelas, matrizes e registros de banco de dados.
    </p>

    <h3>Matriz (2 dimensões, indexada)</h3>
    <p>Pense em linhas e colunas: o primeiro índice escolhe a linha e o segundo, a coluna.</p>
    <pre>$matriz = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
];

echo $matriz[0][0]; // linha 0, coluna 0
echo $matriz[1][2]; // linha 1, coluna 2
echo $matriz[2][1]; // linha 2, coluna 1
var_dump($matriz[1]); // uma linha inteira</pre>
    <pre class="resultado"><?php
    $matriz = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
    ];

    echo $matriz[0][0] . "\n";
    echo $matriz[1][2] . "\n";
    echo $matriz[2][1] . "\n";
    mostrar($matriz[1]);
    ?></pre>

    <h3>Percorrer com foreach aninhado</h3>
    <p>Um <code>foreach</code> para as linhas e outro, dentro dele, para as colunas.</p>
    <pre>foreach ($matriz as $i => $linha) {
    foreach ($linha as $j => $valor) {
        echo "[$i][$j] = $valor  ";
    }
    echo "\n";
}</pre>
    <pre class="resultado"><?php
    foreach ($matriz as $i => $linha) {
        foreach ($linha as $j => $valor) {
            echo "[$i][$j] = $valor  ";
        }
        echo "\n";
    }
    ?></pre>

    <h3>Array de arrays associativos (registros)</h3>
    <p>É o formato mais comum no dia a dia, parecido com uma tabela de banco de dados: cada item é uma linha com campos nomeados.</p>
    <pre>$alunos = [
    ["nome" => "Maria", "nota" => 8.5],
    ["nome" => "João", "nota" => 6.0],
    ["nome" => "Ana", "nota" => 9.0],
];

echo $alunos[1]["nome"];      // João

$alunos[] = ["nome" => "Pedro", "nota" => 7.0]; // adiciona um registro
$alunos[0]["nota"] = 9.5;     // altera um campo

foreach ($alunos as $aluno) {
    echo $aluno["nome"] . ": " . $aluno["nota"] . "\n";
}</pre>
    <pre class="resultado"><?php
    $alunos = [
        ["nome" => "Maria", "nota" => 8.5],
        ["nome" => "João", "nota" => 6.0],
        ["nome" => "Ana", "nota" => 9.0],
    ];

    echo $alunos[1]["nome"] . "\n";

    $alunos[] = ["nome" => "Pedro", "nota" => 7.0];
    $alunos[0]["nota"] = 9.5;

    foreach ($alunos as $aluno) {
        echo $aluno["nome"] . ": " . $aluno["nota"] . "\n";
    }
    ?></pre>

    <h3>Funções úteis com arrays multidimensionais</h3>
    <pre>$nomes = array_column($alunos, "nome");        // só uma coluna
$notas = array_column($alunos, "nota");
echo implode(", ", $nomes);
echo array_sum($notas) / count($notas);        // média

// filtra os alunos com nota maior ou igual a 7
$aprovados = array_filter($alunos, fn($a) => $a["nota"] >= 7);
echo count($aprovados);

// ordena pelo campo nota, da maior para a menor
usort($alunos, fn($a, $b) => $b["nota"] &lt;=> $a["nota"]);
echo $alunos[0]["nome"];</pre>
    <pre class="resultado"><?php
    $nomes = array_column($alunos, "nome");
    $notas = array_column($alunos, "nota");
    echo implode(", ", $nomes) . "\n";
    echo array_sum($notas) / count($notas) . "\n";

    $aprovados = array_filter($alunos, fn($a) => $a["nota"] >= 7);
    echo count($aprovados) . "\n";

    usort($alunos, fn($a, $b) => $b["nota"] <=> $a["nota"]);
    echo $alunos[0]["nome"];
    ?></pre>

    <h3>3 dimensões</h3>
    <p>Dá para aninhar quantos níveis forem necessários, mas acima de 3 o código fica difícil de ler. Aqui, notas de cada aluno por semestre.</p>
    <pre>$turma = [
    "Maria" => [
        "semestre1" => ["matematica" => 8, "portugues" => 9],
        "semestre2" => ["matematica" => 7, "portugues" => 10],
    ],
    "João" => [
        "semestre1" => ["matematica" => 6, "portugues" => 5],
        "semestre2" => ["matematica" => 8, "portugues" => 7],
    ],
];

echo $turma["Maria"]["semestre2"]["portugues"];

foreach ($turma as $aluno => $semestres) {
    foreach ($semestres as $semestre => $materias) {
        foreach ($materias as $materia => $nota) {
            echo "$aluno - $semestre - $materia: $nota\n";
        }
    }
}</pre>
    <pre class="resultado"><?php
    $turma = [
        "Maria" => [
            "semestre1" => ["matematica" => 8, "portugues" => 9],
            "semestre2" => ["matematica" => 7, "portugues" => 10],
        ],
        "João" => [
            "semestre1" => ["matematica" => 6, "portugues" => 5],
            "semestre2" => ["matematica" => 8, "portugues" => 7],
        ],
    ];

    echo $turma["Maria"]["semestre2"]["portugues"] . "\n";

    foreach ($turma as $aluno => $semestres) {
        foreach ($semestres as $semestre => $materias) {
            foreach ($materias as $materia => $nota) {
                echo "$aluno - $semestre - $materia: $nota\n";
            }
        }
    }
    ?></pre>

    <h3>Contar elementos</h3>
    <pre>echo count($matriz);                    // só o primeiro nível (3 linhas)
echo count($matriz, COUNT_RECURSIVE);   // todos os níveis (3 linhas + 9 valores)</pre>
    <pre class="resultado"><?php
    echo count($matriz) . "\n";
    echo count($matriz, COUNT_RECURSIVE);
    ?></pre>

    <h3>Resumo: unidimensional x multidimensional</h3>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Unidimensional</th>
                <th>Multidimensional</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Estrutura</td><td>Uma lista simples</td><td>Arrays dentro de arrays</td></tr>
            <tr><td>Acesso</td><td><code>$a[0]</code></td><td><code>$a[0][1]</code></td></tr>
            <tr><td>Percorrer</td><td>Um <code>foreach</code></td><td>Um <code>foreach</code> por dimensão</td></tr>
            <tr><td>Quando usar</td><td>Listas de itens (nomes, notas)</td><td>Tabelas, matrizes, registros</td></tr>
        </tbody>
    </table>

    <h3>Array, vetor e matriz: qual a diferença?</h3>
    <p>Os três termos se misturam porque vêm de áreas diferentes: matemática, estrutura de dados e o nome que cada linguagem escolheu.</p>

    <h4>Na computação em geral</h4>
    <table>
        <thead>
            <tr>
                <th>Termo</th>
                <th>Origem</th>
                <th>Significado</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><strong>Array</strong></td><td>Estrutura de dados</td><td>Coleção de elementos guardados em sequência na memória, acessados por índice.</td></tr>
            <tr><td><strong>Vetor</strong></td><td>Matemática e computação</td><td>Array de <strong>uma dimensão</strong>: uma lista de elementos.</td></tr>
            <tr><td><strong>Matriz</strong></td><td>Matemática e computação</td><td>Array de <strong>duas dimensões</strong>: linhas e colunas.</td></tr>
        </tbody>
    </table>
    <p>Pela convenção clássica, muito usada em cursos de algoritmos e em C:</p>
    <ul>
        <li>array é o nome genérico, de qualquer número de dimensões;</li>
        <li>vetor é o array de 1 dimensão (<code>a[3]</code>);</li>
        <li>matriz é o array de 2 dimensões (<code>a[2][3]</code>);</li>
        <li>com 3 ou mais dimensões, diz-se "array multidimensional" ou, em matemática e machine learning, "tensor".</li>
    </ul>
    <p>Ou seja, vetor e matriz são <strong>casos particulares de array</strong>.</p>

    <h4>"Vetor" também tem outros sentidos</h4>
    <ul>
        <li>Em <strong>matemática e física</strong>, vetor é uma grandeza com direção e sentido, como a velocidade. Não tem relação com a estrutura de dados.</li>
        <li>Em <strong>C++</strong>, <code>std::vector</code> é um array que cresce e encolhe dinamicamente. Aqui "vetor" não é o array de tamanho fixo.</li>
        <li>Em <strong>gráficos</strong>, "imagem vetorial" é outro conceito (formas descritas por fórmulas).</li>
    </ul>

    <h4>Em diferentes linguagens</h4>
    <table>
        <thead>
            <tr>
                <th>Linguagem</th>
                <th>O que existe</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><strong>C</strong></td><td>Array de tamanho fixo e tipo único: <code>int a[5]</code>. Vetor é <code>a[5]</code>, matriz é <code>a[3][3]</code>.</td></tr>
            <tr><td><strong>Java</strong></td><td>Array de tamanho fixo e tipo único (<code>int[]</code>). Para tamanho variável, usa <code>ArrayList</code>.</td></tr>
            <tr><td><strong>C++</strong></td><td>Array fixo (<code>int a[5]</code>) e <code>std::vector</code>, de tamanho dinâmico.</td></tr>
            <tr><td><strong>Python</strong></td><td>Não tem array como tipo principal. Usa a <strong>lista</strong> (<code>list</code>), que cresce e aceita tipos misturados. Matriz é lista de listas. Para cálculo numérico, usa-se o <code>ndarray</code> do NumPy.</td></tr>
            <tr><td><strong>JavaScript</strong></td><td><code>Array</code>, dinâmico e com tipos misturados. Objetos fazem o papel de "arrays associativos".</td></tr>
            <tr><td><strong>R, MATLAB, Julia</strong></td><td>"Vetor" e "matriz" são tipos próprios, voltados para cálculo.</td></tr>
        </tbody>
    </table>

    <h4>No PHP</h4>
    <p>O PHP tem só <strong>um tipo</strong>, o <code>array</code>, e ele faz todos os papéis. Não existe um tipo "vetor" ou "matriz" na linguagem: esses nomes só descrevem o <strong>formato</strong> do seu array.</p>
    <pre>$vetor = [1, 2, 3];                 // vetor (1 dimensão)
$mat = [[1, 2], [3, 4]];            // matriz (2 dimensões)
$assoc = ["nome" => "Maria"];       // array associativo

echo gettype($vetor) . "\n";
echo gettype($mat) . "\n";
echo gettype($assoc);</pre>
    <pre class="resultado"><?php
    $vetor = [1, 2, 3];
    $mat = [[1, 2], [3, 4]];
    $assoc = ["nome" => "Maria"];

    echo gettype($vetor) . "\n";
    echo gettype($mat) . "\n";
    echo gettype($assoc);
    ?></pre>
    <p>Os três são do tipo <code>array</code>. O array do PHP é diferente do de C e Java porque:</p>
    <ul>
        <li>cresce e encolhe sozinho;</li>
        <li>aceita tipos misturados;</li>
        <li>aceita chaves numéricas e de texto no mesmo array;</li>
        <li>internamente é uma tabela hash ordenada, não um bloco contíguo de memória como em C.</li>
    </ul>
    <p>Por isso o array do PHP se parece mais com uma lista do Python junto com um dicionário do que com o array do C.</p>

    <h4>Resumo prático</h4>
    <table>
        <thead>
            <tr>
                <th>Termo</th>
                <th>Em resumo</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><strong>Array</strong></td><td>O nome da estrutura, em geral.</td></tr>
            <tr><td><strong>Vetor</strong></td><td>Array de 1 dimensão (cuidado com o <code>std::vector</code> do C++ e com o vetor da matemática).</td></tr>
            <tr><td><strong>Matriz</strong></td><td>Array de 2 dimensões, com linhas e colunas.</td></tr>
            <tr><td><strong>No PHP</strong></td><td>Tudo é <code>array</code>; "vetor" e "matriz" descrevem como você o organiza.</td></tr>
        </tbody>
    </table>

    <h2>8. object (objeto)</h2>
    <p>Instância de uma classe. Tem propriedades (dados) e métodos (funções). O acesso usa a seta <code>-></code>.</p>
    <pre>class Pessoa
{
    public string $nome = "Maria";
    public int $idade = 30;

    public function apresentar(): string
    {
        return "Oi, eu sou $this->nome";
    }
}

$p = new Pessoa();
echo $p->nome;
echo $p->apresentar();
var_dump($p);</pre>
    <pre class="resultado"><?php
    $p = new Pessoa();
    echo $p->nome . "\n";
    echo $p->apresentar() . "\n";
    mostrar($p);
    ?></pre>
    <p>É possível converter entre os dois: <code>(object) $array</code> cria um objeto simples, e <code>(array) $objeto</code> volta para array.</p>

    <h2>9. callable e closures</h2>
    <p>Valor que pode ser chamado como função: o nome de uma função, uma função anônima (closure) ou uma arrow function (<code>fn</code>).</p>
    <pre>$dobro = fn($x) => $x * 2;
$soma = function ($a, $b) {
    return $a + $b;
};
echo $dobro(5);
echo $soma(2, 3);
echo implode(", ", array_map($dobro, [1, 2, 3]));</pre>
    <pre class="resultado"><?php
    $dobro = fn($x) => $x * 2;
    $soma = function ($a, $b) {
        return $a + $b;
    };
    echo $dobro(5) . "\n";
    echo $soma(2, 3) . "\n";
    echo implode(", ", array_map($dobro, [1, 2, 3]));
    ?></pre>
    <p>No <code>var_dump</code>, uma closure aparece como <code>object(Closure)</code>.</p>

    <h2>10. iterable</h2>
    <p>Tipo usado em declarações de função. Aceita um array ou qualquer objeto que possa ser percorrido com <code>foreach</code>.</p>
    <pre>function listar(iterable $itens): void
{
    foreach ($itens as $item) {
        echo "- $item\n";
    }
}
listar(["a", "b", "c"]);</pre>
    <pre class="resultado"><?php
    function listar(iterable $itens): void
    {
        foreach ($itens as $item) {
            echo "- $item\n";
        }
    }
    listar(["a", "b", "c"]);
    ?></pre>

    <h2>11. null</h2>
    <p>Representa "nenhum valor". Uma variável é <code>null</code> quando recebe <code>null</code> explicitamente, nunca recebeu valor ou foi apagada com <code>unset()</code>.</p>
    <pre>$vazio = null;
var_dump($vazio);
var_dump(is_null($vazio));
var_dump(isset($vazio));
var_dump($vazio ?? "valor padrão");</pre>
    <pre class="resultado"><?php
    $vazio = null;
    mostrar($vazio);
    mostrar(is_null($vazio));
    mostrar(isset($vazio));
    mostrar($vazio ?? "valor padrão");
    ?></pre>
    <p>Para aceitar <code>null</code> em uma declaração, use <code>?string</code> (string ou null) ou <code>string|null</code>.</p>

    <h2>12. resource (recurso)</h2>
    <p>Referência a algo externo ao PHP, como um arquivo aberto ou uma conexão. É criado por funções como <code>fopen()</code> e deve ser liberado com <code>fclose()</code>.</p>
    <pre>$arquivo = fopen("php://memory", "r");
var_dump($arquivo);
echo get_resource_type($arquivo);
fclose($arquivo);</pre>
    <pre class="resultado"><?php
    $arquivo = fopen("php://memory", "r");
    mostrar($arquivo);
    echo get_resource_type($arquivo);
    fclose($arquivo);
    ?></pre>

    <h2>13. enum (PHP 8.1+)</h2>
    <p>Conjunto fixo de valores possíveis. Evita erros de digitação com textos soltos como <code>"ativo"</code>.</p>
    <pre>enum Status: string
{
    case Ativo = "ativo";
    case Inativo = "inativo";
}

$s = Status::Ativo;
echo $s->name;  // nome do caso
echo $s->value; // valor associado
var_dump($s);</pre>
    <pre class="resultado"><?php
    $s = Status::Ativo;
    echo $s->name . "\n";
    echo $s->value . "\n";
    mostrar($s);
    ?></pre>

    <h2>14. Pseudo-tipos: mixed, void e never</h2>
    <p>Usados só ao declarar tipos de parâmetros e retornos. Nenhuma variável tem esses tipos.</p>
    <ul>
        <li><code>mixed</code>: aceita qualquer tipo (a função <code>mostrar()</code> deste arquivo usa).</li>
        <li><code>void</code>: a função não devolve nada.</li>
        <li><code>never</code>: a função nunca termina normalmente (sempre dá <code>exit</code> ou lança exceção).</li>
    </ul>
    <pre>function saudar(string $nome): void
{
    echo "Oi, $nome";
}</pre>

    <h2>Descobrindo o tipo de uma variável</h2>
    <pre>$valor = 3.14;
echo gettype($valor);        // nome do tipo
echo get_debug_type($valor); // nome do tipo (mais preciso, PHP 8+)
var_dump(is_float($valor));  // is_int, is_string, is_array, is_bool, is_null...</pre>
    <pre class="resultado"><?php
    $valor = 3.14;
    echo gettype($valor) . "\n";
    echo get_debug_type($valor) . "\n";
    mostrar(is_float($valor));
    ?></pre>
    <table>
        <thead>
            <tr>
                <th>Valor</th>
                <th><code>gettype()</code></th>
                <th><code>get_debug_type()</code></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $amostras = [
                'true' => true,
                '42' => 42,
                '3.14' => 3.14,
                '"texto"' => "texto",
                '[1, 2]' => [1, 2],
                'null' => null,
                'new Pessoa()' => new Pessoa(),
            ];
            foreach ($amostras as $rotulo => $amostra): ?>
                <tr>
                    <td><code><?= htmlspecialchars((string) $rotulo) ?></code></td>
                    <td><?= gettype($amostra) ?></td>
                    <td><?= get_debug_type($amostra) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Conversão de tipos</h2>
    <p>O PHP converte tipos automaticamente quando precisa (<em>type juggling</em>), e você também pode converter manualmente com <em>cast</em>.</p>
    <pre>var_dump("5" + 3);       // string vira número na conta
var_dump("5" . 3);       // número vira string na concatenação
var_dump((int) "12abc"); // cast para int
var_dump((float) "3.5");
var_dump((string) 99);
var_dump((bool) "");
var_dump((array) "texto");</pre>
    <pre class="resultado"><?php
    mostrar("5" + 3);
    mostrar("5" . 3);
    mostrar((int) "12abc");
    mostrar((float) "3.5");
    mostrar((string) 99);
    mostrar((bool) "");
    mostrar((array) "texto");
    ?></pre>
    <p>
        Casts disponíveis: <code>(int)</code>, <code>(float)</code>, <code>(string)</code>, <code>(bool)</code>,
        <code>(array)</code> e <code>(object)</code>.
        Funções equivalentes: <code>intval()</code>, <code>floatval()</code>, <code>strval()</code>, <code>boolval()</code>.
    </p>

    <h2>Tipagem em funções</h2>
    <p>Dá para declarar os tipos de parâmetros e retornos. Com <code>declare(strict_types=1);</code> na primeira linha do arquivo, o PHP deixa de converter tipos sozinho e dá erro se o tipo estiver errado.</p>
    <pre>function somar(int $a, int $b): int
{
    return $a + $b;
}

echo somar(2, 3);
echo somar("2", "3"); // funciona sem strict_types (converte);
                       // com strict_types=1 gera TypeError</pre>
    <pre class="resultado"><?php
    function somar(int $a, int $b): int
    {
        return $a + $b;
    }
    echo somar(2, 3) . "\n";
    echo somar("2", "3");
    ?></pre>
    <p>Tipos de união: <code>int|string</code>. Tipos que aceitam null: <code>?int</code>.</p>
</body>
</html>
