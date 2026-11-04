# Observações

## Usar `htmlspecialchars` ao exibir dados do usuário

Ao imprimir na página um valor que veio de um formulário (`$_POST`, `$_GET`), use `htmlspecialchars()`.

Sem ele, o texto digitado é inserido no HTML como está. Se alguém digitar `<script>alert('oi')</script>` no campo nome, o navegador executa esse código. Essa falha se chama **XSS** (Cross-Site Scripting).

### Errado

```php
<p>Bem-vindo, <?php echo $_POST['nome']; ?>!</p>
```

### Certo

```php
<p>Bem-vindo, <?php echo htmlspecialchars($_POST['nome']); ?>!</p>
```

Ou, na forma curta:

```php
<p>Bem-vindo, <?= htmlspecialchars($_POST['nome']) ?>!</p>
```

### O que a função faz

Converte caracteres especiais do HTML em texto seguro:

| Caractere | Vira |
|---|---|
| `<` | `&lt;` |
| `>` | `&gt;` |
| `&` | `&amp;` |
| `"` | `&quot;` |

Assim o navegador mostra o texto digitado em vez de interpretá-lo como HTML.

### Onde aplicar

Em `aulas/formulario/welcome.php`, nas duas linhas que usam `$_POST['nome']` e `$_POST['email']`.

## Por que se chama AJAX

**AJAX** significa *Asynchronous JavaScript And XML* (JavaScript e XML assíncronos). O termo foi criado em 2005 e descreve a técnica de trocar dados com o servidor em segundo plano, sem recarregar a página.

### Cada parte do nome

- **Asynchronous (assíncrono):** o navegador envia a requisição e continua funcionando enquanto espera a resposta. A página não trava nem recarrega. No código, isso aparece no `async`/`await` do `fetch`.
- **JavaScript:** é a linguagem que faz o envio e trata a resposta. No `aulas/formulario/ajax.php`, é o bloco `<script>`.
- **XML:** era o formato usado na época para os dados que o servidor devolvia.

### O "X" hoje não bate

Hoje quase ninguém usa XML para isso. O formato mais comum é o **JSON**, usado no `aulas/formulario/processa.php` com `json_encode()`. O nome ficou por tradição, e hoje "AJAX" quer dizer só "enviar e receber dados sem recarregar a página", seja com JSON, texto ou HTML.

### Ferramentas

- `XMLHttpRequest` era a ferramenta antiga do navegador para fazer isso, e o "XML" do nome vem dela.
- `fetch` é a versão moderna e mais simples. Fazemos AJAX com `fetch`, mesmo sem usar XML.

### Por que importou

Antes do AJAX, qualquer interação com o servidor recarregava a página inteira. O AJAX permitiu coisas como o Gmail e o Google Maps atualizarem partes da tela sozinhas.
