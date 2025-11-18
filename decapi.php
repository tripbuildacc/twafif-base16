<?php
header('Content-Type: application/json');

$text = isset($_GET['text']) ? $_GET['text'] : '';

function is_valid_hex($str) {
    return ctype_xdigit($str) && strlen($str) % 2 === 0;
}

if ($text === '' || !is_valid_hex($text)) {
    echo json_encode([
        "output" => "fail",
        "content" => [
            "real text" => $text,
            "issue" => "invalid base16"
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    exit;
}

$decoded = '';
for ($i = 0; $i < strlen($text); $i += 2) {
    $decoded .= chr(hexdec(substr($text, $i, 2)));
}

echo json_encode([
    "output" => "work",
    "content" => [
        "real text" => $text,
        "decode base16" => $decoded
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);