# Funções de sessão e senha em PHP

Funções nativas do PHP — sem `require`, sem instalação.

## `session_start()`

Inicia ou retoma uma sessão HTTP.

- Cria o cookie `PHPSESSID` no navegador na primeira chamada.
- Nas chamadas seguintes, lê o cookie e carrega `$_SESSION` com os dados da sessão anterior.
- Deve ser chamada antes de qualquer saída HTML.

```php
session_start();
$_SESSION['usuario_id'] = 42;
```

`$_SESSION` é uma **superglobal** do PHP — um array associativo disponível em qualquer script da mesma sessão. Atribuir um valor a uma chave (`$_SESSION['usuario_id'] = 42`) salva esse dado no servidor vinculado ao ID de sessão do usuário. Em qualquer outra página que chame `session_start()`, esse valor pode ser lido:

```php
// em outra página
session_start();
echo $_SESSION['usuario_id']; // 42
```

Os dados persistem entre requisições enquanto a sessão estiver ativa. `session_destroy()` apaga todos os dados e invalida a sessão.

## `password_verify($senha, $hash)`

Compara uma senha em texto puro com um hash gerado por `password_hash()`. Retorna `bool`.

- Seguro contra *timing attacks*: o tempo de comparação é constante, independente do resultado.
- Não comparar senhas com `===` ou `==` — use sempre esta função.

```php
$hash = password_hash('minhasenha', PASSWORD_BCRYPT);

password_verify('minhasenha', $hash); // true
password_verify('outrasenha', $hash); // false
```

## `session_regenerate_id(true)`

Gera um novo ID de sessão mantendo os dados existentes em `$_SESSION`.

- O argumento `true` destrói a sessão antiga no servidor (evita sessões órfãs).
- Usado logo após o login para prevenir **session fixation**: ataque onde o invasor força um ID de sessão conhecido antes do login e, após a autenticação, usa esse ID para se passar pelo usuário.

```php
session_start();
// ... valida credenciais ...
session_regenerate_id(true); // novo ID, dados preservados
$_SESSION['usuario_id'] = $usuario['id'];
```

## `header('Location: ...')`

Envia um cabeçalho HTTP de redirecionamento ao navegador. O navegador recebe a instrução e navega para a URL indicada.

- Deve ser chamado **antes de qualquer saída HTML** (antes de `echo`, `?>`, espaços, etc.).
- Após `header()`, sempre use `exit` para encerrar o script — sem ele, o PHP continua executando o código abaixo mesmo que o navegador já esteja redirecionando.

```php
header('Location: painel.php'); // redireciona para painel.php
exit;                           // encerra o script imediatamente
```

O caminho pode ser relativo (mesmo diretório) ou absoluto (`https://...`). O status HTTP padrão enviado é `302 Found` (redirecionamento temporário).

O `exit` após `header()` é essencial: `header()` apenas **agenda** o cabeçalho — o PHP continua executando o restante do script normalmente. Sem o `exit`, o código abaixo do redirecionamento ainda roda, podendo expor dados ou executar lógica indevida.

```php
header('Location: painel.php');
// sem exit: o código abaixo executa mesmo assim
echo 'isso aparece no corpo da resposta';
fazerAlgoPerigoso();

// com exit: script para aqui
exit;
```
