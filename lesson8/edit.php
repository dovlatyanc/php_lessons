<?php
require_once 'db.php';
require_once 'form.php';

$id = $_GET['taskId'] ?? null;

if (!$id) {
    die('Некорректный ID задачи.');
}


if (!ctype_digit($id) || $id <= 0) {
    die('ID должен быть положительным целым числом.');
}

$pdo = getPDO();
$stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ?');
$stmt->execute([$id]);

$stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Task::class);

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