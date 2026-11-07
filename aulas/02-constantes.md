# Aula 02 — Constantes em PHP

## O que é uma constante

Um identificador (nome) para um valor simples que **não pode ser alterado nem desfeito** durante a execução do script.

- Ao contrário das variáveis, **não começa com `$`**.
- É **global por padrão**.
- Existem duas formas de definir: a função `define()` e a palavra-chave `const`.

## `define()` vs `const`

### `define()` (tempo de execução)

Define a constante quando o código chega naquela linha. Por isso pode ficar dentro de `if`, `switch` e loops.

```php
define("VERSAO_APP", "2.5.0");
define("PRODUCAO", true);

echo VERSAO_APP; // 2.5.0
```

### `const` (tempo de compilação)

Define a constante antes do código rodar. Não pode ficar dentro de `if`, `switch`, loops ou funções.

```php
const TAXA_SERVICO = 0.15;

echo TAXA_SERVICO; // 0.15
```

### Tabela comparativa

| Característica | `define()` | `const` |
|---|---|---|
| Dentro de classes | Não permitido | Permitido (e obrigatório) |
| Escopo global | Permitido | Permitido |
| Dentro de `if` | Sim (dinâmico) | Não (estático) |
| Tipos aceitos | Escalares e arrays (a partir do PHP 7) | Escalares e arrays |

## `const` só se usa em classes?

**Não.** O `const` também funciona no escopo global (fora de qualquer classe).

- Dentro de uma classe, é **obrigatório** usar `const`; o `define()` não declara constante de classe.
- No escopo global, pode-se escolher livremente entre `const` e `define()`.
- Antes do PHP 5.3, o `const` só era permitido dentro de classes. Daí vem a confusão. No PHP 7 e 8 funciona globalmente.

### `const` no escopo global

```php
<?php
const URL_SITE = "https://meusite.com";
const CONFIG_PADRAO = ['debug' => true, 'idioma' => 'pt-br'];

echo URL_SITE; // https://meusite.com
```

### `const` dentro de uma classe

Acessada com o operador `::` (ver [funcoes.php](funcoes.php), Parte 3).

```php
<?php
class BancoDeDados {
    public const PORTA = 3306;
}

echo BancoDeDados::PORTA; // 3306
```

### Restrição do `const` global

Não pode ficar dentro de blocos de decisão. Se a constante depende de uma condição, use `define()`.

```php
// ERRO DE SINTAXE
if ($ambiente == 'producao') {
    const URL = "https://producao.com";
}

// FUNCIONA
if ($ambiente == 'producao') {
    define("URL", "https://producao.com");
}
```

## Diferença no escopo global: `const` vs `define()`

A diferença vem de **quando o PHP processa** cada um: `const` na compilação (antes do código rodar), `define()` na execução.

### 1. Dinamismo e estruturas de controle

```php
// define: funciona (execução)
if ($usuario_logado) {
    define("NIVEL_ACESSO", "Admin");
}

// const: erro de sintaxe (compilação)
if ($usuario_logado) {
    const NIVEL_ACESSO = "Admin";
}
```

### 2. Nome dinâmico

Com `define()` o nome pode ser montado com variáveis ou funções. Com `const`, o nome precisa ser um texto fixo.

```php
$sufixo = "_PRODUTO";

define("PRECO" . $sufixo, 59.90);
echo PRECO_PRODUTO; // 59.9

// ERRO DE SINTAXE
const "PRECO" . $sufixo = 59.90;
```

### 3. Valores vindos de funções

`define()` aceita o retorno de qualquer função. `const` só aceita valores conhecidos antes do código rodar (números, strings, arrays estáticos, operações simples).

```php
define("DATA_ACESSO", date("Y-m-d"));  // funciona

const DATA_ACESSO = date("Y-m-d");     // ERRO: date() não é conhecido na compilação
```

### Resumo prático

| Use | Quando |
|---|---|
| `const` | Constantes de configuração estáticas que não mudam (`const VERSAO = '1.0';`). Visualmente mais limpo e um pouco mais rápido. |
| `define()` | O nome ou o valor depende de `if`, de uma variável ou do resultado de uma função. |

## Regras importantes

- **Sem `$`**: nunca se usa `$` para declarar ou chamar (`echo API_KEY;`).
- **Convenção de nome**: MAIÚSCULAS com sublinhados (`SNAKE_CASE`).
- **Imutabilidade**: depois de definida, tentar alterar o valor gera erro.
- **Escopo global**: acessível de qualquer lugar, inclusive dentro de funções e classes, sem a palavra-chave `global`.

## Constantes mágicas

Constantes pré-definidas cujo valor muda conforme o ponto do código onde são escritas. Começam e terminam com dois sublinhados (`__`).

| Constante | Retorna |
|---|---|
| `__LINE__` | Número da linha atual do script |
| `__FILE__` | Caminho completo e nome do arquivo atual |
| `__DIR__` | Diretório do arquivo atual |
| `__FUNCTION__` | Nome da função onde foi escrita |
| `__CLASS__` | Nome da classe atual |

> Nota: o PHP tem outras, como `__METHOD__` e `__NAMESPACE__`, que não foram citadas na aula. O `conexao.php` do estudo de PDO usa `__DIR__` para montar o caminho do banco SQLite.
