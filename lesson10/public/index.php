

<?php 

    use models\{User,Task};
    use controllers\UserController;
    use services\UserService;

    require_once "../src/models/User.php";
    require_once "../src/services/UserService.php";
    require_once "../src/controllers/UserController.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <img src="img/chamomile field.png" id="image" draggable="false" />
        <div>Поле с ромашками</div>
        <script src="js/move.js"></script>
    </body>
</html>
