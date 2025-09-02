<?php
// Определяем путь к файлу с пользователями
$users = "./data/users.txt"; // Изменил путь на ./data/users.txt

function register($name, $pass, $email)
{
    // Очищаем данные
    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));

    // Проверяем заполненность полей
    if($name == '' || $pass == '' || $email == '')
    {
        echo "<h3><span style = 'color:red;'>Fill all required fields</span></h3>"; 
        return false;
    }
    // Проверяем длину имени и пароля
    else if (strlen($name) < 3 || strlen($name) > 30 || strlen($pass) < 3 || strlen($pass) > 30)
    {
        echo "<h3><span style = 'color:red;'>Name and password must be from 3 to 30 symbols</span></h3>";
        return false; 
    }

    global $users;

    // Создаем папку data если ее нет
    if (!file_exists('./data')) {
        mkdir('./data', 0777, true);
    }

    // Проверяем существование пользователя
    if (file_exists($users)) {
        $file = fopen($users, 'r');
        while($line = fgets($file, 128))
        {
            $readname = substr($line, 0, strpos($line, ':'));
            if ($readname == $name)
            {
                echo "<h3><span style = 'color:red;'>Such login already exists</span></h3>"; 
                fclose($file);
                return false;
            }        
        }
        fclose($file);
    }

    // Добавляем нового пользователя
    $file = fopen($users, 'a+');
    $line = $name. ':'.md5($pass).':'.$email."\r\n"; // Исправил \r\n на правильные кавычки
    fputs($file, $line);
    fclose($file);
    
    // Автоматически логиним пользователя после регистрации
    $_SESSION['registered_user'] = $name;
    
    return true;
}

function login($name, $password) {
    // Проверяем, что переданы не пустые значения
    if (empty($name) || empty($password)) {
        echo '<script>window.location = "index.php?page=4&error=empty";</script>';
        exit();
    }
    
    // Очищаем данные
    $name = trim(htmlspecialchars($name));
    
    // Хешируем пароль
    $hashed_password = md5($password);
    
    // Используем глобальную переменную с путем к файлу
    global $users;
    
    // Проверяем существование файла
    if (!file_exists($users)) {
        echo '<script>window.location = "index.php?page=4&error=nofile";</script>';
        exit();
    }
    
    // Читаем файл
    $file = fopen($users, 'r');
    $user_found = false;
    
    while (!feof($file)) {
        $line = fgets($file);
        if (trim($line) != '') {
            $user_data = explode(':', trim($line));
            
            // Проверяем, есть ли в строке достаточно данных
            if (count($user_data) >= 2) {
                $stored_name = trim($user_data[0]);
                $stored_password = trim($user_data[1]);
                
                // Сравниваем имя и хеш пароля
                if ($stored_name == $name && $stored_password == $hashed_password) {
                    $user_found = true;
                    break;
                }
            }
        }
    }
    
    fclose($file);
    
    if ($user_found) {
        // Пользователь найден - создаем сессию
        $_SESSION['registered_user'] = $name;
        echo '<script>window.location = "index.php?page=1&success=login";</script>';
        exit();
    } else {
        // Пользователь не найден
        echo '<script>window.location = "index.php?page=4&error=invalid";</script>';
        exit();
    }
}

// Функция для проверки авторизации
function checkAuth() {
    if (!isset($_SESSION['registered_user']) || empty($_SESSION['registered_user'])) {
        echo '<script>window.location = "index.php?page=4&error=notlogged";</script>';
        exit();
    }
}

// Функция для отображения сообщений об ошибках
function showAuthMessages() {
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger mt-3">';
        switch ($_GET['error']) {
            case 'empty': echo 'Please fill all fields!'; break;
            case 'nofile': echo 'Users database not found!'; break;
            case 'invalid': echo 'Invalid login or password!'; break;
            case 'notlogged': echo 'Please login first!'; break;
            default: echo 'Authentication error!';
        }
        echo '</div>';
    }
    
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success mt-3">';
        switch ($_GET['success']) {
            case 'login': echo 'Login successful!'; break;
            case 'register': echo 'Registration successful!'; break;
            default: echo 'Operation successful!';
        }
        echo '</div>';
    }
}
?>