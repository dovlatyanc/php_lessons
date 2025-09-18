<?php
require_once 'config.php';
require_once 'Task.php';

if (!isset ($_GET['taskId']))
    throw new Exception ('Требуется taskId');
$id = $_GET['taskId'];
// TODO: проверить, что taskID — число

$pdo = new PDO (
    'mysql:host=localhost;dbname=pv311;charset=utf8mb4', Config::USER, Config::PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
$stmt = $pdo->prepare ('select * from tasks where id = ?');
$stmt->execute ([$id]);
$stmt->setFetchMode (PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Task::class);

$task = $stmt->fetch ();
if ($task === false)
    throw new Exception ('Задача не найдена');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlentities ($task->name) ?></title>
    </head>
    <body>
        <h1><?= htmlentities ($task->name) ?></h1>

        <p><?= htmlentities ($task->description) ?></p>

        <a href="edit.php?taskId=<?= htmlentities ($task->id) ?>">Редактировать</a>
    </body>
</html>