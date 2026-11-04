# PHP

## Rodar o servidor

Na pasta do projeto, execute:

```powershell
php -S localhost:8000
```

Depois abra no navegador:

```
http://localhost:8000/operadores.php
```

Para parar o servidor, use `Ctrl+C` no terminal.

## Outras opções

Usar outra porta:

```powershell
php -S localhost:8080
```

Usar outra pasta como raiz:

```powershell
php -S localhost:8000 -t caminho\da\pasta
```

Verificar se o arquivo tem erro de sintaxe:

```powershell
php -l operadores.php
```
