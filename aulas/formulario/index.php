<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            margin: 0;
            padding: 40px 16px;
            color: #222;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-top: 0;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #4a6fa5;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #4a6fa5;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background: #3a5a88;
        }
    </style>
</head>
<body>
    <form action="welcome.php" method="post">
        <h1>Formulário</h1>

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Digite seu nome">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Digite seu email">

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
