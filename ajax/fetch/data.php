<?php

header('Content-Type: application/json; charset=utf-8');
//данные для страницы

echo json_encode([
    'title' => 'Статья которая  удачно пришла',
    'image' => "./public/img/i.webp",
    'text' => 'Данные пришли с PHP-скрипта! Cюда можно передать какойто текст!'
]);