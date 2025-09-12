<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="index.css">

        <title>ToDolist</title>
    </head>
    <body>
        <h1>Все задачи</h1>

        <?php 
            require_once 'db.php';
            $pdo = getPDO();
            $stmt =$pdo->query('select *  from tasks');

            echo '<div class = "grid">';
            while($task = $stmt->fetch(PDO::FETCH_ASSOC)){

         
                echo "<div> {$task['name']}</div>";
                echo "<div> {$task['due']}</div>";
                echo "<div> {$task['prioryty']}</div>";
                echo "<div> {$task['description']}</div>";
                echo "<div> <a href =\"edit.php?taskId={$task['id']}\">Редактировать</a></div>";
                echo "<div> <a onClick=\" return confirm('Точно удалить?');\"
                 href =\"delete.php?taskId={$task['id']}\">Удалить</a></div>";
            }
            echo '</div>';
        ?>
        <h2> Добавить задачу</h2>
        <?php 
        require_once 'form.php';
        $newTask = ['name'=>'','due'=>'','prioryty'=>'','description'=>''];
        showForm($newTask, isNew:true);
        ?>
    </body>
</html>