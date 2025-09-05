<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css"/>
    <title>Система пользователей</title>
</head>
<body>
 
    <div class="user-list">
        <h2>Список пользователей:</h2>
        <?php if (empty($users)): ?>
            <p>Пользователи не найдены</p>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
                <div class="user-item"><?= $user ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="login-form">
        <form method="POST">
            <input type="hidden" name="login" value="1">
            <div>
                <label for="email">Email:</label>
                <input type="text"id="email" name="email" required
                       value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES) ?>">
            </div>

            <div>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <input type="submit" value="Войти">
        </form>

        <!-- Сообщение после входа -->
        <?php if (!empty($loginMessage)): ?>
            <div class="<?= $loginMessageType ?>">
                <?= htmlspecialchars($loginMessage, ENT_QUOTES) ?>
            </div>
        <?php endif; ?>
    </div>

     <div class="testdata">
        <h3>Тестовые данные для входа:</h3>
        <p><strong>Администратор:</strong> admin@example.com / admin123</p>
        <p><strong>Тестовый пользователь:</strong> test@example.com / test123</p>
    </div>

</body>
</html>