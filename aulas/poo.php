<?php

function mostrar(mixed ...$valores): void
{
    ob_start();
    var_dump(...$valores);
    echo htmlspecialchars(ob_get_clean());
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes em PHP</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 40px auto; padding: 0 16px; color: #222; }
        h1 { text-align: center; }
        h2 { margin-top: 40px; border-bottom: 2px solid #4a6fa5; padding-bottom: 4px; }
        pre {
            background: #f4f6fa; border: 1px solid #ccc;
            border-radius: 4px; padding: 12px; overflow-x: auto;
        }
        pre.resultado { background: #e6f4ea; color: #1e5b2f; border-color: #b9dcc3; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; vertical-align: top; }
        th { background: #4a6fa5; color: #fff; }
        tr:nth-child(even) { background: #f4f6fa; }
        code { background: #eef; padding: 2px 6px; border-radius: 3px; }
        table code { background: none; padding: 0; }
        .aviso { border-left: 5px solid #e0a800; background: #fffbe6; border-radius: 4px; padding: 8px 16px; }
    </style>
</head>
<body>
<h1>Classes em PHP</h1>
<p>Uma <strong>classe</strong> é um molde que define atributos (dados) e métodos (comportamentos). Um <strong>objeto</strong> é uma instância desse molde criada em tempo de execução.</p>

<h2>Os 4 pilares da POO</h2>
<table>
    <thead><tr><th>Pilar</th><th>O que é</th><th>Como aparece em PHP</th></tr></thead>
    <tbody>
        <tr>
            <td><strong>Encapsulamento</strong></td>
            <td>Esconder o estado interno do objeto, expondo apenas o necessário</td>
            <td><code>private</code> / <code>protected</code> + métodos públicos de acesso</td>
        </tr>
        <tr>
            <td><strong>Herança</strong></td>
            <td>Uma classe herda atributos e métodos de outra, reaproveitando e especializando comportamento</td>
            <td><code>extends</code></td>
        </tr>
        <tr>
            <td><strong>Polimorfismo</strong></td>
            <td>Objetos de classes diferentes respondem ao mesmo método de formas distintas</td>
            <td>Sobrescrita de métodos em subclasses (<code>override</code>)</td>
        </tr>
        <tr>
            <td><strong>Abstração</strong></td>
            <td>Modelar apenas o que é relevante, ocultando detalhes de implementação</td>
            <td><code>abstract class</code>, <code>interface</code></td>
        </tr>
    </tbody>
</table>
<p>As seções abaixo detalham cada um com exemplos.</p>

<h2>1. Definição básica</h2>
<pre>class Produto
{
    public string $nome;
    public float $preco;

    public function __construct(string $nome, float $preco)
    {
        $this->nome  = $nome;
        $this->preco = $preco;
    }

    public function descricao(): string
    {
        return "$this->nome custa R$ $this->preco";
    }
}

$p = new Produto('Caneta', 2.50);
echo $p->descricao();</pre>
<pre class="resultado"><?php
class Produto
{
    public string $nome;
    public float $preco;

    public function __construct(string $nome, float $preco)
    {
        $this->nome  = $nome;
        $this->preco = $preco;
    }

    public function descricao(): string
    {
        return "$this->nome custa R$ $this->preco";
    }
}

$p = new Produto('Caneta', 2.50);
echo $p->descricao();
?></pre>

<h2>2. Encapsulamento — visibilidade</h2>
<p><strong>Encapsulamento</strong>: esconder o estado interno do objeto e expor só o necessário via métodos públicos. Implementado com os modificadores de visibilidade.</p>
<table>
    <thead><tr><th>Modificador</th><th>Acesso</th></tr></thead>
    <tbody>
        <tr><td><code>public</code></td><td>Em qualquer lugar</td></tr>
        <tr><td><code>protected</code></td><td>Na própria classe e nas subclasses</td></tr>
        <tr><td><code>private</code></td><td>Somente na própria classe</td></tr>
    </tbody>
</table>
<pre>class ContaBancaria
{
    private float $saldo;

    public function __construct(float $saldoInicial)
    {
        $this->saldo = $saldoInicial;
    }

    public function depositar(float $valor): void
    {
        $this->saldo += $valor;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}

$conta = new ContaBancaria(100.0);
$conta->depositar(50.0);
echo $conta->getSaldo();   // 150
// echo $conta->saldo;     // Fatal error: acesso a propriedade private</pre>
<pre class="resultado"><?php
class ContaBancaria
{
    private float $saldo;

    public function __construct(float $saldoInicial)
    {
        $this->saldo = $saldoInicial;
    }

    public function depositar(float $valor): void
    {
        $this->saldo += $valor;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}

$conta = new ContaBancaria(100.0);
$conta->depositar(50.0);
echo $conta->getSaldo();
?></pre>

<h2>3. Herança</h2>
<p><strong>Herança</strong>: uma subclasse reutiliza e especializa atributos e métodos da classe pai com <code>extends</code>. Use <code>parent::</code> para chamar o construtor ou métodos do pai.</p>
<pre>class Animal
{
    public function __construct(public string $nome) {}

    public function falar(): string
    {
        return '...';
    }
}

class Cachorro extends Animal
{
    public function falar(): string
    {
        return 'Au au!';
    }
}

class Gato extends Animal
{
    public function falar(): string
    {
        return 'Miau!';
    }
}

$animais = [new Cachorro('Rex'), new Gato('Mimi')];
foreach ($animais as $a) {
    echo "$a->nome: " . $a->falar() . "\n";
}</pre>
<pre class="resultado"><?php
class Animal
{
    public function __construct(public string $nome) {}

    public function falar(): string
    {
        return '...';
    }
}

class Cachorro extends Animal
{
    public function falar(): string
    {
        return 'Au au!';
    }
}

class Gato extends Animal
{
    public function falar(): string
    {
        return 'Miau!';
    }
}

$animais = [new Cachorro('Rex'), new Gato('Mimi')];
foreach ($animais as $a) {
    echo "$a->nome: " . $a->falar() . "\n";
}
?></pre>

<h2>3.1 Polimorfismo</h2>
<p><strong>Polimorfismo</strong>: objetos de classes diferentes respondem ao mesmo método de formas distintas. Em PHP é implementado sobrescrevendo métodos em subclasses.</p>
<pre>class Pagamento
{
    public function processar(): string
    {
        return 'processando...';
    }
}

class PagamentoPix extends Pagamento
{
    public function processar(): string
    {
        return 'Pix enviado instantaneamente';
    }
}

class PagamentoCartao extends Pagamento
{
    public function processar(): string
    {
        return 'Cartão cobrado em 1 a 2 dias';
    }
}

$pagamentos = [new PagamentoPix(), new PagamentoCartao()];
foreach ($pagamentos as $pg) {
    echo $pg->processar() . "\n"; // mesmo método, resultados diferentes
}</pre>
<pre class="resultado"><?php
class Pagamento
{
    public function processar(): string
    {
        return 'processando...';
    }
}

class PagamentoPix extends Pagamento
{
    public function processar(): string
    {
        return 'Pix enviado instantaneamente';
    }
}

class PagamentoCartao extends Pagamento
{
    public function processar(): string
    {
        return 'Cartão cobrado em 1 a 2 dias';
    }
}

$pagamentos = [new PagamentoPix(), new PagamentoCartao()];
foreach ($pagamentos as $pg) {
    echo $pg->processar() . "\n";
}
?></pre>

<h2>4. Atributos e métodos estáticos</h2>
<p>Pertencem à classe, não ao objeto. Acesso via <code>::</code> (sem instanciar).</p>
<pre>class Contador
{
    private static int $total = 0;

    public static function incrementar(): void
    {
        self::$total++;
    }

    public static function getTotal(): int
    {
        return self::$total;
    }
}

Contador::incrementar();
Contador::incrementar();
Contador::incrementar();
echo Contador::getTotal(); // 3</pre>
<pre class="resultado"><?php
class Contador
{
    private static int $total = 0;

    public static function incrementar(): void
    {
        self::$total++;
    }

    public static function getTotal(): int
    {
        return self::$total;
    }
}

Contador::incrementar();
Contador::incrementar();
Contador::incrementar();
echo Contador::getTotal();
?></pre>

<h2>5. Abstração — interfaces</h2>
<p><strong>Abstração</strong>: modelar apenas o que é relevante, ocultando detalhes internos. Interfaces definem um contrato — quais métodos a classe <em>deve</em> implementar — sem expor como.</p>
<pre>interface Exportavel
{
    public function exportar(): string;
}

class Relatorio implements Exportavel
{
    public function __construct(private string $titulo) {}

    public function exportar(): string
    {
        return "Exportando: $this->titulo";
    }
}

$r = new Relatorio('Vendas');
echo $r->exportar();</pre>
<pre class="resultado"><?php
interface Exportavel
{
    public function exportar(): string;
}

class Relatorio implements Exportavel
{
    public function __construct(private string $titulo) {}

    public function exportar(): string
    {
        return "Exportando: $this->titulo";
    }
}

$r = new Relatorio('Vendas');
echo $r->exportar();
?></pre>

<h2>6. Abstração — classes abstratas</h2>
<p>Outra forma de abstração. Não podem ser instanciadas diretamente. Definem métodos concretos (com implementação) e abstratos (que a subclasse deve implementar).</p>
<pre>abstract class Forma
{
    abstract public function area(): float;

    public function descricao(): string
    {
        return 'Área: ' . $this->area();
    }
}

class Circulo extends Forma
{
    public function __construct(private float $raio) {}

    public function area(): float
    {
        return M_PI * $this->raio ** 2;
    }
}

class Retangulo extends Forma
{
    public function __construct(private float $l, private float $a) {}

    public function area(): float
    {
        return $this->l * $this->a;
    }
}

$formas = [new Circulo(3), new Retangulo(4, 5)];
foreach ($formas as $f) {
    echo $f->descricao() . "\n";
}</pre>
<pre class="resultado"><?php
abstract class Forma
{
    abstract public function area(): float;

    public function descricao(): string
    {
        return 'Área: ' . round($this->area(), 4);
    }
}

class Circulo extends Forma
{
    public function __construct(private float $raio) {}

    public function area(): float
    {
        return M_PI * $this->raio ** 2;
    }
}

class Retangulo extends Forma
{
    public function __construct(private float $l, private float $a) {}

    public function area(): float
    {
        return $this->l * $this->a;
    }
}

$formas = [new Circulo(3), new Retangulo(4, 5)];
foreach ($formas as $f) {
    echo $f->descricao() . "\n";
}
?></pre>

<h2>7. Métodos mágicos comuns</h2>
<table>
    <thead><tr><th>Método</th><th>Quando é chamado</th></tr></thead>
    <tbody>
        <tr><td><code>__construct()</code></td><td>Ao criar o objeto com <code>new</code></td></tr>
        <tr><td><code>__destruct()</code></td><td>Quando o objeto é destruído</td></tr>
        <tr><td><code>__toString()</code></td><td>Ao usar o objeto como string (ex.: <code>echo $obj</code>)</td></tr>
        <tr><td><code>__get($nome)</code></td><td>Ao ler propriedade inacessível</td></tr>
        <tr><td><code>__set($nome, $val)</code></td><td>Ao escrever em propriedade inacessível</td></tr>
        <tr><td><code>__call($nome, $args)</code></td><td>Ao chamar método inexistente</td></tr>
    </tbody>
</table>
<pre>class Ponto
{
    public function __construct(
        public float $x,
        public float $y,
    ) {}

    public function __toString(): string
    {
        return "($this->x, $this->y)";
    }
}

$p = new Ponto(3, 4);
echo $p;</pre>
<pre class="resultado"><?php
class Ponto
{
    public function __construct(
        public float $x,
        public float $y,
    ) {}

    public function __toString(): string
    {
        return "($this->x, $this->y)";
    }
}

$p = new Ponto(3, 4);
echo $p;
?></pre>

<h2>8. <code>-></code> vs <code>::</code></h2>
<table>
    <thead><tr><th></th><th><code>-></code></th><th><code>::</code></th></tr></thead>
    <tbody>
        <tr><td>Nome</td><td>Operador de objeto</td><td>Operador de resolução de escopo</td></tr>
        <tr><td>Usado em</td><td>Instâncias (<code>$obj</code>)</td><td>Classes, estáticos, constantes, <code>parent</code>, <code>self</code></td></tr>
        <tr><td>Requer instância</td><td>Sim</td><td>Não</td></tr>
        <tr><td>Exemplo</td><td><code>$obj->metodo()</code></td><td><code>Classe::metodo()</code></td></tr>
    </tbody>
</table>
<pre>class Exemplo
{
    public static string $tipo = 'estático';
    public string $nome;

    public function __construct(string $nome)
    {
        $this->nome = $nome;   // -> acessa propriedade do objeto
    }

    public static function criar(string $nome): static
    {
        return new static($nome);  // :: chama sem instância
    }
}

// :: sem instância
echo Exemplo::$tipo . "\n";
$e = Exemplo::criar('teste');

// -> com instância
echo $e->nome;</pre>
<pre class="resultado"><?php
class Exemplo
{
    public static string $tipo = 'estático';
    public string $nome;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public static function criar(string $nome): static
    {
        return new static($nome);
    }
}

echo Exemplo::$tipo . "\n";
$e = Exemplo::criar('teste');
echo $e->nome;
?></pre>
<p class="aviso"><code>self::</code> referencia a classe onde o código foi escrito. <code>static::</code> referencia a classe que foi chamada em tempo de execução (útil em herança). <code>parent::</code> acessa a classe pai.</p>

<h2>9. Interface vs classe abstrata</h2>
<table>
    <thead><tr><th></th><th>Interface</th><th>Classe abstrata</th></tr></thead>
    <tbody>
        <tr><td>Implementação de métodos</td><td>Não (só assinatura)</td><td>Sim (pode ter métodos concretos)</td></tr>
        <tr><td>Atributos</td><td>Apenas constantes</td><td>Sim</td></tr>
        <tr><td>Herança múltipla</td><td>Uma classe implementa várias</td><td>Só uma classe pai</td></tr>
        <tr><td>Instanciar diretamente</td><td>Não</td><td>Não</td></tr>
        <tr><td>Uso típico</td><td>Contrato entre partes independentes</td><td>Base comum com lógica compartilhada</td></tr>
    </tbody>
</table>

<h2>10. Traits</h2>
<p>Permitem reutilizar métodos em classes sem herança. Uma classe pode usar vários traits; um trait não pode ser instanciado.</p>
<pre>trait Logavel
{
    public function log(string $msg): void
    {
        echo "[LOG] $msg\n";
    }
}

trait Auditavel
{
    public function auditoria(): string
    {
        return 'auditado em ' . date('Y-m-d');
    }
}

class Pedido
{
    use Logavel, Auditavel;
}

$p = new Pedido();
$p->log('pedido criado');
echo $p->auditoria();</pre>
<pre class="resultado"><?php
trait Logavel
{
    public function log(string $msg): void
    {
        echo "[LOG] $msg\n";
    }
}

trait Auditavel
{
    public function auditoria(): string
    {
        return 'auditado em ' . date('Y-m-d');
    }
}

class Pedido
{
    use Logavel, Auditavel;
}

$p = new Pedido();
$p->log('pedido criado');
echo $p->auditoria();
?></pre>

<h2>11. Constantes de classe</h2>
<p>Definidas com <code>const</code> dentro da classe. Pertencem à classe (não ao objeto) e não podem ser alteradas.</p>
<pre>class Status
{
    const ATIVO   = 'ativo';
    const INATIVO = 'inativo';
}

echo Status::ATIVO;</pre>
<pre class="resultado"><?php
class Status
{
    const ATIVO   = 'ativo';
    const INATIVO = 'inativo';
}

echo Status::ATIVO;
?></pre>

<h2>12. Constructor promotion</h2>
<p>Atalho disponível desde PHP 8.0: declarar e atribuir atributos diretamente nos parâmetros do construtor, eliminando código repetitivo.</p>
<pre>// sem promotion
class Usuario
{
    public string $nome;
    public string $email;

    public function __construct(string $nome, string $email)
    {
        $this->nome  = $nome;
        $this->email = $email;
    }
}

// com promotion — equivalente ao acima
class Usuario
{
    public function __construct(
        public string $nome,
        public string $email,
    ) {}
}

$u = new Usuario('Ana', 'ana@exemplo.com');
echo $u->nome;</pre>
<pre class="resultado"><?php
class UsuarioPromovido
{
    public function __construct(
        public string $nome,
        public string $email,
    ) {}
}

$u = new UsuarioPromovido('Ana', 'ana@exemplo.com');
echo $u->nome;
?></pre>

<h2>13. Propriedades <code>readonly</code></h2>
<p>Disponível desde PHP 8.1. Podem ser escritas apenas uma vez (no construtor). Tentativa de reatribuição lança erro.</p>
<pre>class Coordenada
{
    public function __construct(
        public readonly float $lat,
        public readonly float $lng,
    ) {}
}

$c = new Coordenada(-23.5, -46.6);
echo $c->lat;
// $c->lat = 0; // Error: Cannot modify readonly property</pre>
<pre class="resultado"><?php
class Coordenada
{
    public function __construct(
        public readonly float $lat,
        public readonly float $lng,
    ) {}
}

$c = new Coordenada(-23.5, -46.6);
echo $c->lat;
?></pre>

<h2>14. Clonagem de objetos</h2>
<p>Objetos são passados por referência. Para criar uma cópia independente use <code>clone</code>. O método mágico <code>__clone()</code> é chamado automaticamente após a clonagem.</p>
<pre>class Caixa
{
    public function __construct(public string $cor) {}
}

$original = new Caixa('azul');
$copia    = clone $original;

$copia->cor = 'vermelho';

echo $original->cor . "\n"; // azul
echo $copia->cor;           // vermelho</pre>
<pre class="resultado"><?php
class Caixa
{
    public function __construct(public string $cor) {}
}

$original = new Caixa('azul');
$copia    = clone $original;

$copia->cor = 'vermelho';

echo $original->cor . "\n";
echo $copia->cor;
?></pre>

<h2>15. Namespaces</h2>
<p>Organizam classes em espaços de nomes para evitar colisões entre classes com o mesmo nome em projetos grandes.</p>
<pre>namespace App\Modelos;

class Usuario
{
    public function __construct(public string $nome) {}
}

// Em outro arquivo:
use App\Modelos\Usuario;

$u = new Usuario('Carlos');
echo $u->nome;</pre>
<p class="aviso">Namespaces exigem que cada arquivo seja incluído separadamente (via autoload ou <code>require</code>). O exemplo acima não executa em linha pois envolve múltiplos arquivos.</p>

<h2>Referência rápida</h2>
<table>
    <thead><tr><th>Conceito</th><th>Sintaxe</th></tr></thead>
    <tbody>
        <tr><td>Definir classe</td><td><code>class Nome { }</code></td></tr>
        <tr><td>Instanciar</td><td><code>$obj = new Nome()</code></td></tr>
        <tr><td>Acessar membro</td><td><code>$obj->metodo()</code></td></tr>
        <tr><td>Membro estático</td><td><code>Nome::metodo()</code></td></tr>
        <tr><td>Herança</td><td><code>class Filho extends Pai { }</code></td></tr>
        <tr><td>Interface</td><td><code>class X implements Y { }</code></td></tr>
        <tr><td>Classe abstrata</td><td><code>abstract class X { }</code></td></tr>
        <tr><td>Referência à própria classe</td><td><code>self::</code></td></tr>
        <tr><td>Referência ao pai</td><td><code>parent::</code></td></tr>
        <tr><td>Referência ao objeto atual</td><td><code>$this-></code></td></tr>
    </tbody>
</table>
</body>
</html>
