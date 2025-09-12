<?php

require_once 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['taskId'] ?? null;
    if (!$id) {
        die('Некорректный ID задачи.');
    }
    $csrfToken = generateCsrfToken();
    ?>
    
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Подтверждение удаления</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <h1>Удалить задачу?</h1>
        <div class="confirm-box">
            <p>Вы уверены, что хотите удалить эту задачу? Это действие нельзя отменить.</p>
            <form method="post" action="delete.php">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>" />
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>" />
                <input type="submit" value="Удалить навсегда" />
                <a href="index.php">Отмена</a>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

//(реальное удаление)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //  ПРОВЕРКА CSRF
    if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
        die('Ошибка безопасности: неверный CSRF-токен.');
    }

    $id = $_POST['id'] ?? null;
    if (!$id) {
        die('Некорректный ID задачи.');
    }

    $pdo = getPDO();
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
    $stmt->execute([$id]);

    header('Location: index.php');
    exit;
}