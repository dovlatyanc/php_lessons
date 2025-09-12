<?php
// Подключаем автозагрузчик — он сам подтянет все классы
require_once 'autoloader.php';

//массив всех типов
$userClasses = [
    GuestUser::class,
    RegisteredUser::class,
    AdminUser::class
];


$randomUserClass = $userClasses[array_rand($userClasses)];

$user = new $randomUserClass();