<?php

require_once 'database.php';

$db = new Database();
$db->initDatabase();
$db->addTestUsers();
$db->close();

echo "База данных успешно инициализирована! Добавлены тестовые пользователи.";
?>