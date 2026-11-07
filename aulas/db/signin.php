<?php

declare(strict_types=1);

session_start();

require __DIR__ . '/scripts/db.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $consultaUsuario = $pdo->prepare('SELECT id, senha FROM usuarios WHERE email = :email');
    $consultaUsuario->execute([':email' => $email]);
    $usuario = $consultaUsuario->fetch();

    if (!$usuario || !password_verify($senha, $usuario['senha'])) {
        $erro = 'E-mail ou senha incorretos.';
    } else {
        session_regenerate_id(true);
        $_SESSION['usuario_id']    = (int) $usuario['id'];
        $_SESSION['usuario_email'] = $email;

        header('Location: painel.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Entrar</title>
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
  <h1>Entrar</h1>
  <?php if ($erro): ?><p class="erro"><?= htmlspecialchars($erro) ?></p><?php endif ?>
  <form method="post">
    <label>E-mail</label>
    <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    <label>Senha</label>
    <input type="password" name="senha" required>
    <button type="submit">Entrar</button>
  </form>
  <p class="link">Não tem conta? <a href="signup.php">Cadastrar</a></p>
</body>
</html>
