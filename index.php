
<!-- require_once 'config.php';
session_start();
$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 require_once 'templates/index.php'; -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 500px; margin: auto; background: #f7f7f7; padding: 20px; border-radius: 10px; }
        input, button { padding: 10px; margin: 10px 0; width: 100%; }
        .result { background: #e0f7fa; padding: 10px; border-radius: 5px; }
    </style>
  <title>Document</title>
</head>
<body>
  <form action="tasks/task1.php" method="POST">
    <label>Температура в °F:</label>
    <input type="number" name="tf" placeholder="Например: 98.6" required>
    <button type="submit">Перевести °F в C°</button>
  </form>

    <form action="tasks/task2.php" method="POST">
    <label>Введите число:</label>
    <input type="number" name="num" placeholder="Например 123" required>
    <button type="submit">Узнать по порядку ли цифры?</button>
  </form>
   <form action="tasks/task3.php" method="POST">
    <label>Введите массив:</label>
    <input type="number" name="num" placeholder="Например 123456" required>
    <button type="submit">Продублировать цифры</button>
  </form>
     <form action="tasks/task4.php" method="POST">
    <label>Введите массив:</label>
    <input type="number" name="num" placeholder="Например 123456" required>
    <button type="submit">Узнать среднее арифметическое</button>
  </form>
     <form action="tasks/task5.php" method="POST">
    <label>Введите число</label>
    <input type="number" name="num" placeholder="Например 25" required>
    <button type="submit">Найти квадратый корень</button>
  </form>
</body>
</html>

