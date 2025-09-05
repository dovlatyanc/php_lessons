<?php
print_r($_POST);

if(!isset($_POST["login"]) || empty ($_POST["login"]))
    die('Введите имя пользователя');
if(!isset($_POST["password"]) || empty ($_POST["password"]))
    die('Введите пароль');

if($_POST["login"] == 'Вася' && $_POST["password"] == "123"){
    echo "Welcome Vasya";

}
else
    die("неверный логин или пароль");