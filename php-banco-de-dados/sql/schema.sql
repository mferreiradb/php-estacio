CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    saldo REAL NOT NULL DEFAULT 0
);

INSERT OR IGNORE INTO usuarios (nome, email, saldo) VALUES
    ('Ana', 'ana@exemplo.com', 100),
    ('Bruno', 'bruno@exemplo.com', 50);
