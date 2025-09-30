<?php

session_start();
if(!isset($_SESSION['roles']))
    die('Вы не залогинены');

$roles = $_SESSION['roles'];

if(!array_any($roles,fn($role)=>$role>=RoleId::MODERATOR))
    die("Недостаточно прав");
?>

<h1>Задача удалена!</h1>