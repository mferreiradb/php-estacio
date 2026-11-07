<?php

declare(strict_types=1);

session_start();

require __DIR__ . '/scripts/db.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E-mail inválido.';
    } elseif (strlen($senha) < 6) {
        $erro = 'Senha deve ter ao menos 6 caracteres.';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = :email');
        $stmt->execute([':email' => $email]);

        if ($stmt->fetch()) {
            $erro = 'E-mail já cadastrado.';
        } else {
            $hash = password_hash($senha, PASSWORD_BCRYPT);
            $ins  = $pdo->prepare('INSERT INTO usuarios (email, senha) VALUES (:email, :senha)');
            $ins->execute([':email' => $email, ':senha' => $hash]);

            $_SESSION['usuario_id']    = (int) $pdo->lastInsertId();
            $_SESSION['usuario_email'] = $email;

            header('Location: painel.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro</title>
<style>
  body { font-family: Arial, sans-serif; max-width: 400px; margin: 60px auto; padding: 0 16px; color: #222; }
  h1   { text-align: center; }
  label { display: block; margin-top: 12px; font-weight: bold; }
  input[type=email], input[type=password] {
    width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box;
    border: 1px solid #ccc; border-radius: 4px;
  }
  button { margin-top: 20px; width: 100%; padding: 10px; background: #4a6fa5; color: #fff;
    border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
  button:hover { background: #3a5a8a; }
  .erro { color: #c00; margin-top: 12px; }
  .link { text-align: center; margin-top: 16px; }
</style>
</head>
<body>
  <h1>Cadastro</h1>
  <?php if ($erro): ?><p class="erro"><?= htmlspecialchars($erro) ?></p><?php endif ?>
  <form method="post">
    <label>E-mail</label>
    <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    <label>Senha</label>
    <input type="password" name="senha" required minlength="6">
    <button type="submit">Criar conta</button>
  </form>
  <p class="link">Já tem conta? <a href="signin.php">Entrar</a></p>
</body>
</html>
