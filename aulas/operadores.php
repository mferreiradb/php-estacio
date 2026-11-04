<?php

$var1 = 4; //a variável foi inicializada com o valor de 4
$var1 += 2; //com a utilização da combinação de operadores a variável $var1 passou a ter o valor de 6 (4 + 2)
$var1 *= 2; //com a utilização da combinação de operadores a variável $var1 passou a ter o valor de 12 (4 + 2) * 2

$var2 = "Programação";
$var2 .= " com PHP"; //com a utilização da combinação de operadores a variável $var2 passou a ter o conteúdo "Programação com PHP"

$var = ($var4 = "Copie esses códigos") . " e pratique seus conhecimentos!" ;
/*
No exemplo acima o conteúdo da variável $var3 é igual a "Copie esses códigos e pratique seus conhecimentos!"
Já a variável $var4 possui o conteúdo "Copie esses códigos"
*/

$a = 10;
$b = 3;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operadores Lógicos</title>
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
            margin-top: 32px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px 14px;
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
    </style>
</head>
<body>
    <h1>Operadores em PHP</h1>

    <h2>Operadores Aritméticos</h2>
    <p>Nos exemplos: <code>$a = 10;</code> e <code>$b = 3;</code></p>
    <table>
        <thead>
            <tr>
                <th>Operador</th>
                <th>Exemplo</th>
                <th>Explicação</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>+</code></td>
                <td><code>$a + $b</code></td>
                <td>Adição: soma $a e $b</td>
                <td><?= $a + $b ?></td>
            </tr>
            <tr>
                <td><code>-</code></td>
                <td><code>$a - $b</code></td>
                <td>Subtração: subtrai $b de $a</td>
                <td><?= $a - $b ?></td>
            </tr>
            <tr>
                <td><code>*</code></td>
                <td><code>$a * $b</code></td>
                <td>Multiplicação: multiplica $a por $b</td>
                <td><?= $a * $b ?></td>
            </tr>
            <tr>
                <td><code>/</code></td>
                <td><code>$a / $b</code></td>
                <td>Divisão: divide $a por $b</td>
                <td><?= $a / $b ?></td>
            </tr>
            <tr>
                <td><code>%</code></td>
                <td><code>$a % $b</code></td>
                <td>Módulo: resto da divisão de $a por $b</td>
                <td><?= $a % $b ?></td>
            </tr>
            <tr>
                <td><code>**</code></td>
                <td><code>$a ** $b</code></td>
                <td>Exponenciação: $a elevado a $b</td>
                <td><?= $a ** $b ?></td>
            </tr>
            <tr>
                <td><code>-</code></td>
                <td><code>-$a</code></td>
                <td>Negação: inverte o sinal de $a</td>
                <td><?= -$a ?></td>
            </tr>
        </tbody>
    </table>

    <h2>Operadores de Atribuição</h2>
    <table>
        <thead>
            <tr>
                <th>Operador</th>
                <th>Exemplo</th>
                <th>Explicação</th>
                <th>Valor final</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>+=</code></td>
                <td><code>$var1 = 4;<br>$var1 += 2;</code></td>
                <td>Soma e atribui: $var1 passa a valer 6 (4 + 2)</td>
                <td rowspan="2"><?= htmlspecialchars($var1) ?><br><small>(após <code>*= 2</code>)</small></td>
            </tr>
            <tr>
                <td><code>*=</code></td>
                <td><code>$var1 *= 2;</code></td>
                <td>Multiplica e atribui: $var1 passa a valer 12 (6 * 2)</td>
            </tr>
            <tr>
                <td><code>.=</code></td>
                <td><code>$var2 = "Programação";<br>$var2 .= " com PHP";</code></td>
                <td>Concatena e atribui: $var2 passa a ter o conteúdo "Programação com PHP"</td>
                <td><?= htmlspecialchars($var2) ?></td>
            </tr>
            <tr>
                <td><code>=</code></td>
                <td><code>$var = ($var4 = "Copie esses códigos") . " e pratique seus conhecimentos!";</code></td>
                <td>Atribuição dentro de uma expressão: $var4 recebe "Copie esses códigos" e $var recebe o texto completo</td>
                <td>
                    $var4: <?= htmlspecialchars($var4) ?><br>
                    $var: <?= htmlspecialchars($var) ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h2>Operadores Lógicos ou de comparação</h2>
    <table>
        <thead>
            <tr>
                <th>Operador</th>
                <th>Exemplo</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>and</code></td>
                <td><code>$var1 and $var2</code></td>
                <td>Retorna true se $var1 E $var2 forem verdadeiras</td>
            </tr>
            <tr>
                <td><code>or</code></td>
                <td><code>$var1 or $var2</code></td>
                <td>Retorna true se $var1 OU $var2 forem verdadeiras</td>
            </tr>
            <tr>
                <td><code>xor</code></td>
                <td><code>$var1 xor $var2</code></td>
                <td>Retorna true se $var1 OU $var2 forem verdadeiras, mas não ambas</td>
            </tr>
            <tr>
                <td><code>!</code></td>
                <td><code>!$var1</code></td>
                <td>Retorna true se $var1 não for verdadeira</td>
            </tr>
            <tr>
                <td><code>&amp;&amp;</code></td>
                <td><code>$var1 &amp;&amp; $var2</code></td>
                <td>Retorna true se $var1 E $var2 forem verdadeiras</td>
            </tr>
            <tr>
                <td><code>||</code></td>
                <td><code>$var1 || $var2</code></td>
                <td>Retorna true se $var1 OU $var2 forem verdadeiras</td>
            </tr>
        </tbody>
    </table>
</body>
</html>