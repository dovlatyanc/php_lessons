<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Список задач</title>
        <link rel="stylesheet" href="index.css" />
    </head>
    <body>
        <h1>Все задачи</h1>
        <?php
            require_once 'config.php';
            require_once 'Task.php';

            $pdo = new PDO (
                'mysql:host=localhost;dbname=pv311;charset=utf8mb4', Config::USER, Config::PASSWORD, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            $stmt = $pdo->query ('select * from tasks');
            $stmt->setFetchMode (PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Task::class);
            $tasks = $stmt->fetchAll ();

            echo '<div class="grid">';
            foreach ($tasks as $task) {
                echo "<div><a href=\"showTask.php?taskId={$task->id}\">{$task->name}</a></div>";
                echo "<div>{$task->due}</div>";
                echo "<div>{$task->priority}</div>";
                echo "<div>{$task->description}</div>";
                echo "<div><a href=\"edit.php?taskId={$task->id}\">Редактировать</a></div>";
                echo "<div><a href=\"delete.php?taskId={$task->id}\"
                    onClick=\"return confirm('Точно удалить?');\">Удалить</a></div>";
            }
            echo '</div>';
        ?>
        <h2>Добавить задачу</h2>
        <?php
            require_once 'form.php';
            $newTask = new Task ();
            showForm ($newTask, isNew: true);
        ?>
    </body>
</html>
