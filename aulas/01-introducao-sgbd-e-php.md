# Aula 01 — Introdução: PHP e Bancos de Dados

## Por que usar banco de dados

Aplicações precisam armazenar dados: sistemas da faculdade, redes sociais, bankline etc.

Fluxo típico de um login (ex.: bankline):

1. O usuário informa login e senha.
2. As credenciais são enviadas ao servidor que hospeda a aplicação.
3. O servidor valida as credenciais.
4. Se corretas, o servidor interage com o banco de dados.
5. O servidor envia a página de resposta com os dados do cliente.

O PHP é usado para desenvolver essas aplicações e, entre outras tarefas, permite interagir com bancos de dados.

Bancos de dados guardam desde dados simples (posts de um blog) até dados sensíveis (bancários e financeiros). O PHP tem amplo suporte a bancos relacionais e não relacionais, em vários SGBDs: **SQL Server, Oracle, MySQL e PostgreSQL**. Os dois últimos são os mais associados ao PHP.

## SGBDs (Sistemas Gerenciadores de Banco de Dados)

### MySQL

- Criado em 1995.
- Inicialmente código aberto; depois adquirido pela Oracle, que mantém uma versão GPL e uma comercial.
- Um dos SGBDs mais usados na web, normalmente associado ao PHP pela facilidade de conexão.
- Em PHP, a extensão `mysql` (mesmo nome do SGBD) oferece funções para conectar e executar SQL.

### PostgreSQL

- Código aberto, licença BSD, criado em 1996.
- O MySQL é puramente **relacional**; o PostgreSQL é **objeto-relacional**.
  - Na prática: herança de tabelas e sobreposição de funções.
- Adere de forma mais próxima aos padrões SQL.
- Em PHP, a extensão `pgsql` oferece funções para conectar e executar SQL.

### Comparação

| | MySQL | PostgreSQL |
|---|---|---|
| Criação | 1995 | 1996 |
| Licença | GPL + comercial (Oracle) | BSD |
| Modelo | Relacional | Objeto-relacional |
| Padrões SQL | — | Adere mais de perto |
| Extensão PHP | `mysql` | `pgsql` |
| Funções de exemplo | `mysql_connect`, `mysql_query` | `pg_connect`, `pg_query` |

> Nota: as funções `mysql_*` citadas na aula foram removidas no PHP 7. Por isso o estudo usa a classe **PDO**, que funciona com vários SGBDs trocando apenas o DSN.

## Conceitos básicos de PHP (revisão)

PHP é uma linguagem **server side**: roda no servidor web (Apache, Nginx, IIS). É uma linguagem de script, gratuita e muito usada na web.

Sintaxe: o código PHP pode ser misturado com HTML ou ficar sozinho no script. Ele fica entre a tag inicial `<?php` e a final `?>`. A tag final não é obrigatória quando o script tem só código PHP.

### Constantes

- Identificadores com valor **único e imutável**.
- Declaradas com `define("NOME", valor)`.
- Nos exemplos da aula, guardam as credenciais de acesso ao SGBD.

### Variáveis

- Espaços reservados na memória para armazenar e exibir dados que podem mudar durante a execução.
- Começam com `$` e são **case-sensitive**: `$var` é diferente de `$Var`.
- Declaração e atribuição podem acontecer juntas (ex.: `$stringConn`).
- **Não têm tipo declarado**: não é preciso indicar o tipo do dado.

### Estruturas de decisão e repetição

- Repetição: `while` (usado nos exemplos), `do-while`, `for`, `foreach`.
- Decisão: `if`, `else`, `elseif`, `switch`.

### Arrays

- Variáveis que guardam uma lista de itens, compostas por pares **índice/valor**.
- Tipos:
  - **associativo**: índices são strings. `$row` nos exemplos tem como índices os nomes das colunas selecionadas.
  - **numérico**: índices são números.
  - **híbrido**: mistura índices associativos e numéricos.

### Funções

- Trechos de código que podem ser chamados de qualquer parte do programa para executar uma tarefa específica.
- Podem ser definidas pelo usuário ou nativas.
- Nos exemplos: `define`, `echo`, e as de conexão e manuseio de dados (`mysql_connect`, `pg_connect`, `mysql_query`, `pg_query`).

### Extensões, bibliotecas e classes

- **Extensões**: arquivos binários que contêm bibliotecas (`.dll` no Windows, `.so` em sistemas unix-like).
- **Bibliotecas**: conjunto de funções e/ou classes.
- **Classes**: no paradigma de orientação a objetos, conjunto de código com atributos e métodos.
- Os drivers dos SGBDs (MySQL, PostgreSQL) são extensões; quando habilitados, permitem usá-los com o PHP.
- Relação com este estudo: o `pdo_sqlite` é uma extensão que precisa estar habilitada no `php.ini`.
