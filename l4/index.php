<?php
session_start(); // Всегда начинаем сессию в начале файла
include_once ("./pages/functions.php"); // Подключаем функции

// Обработка формы входа
if (isset($_POST['page']) && $_POST['page'] == 'login') {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        
        // Вызываем функцию login
        login($login, $password);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>My site</title>
</head>
<body>
    <div class = "container">
        <div class="row">
            <header class = "col-sm-12 col-md-12 col-lg-12">
                <!-- Форма входа -->
                <div class="login-form" style="float: right; margin: 10px;">
                    <?php if (!isset($_SESSION['registered_user'])): ?>
                    <form action="index.php" method="post">
                        <input type="hidden" name="page" value="login">
                        <div style="display: inline-block; margin-right: 5px;">
                            <input type="text" name="login" placeholder="Логин" required size="10">
                        </div>
                        <div style="display: inline-block; margin-right: 5px;">
                            <input type="password" name="password" placeholder="Пароль" required size="10">
                        </div>
                        <div style="display: inline-block;">
                            <input type="submit" value="Войти" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                    <?php else: ?>
                    <div style="display: inline-block;">
                        <span>Привет, <?php echo $_SESSION['registered_user']; ?>!</span>
                        <form action="logout.php" method="post" style="display: inline-block; margin-left: 10px;">
                            <input type="submit" value="Выйти" class="btn btn-secondary btn-sm">
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
                <div style="clear: both;"></div>
            </header>
        </div>
        <div class="row">
            <nav class="col-sm-12 col-md-12 col-lg-12">
                <?php include_once ("./pages/menu.php"); ?>
            </nav>
        </div>
        <div class="row">
            <section class="col-sm-12 col-md-12 col-lg-12">
                <?php
                // Показываем сообщения об ошибках/успехе
                showAuthMessages();
                
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page == 1)
                        include_once ('./pages/home.php');
                    else if ($page == 2)
                        include_once ('./pages/upload.php');
                    else if ($page == 3)
                        include_once ('./pages/gallery.php');
                    else if ($page == 4)
                        include_once ('./pages/registration.php');
                } else {
                    include_once ('./pages/home.php'); // Страница по умолчанию
                }
                ?>
            </section>
        </div>
    </div>

    <script src="./js/bootstrap.min.js"></script>
</body>
</html>