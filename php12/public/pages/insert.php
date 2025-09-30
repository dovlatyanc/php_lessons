<?php

require_once '../../src/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}
if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
    die('Ошибка безопасности: неверный CSRF-токен.');
}

$name = trim($_POST['name'] ?? '');
$due = $_POST['due'] ?? '';
$urgencyId = (int)($_POST['urgencyId'] ?? 1);
$description = trim($_POST['description'] ?? '');

if (!$name || $urgencyId < 1 || $urgencyId > 3) {
    die('Некорректные данные.');
}

$pdo = getPDO();
$stmt = $pdo->prepare('INSERT INTO tasks (name, due, urgencyId, description) VALUES (?, ?, ?, ?)');
$stmt->execute([$name, $due, $urgencyId, $description]);

header('Location: manage_urgency.php');

exit;// ToDo убрать дублирование
