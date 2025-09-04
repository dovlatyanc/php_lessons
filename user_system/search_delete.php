<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Поиск и удаление пользователя</title>
</head>
<body>
    <h2>Поиск пользователя</h2>
    <form method="GET" action="">
        <label>Имя или email: <input type="text" name="search"></label>
        <button type="submit">Найти</button>
    </form>

    <?php
    // Подключаемся к базе
    $conn = new mysqli("localhost", "root", "", "users_db");
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Удаление пользователя (если нажали "Удалить")
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql_delete = "DELETE FROM users WHERE id = $delete_id";
        if ($conn->query($sql_delete) === TRUE) {
            echo "<p style='color:green;'>Пользователь удалён!</p>";
        } else {
            echo "<p style='color:red;'>Ошибка при удалении: " . $conn->error . "</p>";
        }
    }

    // Поиск пользователя
    $search = "";
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        // Подготовка запроса с поиском по имени или email
        $sql = "SELECT * FROM users WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
    } else {
        // Если поиска нет — показать всех
        $sql = "SELECT * FROM users";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Дата добавления</th>
                    <th>Действие</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <a href='?delete_id={$row['id']}&search=$search' onclick='return confirm(\"Удалить этого пользователя?\")'>
                            Удалить
                        </a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color:gray;'>Пользователи не найдены.</p>";
    }

    $conn->close();
    ?>
</body>
</html>