<?php

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
    die('Ошибка безопасности: неверный CSRF-токен.');
}

//Получение данных из формы
$id = $_POST['id'] ?? null;
$name = trim($_POST['name'] ?? '');
$due = $_POST['due'] ?? '';
$priority = (int)($_POST['prioryty'] ?? 1);
$description = trim($_POST['description'] ?? '');


if (!$id || !$name || $priority < 1 || $priority > 5) {
    die('Некорректные данные.');
}

$pdo = getPDO();

$stmt = $pdo->prepare('UPDATE tasks SET name = ?, due = ?, prioryty = ?, description = ? WHERE id = ?');

$stmt->execute([$name, $due, $priority, $description, $id]);//безопасное заполнение

header('Location: index.php');//После успешного обновления возвращает на главную страницу
exit;