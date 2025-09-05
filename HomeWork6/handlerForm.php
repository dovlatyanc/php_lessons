<?php

// Подключаем классы
require_once 'Database.php';
require_once 'User.php';

// Инициализация
$db = new Database();
$db->initDatabase();
$db->addTestUsers();

// Получаем всех пользователей
$usersData = $db->getAllUsers();
$users = [];

foreach ($usersData as $userData) {
    $users[] = new User(
        $userData['id'],
        $userData['first_name'],
        $userData['last_name'],
        $userData['email'],
        $userData['password']
    );
}

// Обработка формы логина
$loginMessage = '';
$loginMessageType = ''; // 'success' или 'error'

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $loginMessage = 'Пожалуйста, заполните все поля!';
        $loginMessageType = 'error';
    } else {
        $userData = $db->findUserByEmail($email);
        if ($userData) {
            $user = new User(
                $userData['id'],
                $userData['first_name'],
                $userData['last_name'],
                $userData['email'],
                $userData['password']
            );

            if ($user->checkPassword($password)) {
                $loginMessage = "Добро пожаловать, {$user->getFullName()}!";
                $loginMessageType = 'success';
            } else {
                $loginMessage = 'Неверный логин или пароль!';
                $loginMessageType = 'error';
            }
        } else {
            $loginMessage = 'Неверный логин или пароль!';
            $loginMessageType = 'error';
        }
    }
}

// Закрываем соединение
$db->close();
?>
