<?php
require_once '../../src/db.php';
require_once '../../src/role_id.php';


// Проверка авторизации
if (!isset($_SESSION['userId'])) {
    header('Location: login.php', true, 302);
    exit;
}

// Проверка прав
$isAdmin = in_array(RoleId::ADMIN, $_SESSION['roles'] ?? []);
if (!$isAdmin) {
    die('Доступ запрещён. Требуются права администратора.');
}

$pdo = getPDO();

// Обработка POST-запроса (сохранение изменений)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
        die('Ошибка безопасности: неверный CSRF-токен.');
    }

    $updates = $_POST['urgency'] ?? [];
    foreach ($updates as $id => $data) {
        $id = (int)$id;
        $name = trim($data['name'] ?? '');
        $color = trim($data['color'] ?? '');

        // Валидация
        if ($id <= 0 || empty($name) || !preg_match('/^[a-z_-]+$/', $color)) {
            die("Некорректные данные для уровня срочности ID=$id");
        }

        $stmt = $pdo->prepare('UPDATE urgency SET name = ?, color = ? WHERE id = ?');
        $stmt->execute([$name, $color, $id]);
    }

    header('Location: manage_urgency.php?success=1');
    exit;
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление списком</title>
    <link rel="stylesheet" href="../css/index.css"/>
</head>
<body>
    <h1>Админка</h1>
     <h2>Все задачи</h2>

        <?php 
            
            require_once '../../src/Task.php';

            $stmt = $pdo->query("
                            SELECT 
                                t.id,
                                t.name,
                                t.due,
                                t.description,
                                t.urgencyId,          -- ← ДОБАВЛЕНО
                                u.name AS urgency_name,
                                u.color AS urgency_css
                            FROM tasks t
                            LEFT JOIN urgency u ON t.urgencyId = u.id"
            );
            $stmt->setFetchMode (PDO::FETCH_CLASS, Task::class);
            $tasks = $stmt->fetchAll ();

            echo '<div class = "grid">';
               foreach ($tasks as $task) {
                    echo '<div><a href="showTask.php?taskId=' . htmlspecialchars($task->id) . '">' . htmlspecialchars($task->name) . '</a></div>';
                    echo '<div>' . htmlspecialchars($task->due) . '</div>';
                    echo '<div class="' . htmlspecialchars($task->urgency_css) . '">' . htmlspecialchars($task->urgency_name) . '</div>';
                    echo '<div>' . htmlspecialchars($task->description) . '</div>';
                    echo '<div><a href="edit.php?taskId=' . htmlspecialchars($task->id) . '">Редактировать</a></div>';
                    echo '<div><a onclick="return confirm(\'Точно удалить?\');" href="delete.php?taskId=' . htmlspecialchars($task->id) . '">Удалить</a></div>';
                }
            echo '</div>';
        ?>
        <h2> Добавить задачу</h2>
        <?php 
             require_once '../../src/form.php';
    
            $newTask = new Task(" "," ", ' ');
            showForm ($newTask, isNew: true);
        ?>

        

</body>
</html>