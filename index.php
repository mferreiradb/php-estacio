<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PHP Estácio — Índice</title>
<style>
  *, *::before, *::after { box-sizing: border-box; }
  body {
    font-family: Arial, sans-serif;
    max-width: 760px;
    margin: 48px auto;
    padding: 0 20px;
    color: #222;
    background: #f9f9f9;
  }
  h1 { text-align: center; margin-bottom: 8px; }
  p.sub { text-align: center; color: #666; margin-top: 0; margin-bottom: 32px; }
  h2 {
    margin-top: 36px;
    border-bottom: 2px solid #4a6fa5;
    padding-bottom: 4px;
    color: #4a6fa5;
  }
  ul { list-style: none; padding: 0; margin: 0; }
  li { margin: 6px 0; }
  a {
    text-decoration: none;
    color: #2a4f85;
    padding: 6px 10px;
    border-radius: 4px;
    display: inline-block;
    transition: background .15s;
  }
  a:hover { background: #e3ebf7; }
  .badge {
    font-size: .72rem;
    padding: 2px 7px;
    border-radius: 10px;
    margin-left: 6px;
    vertical-align: middle;
  }
  .php  { background: #d9e8ff; color: #1a3a6e; }
  .md   { background: #e8f5e9; color: #1b5e20; }
  .util { background: #fff3cd; color: #664d03; }
  .sub-group { margin-left: 20px; }
</style>
</head>
<body>

<h1>PHP Estácio</h1>
<p class="sub">Índice de aulas e exemplos</p>

<h2>Aulas — fundamentos</h2>
<ul>
  <li><a href="aulas/sintaxe.php">sintaxe.php</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/operadores.php">operadores.php</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/condicionais-repeticao.php">condicionais-repeticao.php</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/funcoes.php">funcoes.php</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/dados.php">dados.php</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/excecoes.php">excecoes.php</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/conexoes.php">conexoes.php</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/poo.php">poo.php</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/02-constantes.md">02-constantes.md</a> <span class="badge md">MD</span></li>
</ul>

<h2>Aulas — formulário</h2>
<ul>
  <li><a href="aulas/formulario/index.php">index.php — formulário simples</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/formulario/ajax.php">ajax.php — formulário AJAX</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/formulario/welcome.php">welcome.php — resposta</a> <span class="badge php">PHP</span></li>
  <li style="color:#888; padding: 6px 10px; font-size:.9rem;">
    scripts/processa.php — endpoint JSON (não acessar diretamente)
    <span class="badge util">util</span>
  </li>
</ul>

<h2>Aulas — banco de dados</h2>
<ul>
  <li><a href="aulas/db/01-introducao-sgbd-e-php.md">01-introducao-sgbd-e-php.md</a> <span class="badge md">MD</span></li>
  <li><a href="aulas/db/signup.php">signup.php — cadastro</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/db/signin.php">signin.php — login</a> <span class="badge php">PHP</span></li>
  <li><a href="aulas/db/painel.php">painel.php — área restrita</a> <span class="badge php">PHP</span></li>
  <li style="color:#888; padding: 6px 10px; font-size:.9rem;">
    scripts/db.php, scripts/setup.php, scripts/logout.php — utilitários (não acessar diretamente)
    <span class="badge util">util</span>
  </li>
</ul>

<h2>Exemplos — PHP e banco de dados</h2>
<ul>
  <li><a href="php-banco-de-dados/01-conexao/conexao.php">01 — conexao.php</a> <span class="badge php">PHP</span></li>
  <li><a href="php-banco-de-dados/02-crud/crud.php">02 — crud.php</a> <span class="badge php">PHP</span></li>
  <li><a href="php-banco-de-dados/03-prepared-statements/prepared.php">03 — prepared.php</a> <span class="badge php">PHP</span></li>
  <li><a href="php-banco-de-dados/03-prepared-statements/injection.php">03 — injection.php</a> <span class="badge php">PHP</span></li>
  <li><a href="php-banco-de-dados/04-fetch-modes/fetch.php">04 — fetch.php</a> <span class="badge php">PHP</span></li>
  <li><a href="php-banco-de-dados/05-transacoes/transacao.php">05 — transacao.php</a> <span class="badge php">PHP</span></li>
  <li><a href="php-banco-de-dados/06-tratamento-de-erros/erros.php">06 — erros.php</a> <span class="badge php">PHP</span></li>
</ul>

</body>
</html>
