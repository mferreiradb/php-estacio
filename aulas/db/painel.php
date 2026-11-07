<?php

declare(strict_types=1);

session_start();

if (empty($_SESSION['usuario_id'])) {
    header('Location: signin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel</title>
<style>
  body { font-family: Arial, sans-serif; max-width: 400px; margin: 60px auto; padding: 0 16px; color: #222; text-align: center; }
  a { color: #c00; }
</style>
</head>
<body>
  <h1>Bem-vindo!</h1>
  <p>Logado como <strong><?= htmlspecialchars($_SESSION['usuario_email']) ?></strong></p>
  <p><a href="scripts/logout.php">Sair</a></p>
</body>
</html>
