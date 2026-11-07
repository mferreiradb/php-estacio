# PHP + Bancos de Dados (PDO)

Pasta de estudo sobre integração do PHP com bancos de dados usando **apenas PDO**.

## Estrutura

| Pasta | Conteúdo |
|---|---|
| `sql/` | Scripts de criação de tabelas e dados de exemplo |
| `01-conexao/` | Conexão via PDO: DSN, opções e atributos |
| `02-crud/` | Create, Read, Update, Delete e `lastInsertId()` |
| `03-prepared-statements/` | `bindValue`, `bindParam`, parâmetros nomeados/posicionais e SQL Injection |
| `04-fetch-modes/` | `fetch`, `fetchAll`, `fetchColumn` e modos `FETCH_ASSOC`, `FETCH_OBJ`, `FETCH_CLASS` |
| `05-transacoes/` | `beginTransaction`, `commit`, `rollBack` |
| `06-tratamento-de-erros/` | `PDOException`, `errorInfo` e modos de erro |

## Como rodar

Os exemplos usam SQLite, então não precisa instalar servidor de banco. Habilite `pdo_sqlite` no `php.ini` se necessário. Rode a partir desta pasta:

```
php 01-conexao/conexao.php
php 02-crud/crud.php
php 03-prepared-statements/prepared.php
php 03-prepared-statements/injection.php
php 04-fetch-modes/fetch.php
php 05-transacoes/transacao.php
php 06-tratamento-de-erros/erros.php
```

Para usar MySQL, basta trocar o DSN em `01-conexao/conexao.php` (há um comentário com o exemplo); o restante do código PDO não muda.

## Checklist de estudo

- [ ] DSN e opções de conexão
- [ ] Prepared statements: `prepare`, `execute`, `bindValue`, `bindParam`
- [ ] Parâmetros nomeados vs. posicionais
- [ ] Modos de fetch
- [ ] `lastInsertId()` e `rowCount()`
- [ ] Tratamento de erros com exceções (`PDO::ERRMODE_EXCEPTION`)
- [ ] Transações
- [ ] Relacionamentos e JOINs
- [ ] Padrão Repository / DAO com PDO

## Anotações

- [Aula 01 — Introdução: PHP e bancos de dados](../aulas/01-introducao-sgbd-e-php.md)
- [Aula 02 — Constantes](../aulas/02-constantes.md)
