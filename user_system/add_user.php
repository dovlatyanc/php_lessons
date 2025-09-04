<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить пользователя</title>
</head>
<body>
    <h2>Добавить нового пользователя</h2>
    <form method="POST" action="">
        <label>Имя: <input type="text" name="name" required></label><br><br>
        <label>Email: <input type="email" name="email" required></label><br><br>
        <button type="submit">Добавить</button>
    </form>

    <?php
    // Проверяем, была ли отправлена форма
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Получаем данные из формы
        $name = $_POST['name'];
        $email = $_POST['email'];

        // Подключаемся к базе данных
        $conn = new mysqli("localhost", "root", "", "user_db");

        // Проверяем соединение
        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        // Подготавливаем SQL-запрос для вставки данных
        $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

        // Выполняем запрос
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green;'>Пользователь успешно добавлен!</p>";
        } else {
            echo "<p style='color:red;'>Ошибка: " . $conn->error . "</p>";
        }

        // Закрываем соединение
        $conn->close();
    }
    ?>
</body>
</html>