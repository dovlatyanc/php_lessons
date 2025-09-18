<?php
session_start(); 
require_once "config.php";

function getPDO(): PDO {
    return new PDO(
        'mysql:host=' . Config::HOST . '; dbname=' . Config::NAME . ';charset=utf8mb4',
        Config::USER,
        Config::PASSWORD,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
}

// Функция генерации CSRF-токена
function generateCsrfToken(): string {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Функция проверки CSRF-токена
function validateCsrfToken(string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}