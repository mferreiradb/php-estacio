<?php

$idade = 20;
$nota = 7.5;
$dia = 3;
$usuario = null;
$cor = "verde";
$logado = true;
$mensagens = 5;
$frutas = ["maçã", "banana", "uva"];
$pessoa = ["nome" => "Maria", "idade" => 30, "cidade" => "Recife"];

/*
Cada exemplo abaixo tem duas partes:
- o código mostrado na tela (dentro de <pre>), apenas como texto
- o mesmo código executado de verdade, para mostrar o resultado
*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condicionais e Repetições</title>
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
        .resultado {
            background: #e6f4ea;
            color: #1e5b2f;
            border-radius: 4px;
            padding: 10px 14px;
        }
        code {
            background: #eef;
            padding: 2px 6px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <h1>Estruturas Condicionais e de Repetição em PHP</h1>
    <p>
        Variáveis usadas nos exemplos:
        <code>$idade = 20</code>, <code>$nota = 7.5</code>, <code>$dia = 3</code>,
        <code>$usuario = null</code>, <code>$cor = "verde"</code>,
        <code>$logado = true</code>, <code>$mensagens = 5</code>,
        <code>$frutas = ["maçã", "banana", "uva"]</code>,
        <code>$pessoa = ["nome" => "Maria", "idade" => 30, "cidade" => "Recife"]</code>
    </p>
    <p>Parte 1: estruturas condicionais (exemplos 1 a 15). Parte 2: estruturas de repetição (exemplos 16 a 25).</p>

    <h2>1. if</h2>
    <p>Executa o bloco apenas se a condição for verdadeira.</p>
    <pre>if ($idade >= 18) {
    echo "Maior de idade";
}</pre>
    <div class="resultado">
        <?php
        if ($idade >= 18) {
            echo "Maior de idade";
        }
        ?>
    </div>

    <h2>2. if / else</h2>
    <p>Executa um bloco se a condição for verdadeira e outro se for falsa.</p>
    <pre>if ($idade >= 18) {
    echo "Pode entrar";
} else {
    echo "Entrada proibida";
}</pre>
    <div class="resultado">
        <?php
        if ($idade >= 18) {
            echo "Pode entrar";
        } else {
            echo "Entrada proibida";
        }
        ?>
    </div>

    <h2>3. if / elseif / else</h2>
    <p>Testa várias condições em sequência. Só o primeiro bloco verdadeiro é executado.</p>
    <pre>if ($nota >= 9) {
    echo "Excelente";
} elseif ($nota >= 7) {
    echo "Aprovado";
} elseif ($nota >= 5) {
    echo "Recuperação";
} else {
    echo "Reprovado";
}</pre>
    <div class="resultado">
        <?php
        if ($nota >= 9) {
            echo "Excelente";
        } elseif ($nota >= 7) {
            echo "Aprovado";
        } elseif ($nota >= 5) {
            echo "Recuperação";
        } else {
            echo "Reprovado";
        }
        ?>
    </div>

    <h2>4. if com operadores lógicos</h2>
    <p>Combina condições com <code>&amp;&amp;</code> (E), <code>||</code> (OU) e <code>!</code> (NÃO).</p>
    <pre>if ($logado &amp;&amp; $mensagens > 0) {
    echo "Você tem $mensagens mensagens";
}

if (!$logado || $idade &lt; 18) {
    echo "Acesso restrito";
} else {
    echo "Acesso liberado";
}</pre>
    <div class="resultado">
        <?php
        if ($logado && $mensagens > 0) {
            echo "Você tem $mensagens mensagens";
        }
        echo "<br>";
        if (!$logado || $idade < 18) {
            echo "Acesso restrito";
        } else {
            echo "Acesso liberado";
        }
        ?>
    </div>

    <h2>5. if aninhado</h2>
    <p>Um <code>if</code> dentro de outro. Evite muitos níveis, pois o código fica difícil de ler.</p>
    <pre>if ($logado) {
    if ($idade >= 18) {
        echo "Bem-vindo à área adulta";
    } else {
        echo "Bem-vindo à área infantil";
    }
} else {
    echo "Faça login";
}</pre>
    <div class="resultado">
        <?php
        if ($logado) {
            if ($idade >= 18) {
                echo "Bem-vindo à área adulta";
            } else {
                echo "Bem-vindo à área infantil";
            }
        } else {
            echo "Faça login";
        }
        ?>
    </div>

    <h2>6. Operador ternário (? :)</h2>
    <p>Forma curta de um <code>if / else</code> que devolve um valor: <code>condição ? se_verdadeiro : se_falso</code>.</p>
    <pre>echo $idade >= 18 ? "Maior de idade" : "Menor de idade";</pre>
    <div class="resultado">
        <?php echo $idade >= 18 ? "Maior de idade" : "Menor de idade"; ?>
    </div>

    <h2>7. Ternário curto (?:)</h2>
    <p>Devolve o valor da esquerda se ele for "verdadeiro" (não vazio, diferente de 0, false ou null). Senão, devolve o da direita.</p>
    <pre>$nome = "";
echo $nome ?: "Visitante";</pre>
    <div class="resultado">
        <?php
        $nome = "";
        echo $nome ?: "Visitante";
        ?>
    </div>

    <h2>8. Null coalescing (??)</h2>
    <p>Devolve o valor da esquerda se a variável existir e não for <code>null</code>. Senão, devolve o da direita. Não gera aviso se a variável não existir.</p>
    <pre>echo $usuario ?? "Usuário não informado";
echo $_GET['pagina'] ?? 1;</pre>
    <div class="resultado">
        <?php
        echo $usuario ?? "Usuário não informado";
        echo "<br>";
        echo $_GET['pagina'] ?? 1;
        ?>
    </div>
    <p>Diferença: <code>?:</code> considera vazio e 0 como falso, <code>??</code> só considera <code>null</code> e variável inexistente.</p>

    <h2>9. Operador de atribuição null coalescing (??=)</h2>
    <p>Atribui um valor só se a variável ainda for <code>null</code> ou não existir.</p>
    <pre>$usuario ??= "Maria";
echo $usuario;</pre>
    <div class="resultado">
        <?php
        $usuario ??= "Maria";
        echo $usuario;
        ?>
    </div>

    <h2>10. switch</h2>
    <p>Compara uma variável com vários valores. Use <code>break</code> para sair do <code>switch</code>, senão o PHP continua nos casos seguintes. O <code>default</code> cobre os demais casos.</p>
    <pre>switch ($dia) {
    case 1:
        echo "Domingo";
        break;
    case 2:
        echo "Segunda-feira";
        break;
    case 3:
        echo "Terça-feira";
        break;
    default:
        echo "Outro dia";
}</pre>
    <div class="resultado">
        <?php
        switch ($dia) {
            case 1:
                echo "Domingo";
                break;
            case 2:
                echo "Segunda-feira";
                break;
            case 3:
                echo "Terça-feira";
                break;
            default:
                echo "Outro dia";
        }
        ?>
    </div>

    <h2>11. switch com vários casos juntos</h2>
    <p>Casos sem <code>break</code> "caem" no próximo, o que permite agrupar valores.</p>
    <pre>switch ($cor) {
    case "vermelho":
    case "laranja":
        echo "Cor quente";
        break;
    case "azul":
    case "verde":
        echo "Cor fria";
        break;
    default:
        echo "Cor desconhecida";
}</pre>
    <div class="resultado">
        <?php
        switch ($cor) {
            case "vermelho":
            case "laranja":
                echo "Cor quente";
                break;
            case "azul":
            case "verde":
                echo "Cor fria";
                break;
            default:
                echo "Cor desconhecida";
        }
        ?>
    </div>

    <h2>12. match (PHP 8+)</h2>
    <p>Parecido com o <code>switch</code>, mas devolve um valor, compara com <code>===</code> (tipo e valor), não precisa de <code>break</code> e lança erro se nenhum caso combinar e não houver <code>default</code>.</p>
    <pre>$nomeDia = match ($dia) {
    1 => "Domingo",
    2 => "Segunda-feira",
    3 => "Terça-feira",
    4, 5 => "Quarta ou quinta",
    default => "Outro dia",
};
echo $nomeDia;</pre>
    <div class="resultado">
        <?php
        $nomeDia = match ($dia) {
            1 => "Domingo",
            2 => "Segunda-feira",
            3 => "Terça-feira",
            4, 5 => "Quarta ou quinta",
            default => "Outro dia",
        };
        echo $nomeDia;
        ?>
    </div>

    <h2>13. match com condições</h2>
    <p>Usar <code>match (true)</code> permite testar intervalos e expressões.</p>
    <pre>$conceito = match (true) {
    $nota >= 9 => "A",
    $nota >= 7 => "B",
    $nota >= 5 => "C",
    default => "D",
};
echo $conceito;</pre>
    <div class="resultado">
        <?php
        $conceito = match (true) {
            $nota >= 9 => "A",
            $nota >= 7 => "B",
            $nota >= 5 => "C",
            default => "D",
        };
        echo $conceito;
        ?>
    </div>

    <h2>14. Sintaxe alternativa (if: ... endif)</h2>
    <p>Usa <code>:</code> e <code>endif</code> no lugar das chaves. É comum para misturar PHP com HTML, pois fica mais legível.</p>
    <pre>&lt;?php if ($logado): ?&gt;
    &lt;p&gt;Você está logado&lt;/p&gt;
&lt;?php else: ?&gt;
    &lt;p&gt;Faça login&lt;/p&gt;
&lt;?php endif; ?&gt;</pre>
    <div class="resultado">
        <?php if ($logado): ?>
            <p>Você está logado</p>
        <?php else: ?>
            <p>Faça login</p>
        <?php endif; ?>
    </div>
    <p>Também existem <code>elseif: ... endif</code>, <code>switch: ... endswitch</code> e, para repetições, <code>foreach: ... endforeach</code>.</p>

    <h2>15. Operador nave espacial (&lt;=&gt;)</h2>
    <p>Compara dois valores e devolve <code>-1</code> (menor), <code>0</code> (igual) ou <code>1</code> (maior). Útil com <code>match</code> ou <code>switch</code>.</p>
    <pre>echo 5 &lt;=> 10; // -1
echo 10 &lt;=> 10; // 0
echo 15 &lt;=> 10; // 1</pre>
    <div class="resultado">
        <?php
        echo 5 <=> 10;
        echo "<br>";
        echo 10 <=> 10;
        echo "<br>";
        echo 15 <=> 10;
        ?>
    </div>

    <h2>Cuidado: <code>=</code>, <code>==</code> e <code>===</code></h2>
    <ul>
        <li><code>=</code> atribui um valor (<code>$a = 5</code>). Em um <code>if</code>, quase sempre é erro de digitação.</li>
        <li><code>==</code> compara só o valor, convertendo tipos (<code>"5" == 5</code> é <code>true</code>).</li>
        <li><code>===</code> compara valor e tipo (<code>"5" === 5</code> é <code>false</code>). Prefira este.</li>
    </ul>
    <pre>var_dump("5" == 5);   // true
var_dump("5" === 5);  // false</pre>
    <div class="resultado">
        <?php
        var_dump("5" == 5);
        echo "<br>";
        var_dump("5" === 5);
        ?>
    </div>

    <h1>Estruturas de Repetição</h1>
    <p>Repetem um bloco de código enquanto uma condição for verdadeira ou para cada item de uma lista.</p>

    <h2>16. for</h2>
    <p>Usado quando se sabe quantas vezes repetir. Tem três partes: início (<code>$i = 1</code>), condição (<code>$i &lt;= 5</code>) e passo (<code>$i++</code>).</p>
    <pre>for ($i = 1; $i &lt;= 5; $i++) {
    echo "Contagem: $i&lt;br&gt;";
}</pre>
    <div class="resultado">
        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo "Contagem: $i<br>";
        }
        ?>
    </div>

    <h2>17. while</h2>
    <p>Repete enquanto a condição for verdadeira. A condição é testada antes de cada volta, então pode nunca executar. Lembre de alterar a variável dentro do bloco, senão o laço nunca termina.</p>
    <pre>$contador = 1;
while ($contador &lt;= 3) {
    echo "Volta $contador&lt;br&gt;";
    $contador++;
}</pre>
    <div class="resultado">
        <?php
        $contador = 1;
        while ($contador <= 3) {
            echo "Volta $contador<br>";
            $contador++;
        }
        ?>
    </div>

    <h2>18. do ... while</h2>
    <p>Como o <code>while</code>, mas a condição é testada depois. Por isso o bloco executa pelo menos uma vez.</p>
    <pre>$n = 10;
do {
    echo "Executou com n = $n";
    $n++;
} while ($n &lt; 5);</pre>
    <div class="resultado">
        <?php
        $n = 10;
        do {
            echo "Executou com n = $n";
            $n++;
        } while ($n < 5);
        ?>
    </div>
    <p>Mesmo com a condição falsa desde o início (<code>10 &lt; 5</code>), o bloco rodou uma vez.</p>

    <h2>19. foreach (valores)</h2>
    <p>Percorre cada item de um array. É a forma mais usada para listas.</p>
    <pre>foreach ($frutas as $fruta) {
    echo "Fruta: $fruta&lt;br&gt;";
}</pre>
    <div class="resultado">
        <?php
        foreach ($frutas as $fruta) {
            echo "Fruta: $fruta<br>";
        }
        ?>
    </div>

    <h2>20. foreach (chave e valor)</h2>
    <p>Com <code>$chave => $valor</code>, acessa também o índice ou o nome da chave. Muito usado com arrays associativos.</p>
    <pre>foreach ($pessoa as $campo => $valor) {
    echo "$campo: $valor&lt;br&gt;";
}</pre>
    <div class="resultado">
        <?php
        foreach ($pessoa as $campo => $valor) {
            echo "$campo: $valor<br>";
        }
        ?>
    </div>

    <h2>21. break</h2>
    <p>Interrompe o laço imediatamente.</p>
    <pre>for ($i = 1; $i &lt;= 10; $i++) {
    if ($i == 4) {
        break;
    }
    echo "$i ";
}</pre>
    <div class="resultado">
        <?php
        for ($i = 1; $i <= 10; $i++) {
            if ($i == 4) {
                break;
            }
            echo "$i ";
        }
        ?>
    </div>

    <h2>22. continue</h2>
    <p>Pula o resto da volta atual e vai para a próxima.</p>
    <pre>for ($i = 1; $i &lt;= 6; $i++) {
    if ($i % 2 == 0) {
        continue; // pula os pares
    }
    echo "$i ";
}</pre>
    <div class="resultado">
        <?php
        for ($i = 1; $i <= 6; $i++) {
            if ($i % 2 == 0) {
                continue;
            }
            echo "$i ";
        }
        ?>
    </div>

    <h2>23. Laços aninhados</h2>
    <p>Um laço dentro de outro. O de dentro roda por completo a cada volta do de fora. Exemplo: tabuada.</p>
    <pre>for ($i = 1; $i &lt;= 3; $i++) {
    for ($j = 1; $j &lt;= 3; $j++) {
        echo $i * $j . " ";
    }
    echo "&lt;br&gt;";
}</pre>
    <div class="resultado">
        <?php
        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                echo $i * $j . " ";
            }
            echo "<br>";
        }
        ?>
    </div>

    <h2>24. Sintaxe alternativa</h2>
    <p>Com <code>:</code> e <code>endfor</code>, <code>endwhile</code> ou <code>endforeach</code>. Facilita misturar PHP e HTML, como em listas e tabelas.</p>
    <pre>&lt;ul&gt;
&lt;?php foreach ($frutas as $fruta): ?&gt;
    &lt;li&gt;&lt;?= $fruta ?&gt;&lt;/li&gt;
&lt;?php endforeach; ?&gt;
&lt;/ul&gt;</pre>
    <div class="resultado">
        <ul>
        <?php foreach ($frutas as $fruta): ?>
            <li><?= $fruta ?></li>
        <?php endforeach; ?>
        </ul>
    </div>

    <h2>25. foreach alterando o array (por referência)</h2>
    <p>Por padrão, o <code>foreach</code> trabalha com uma cópia de cada valor. Com <code>&amp;</code>, a alteração vale para o array original. Use <code>unset</code> no fim para desfazer a referência.</p>
    <pre>$numeros = [1, 2, 3];
foreach ($numeros as &amp;$numero) {
    $numero = $numero * 2;
}
unset($numero);
echo implode(", ", $numeros);</pre>
    <div class="resultado">
        <?php
        $numeros = [1, 2, 3];
        foreach ($numeros as &$numero) {
            $numero = $numero * 2;
        }
        unset($numero);
        echo implode(", ", $numeros);
        ?>
    </div>
</body>
</html>
