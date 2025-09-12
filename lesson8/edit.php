<?php
require_once 'db.php';
require_once 'form.php';

$id = $_GET['taskId'] ?? null;// Получаем ID из URL-параметра

if (!$id) {
    die('Некорректный ID задачи.');
}

$pdo = getPDO();
$stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ?');
$stmt->execute([$id]);// Безопасное выполнение запроса
$task = $stmt->fetch();

if (!$task) {
    die('Задача не найдена.');
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создать/редактировать задачу</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Создать/редактировать задачу</h1>
    <a href="index.php">← Назад к списку</a>
    <?php showForm($task, false); ?>
</body>
</html>