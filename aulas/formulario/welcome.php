

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
</head>
<body>
    <p>Bem-vindo, <?php echo htmlspecialchars($_POST['nome']); ?>!</p>
    <p>Email: <?php echo htmlspecialchars($_POST['email']); ?></p>
</body>
</html>