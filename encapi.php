<?php
header('Content-Type: application/json');

// ambil text
$input = isset($_GET['text']) ? $_GET['text'] : '';

// jika kosong
if ($input === '') {
    echo json_encode([
        'output' => 'fail',
        'content' => [
            'issue' => 'no text provided'
        ]
    ], JSON_PRETTY_PRINT);
    exit;
}

// encode ke base16
$hex = '';
for ($i = 0; $i < strlen($input); $i++) {
    $hex .= strtoupper(bin2hex($input[$i]));
}

// sukses
$response = [
    'output' => 'work',
    'content' => [
        'real text' => $input,
        'encode base16' => $hex
    ]
];

echo json_encode($response, JSON_PRETTY_PRINT);