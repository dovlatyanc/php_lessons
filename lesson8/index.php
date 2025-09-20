<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./index.css">
        <title>ToDolist</title>
    </head>
    <body>
        <h1>Все задачи</h1>

        <?php 
            require_once 'db.php';
            require_once 'Task.php';

            $pdo = getPDO();

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

                echo "<div><a href=\"showTask.php?taskId={$task->id}\">{$task->name}</a></div>";
                echo "<div> {$task->due}</div>";
                echo "<div class=\"{$task->urgency_css}\">{$task->urgency_name}</div>";
                echo "<div> {$task->description}</div>";
                echo "<div> <a href =\"edit.php?taskId={$task->id}\">Редактировать</a></div>";
                echo "<div> <a onClick=\" return confirm('Точно удалить?');\"
                 href =\"delete.php?taskId={$task->id}\">Удалить</a></div>";
            }
            echo '</div>';
        ?>
        <h2> Добавить задачу</h2>
        <?php 
             require_once 'form.php';
    
            $newTask = new Task(" "," ", ' ');
            showForm ($newTask, isNew: true);
        ?>
    </body>
</html>