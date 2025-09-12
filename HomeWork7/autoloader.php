<?php

spl_autoload_register(function ($className) {

    // HomeWork7\User → ./User.php
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';// стр_реплейс - заменяет обьратные слеши на прямые
    
    if (file_exists($fileName)) {
        require_once $fileName;
    }
});