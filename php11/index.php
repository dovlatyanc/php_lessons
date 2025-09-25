<?php

if (isset ($_GET['template'])) {  // если у нас попросили шаблон
    if ($_GET['template'] === 'profile') {
        ?>
        <h1>Привет, {{name}}!</h1>

        <img src="{{avatar}}" />
        <?php
        die ();
    }
    else {
        header ('X-PHP-HTTP-Status: 404', true, 404);
        die ();
    }
}
else if (isset ($_GET['get'])) {  // если у нас просят данные
    if ($_GET['get'] === 'user') {
        echo json_encode ([ 'id' => 1, 'name' => 'Ярослав', 'avatar' => 'img/photo.png' ]);
        die ();
    }
    else {
        header ('X-PHP-HTTP-Status: 404', true, 404);
        die ();
    }
}

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Соцсеть Аякс</title>
        <link rel="stylesheet" href="index.css" />
    </head>
    <body>
        <div id="profile">  <!-- Здесь будет профиль пользователя-->
            <div class="spinner">

            </div> <!-- крутилка, типа загружает -->
        </div>

        <h1>Посты друзей</h1>
        <div id="posts">  <!-- Здесь будут посты друзей -->
            <div class="spinner">

            </div>
        </div>
    </body>

    <script src="dynamicLoad.js"></script>
</html>
