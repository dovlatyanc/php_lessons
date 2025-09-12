<?php
session_start(); 
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}
if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
    die('Ошибка безопасности: неверный CSRF-токен.');
}

$name = trim($_POST['name'] ?? '');
$due = $_POST['due'] ?? '';
$priority = (int)($_POST['prioryty'] ?? 1);
$description = trim($_POST['description'] ?? '');

if (!$name || $priority < 1 || $priority > 5) {
    die('Некорректные данные.');
}

$pdo = getPDO();
$stmt = $pdo->prepare('INSERT INTO tasks (name, due, prioryty, description) VALUES (?, ?, ?, ?)');
$stmt->execute([$name, $due, $priority, $description]);

header('Location: index.php');

exit;// ToDo убрать дублирование
