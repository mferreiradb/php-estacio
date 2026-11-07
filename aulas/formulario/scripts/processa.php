<?php

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['erro' => 'Use o método POST.']);
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');

if ($nome === '' || $email === '') {
    http_response_code(400);
    echo json_encode(['erro' => 'Preencha nome e email.']);
    exit;
}

// Devolve só os dados (JSON), não uma página HTML inteira.
// O JavaScript exibe o texto com textContent, que já não interpreta HTML.
echo json_encode([
    'mensagem' => "Bem-vindo, $nome!",
    'email' => $email,
]);
