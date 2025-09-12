<?php
require_once "randFiling.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./index.css">
        <title>HW7</title>
    </head>
    <body>
        <h1>Случайный пользователь:</h1>

        <div class="user-info">
             <div> 
                <?php echo $user;
                 ?>
            </div>  
        </div>
    </body>
</html>