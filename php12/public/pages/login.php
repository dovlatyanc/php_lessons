
<?php 
if($_SERVER["REQUEST_METHOD"]==="POST"){

    $email = $_POST['email']??'';
    $password = $_POST['password']??'';


    require_once '../../src/db.php';

    $pdo = getPDO();
    $hash = password_hash($password,PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('select  * from users where email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user === false)
        die("Пользователь не найден");

    $hash =  $user['passwordHash'];

    if(!password_verify($password,$hash)){
        die('Неправильный пароль');
    }


    $stmt = $pdo->prepare('select roleId from user_roles where userId = ?');
    $stmt->execute([$user['ID']]);
    $roles =$stmt->fetchAll(PDO::FETCH_COLUMN);

    session_start();
    $_SESSION['userId'] = $user['ID'];
    $_SESSION['userEmail'] = $user['email'];
    
    $_SESSION['roles'] = $roles;
    header('Location:index.php',302);
    die();


}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аутентификация</title>
</head>
<body>
    <h1>Аутентификация</h1>

    <form action="login.php" method="post">
        <div>Email:*</div>
        <div>
            <input type="email" name="email" require>
        </div>
        <div>Пароль:*</div>
        <div>
            <input type="password" name="password">
        </div>
        
        <div>
            <input type="submit" value="Войти">
        </div>
    </form>
       
    
</body>
</html>