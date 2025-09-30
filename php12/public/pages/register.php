<?php
if($_SERVER["REQUEST_METHOD"]==="POST"){

    $email = $_POST['email']??'';
    $password1= $_POST['password1']??'';
    $password2 = $_POST['password2']??'';

    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        die("Неправильный Email");
    if($password1!=$password2)
        die("Пароли не совпадают!");
    if(strlen($password1<3))
        die("Пароль слишком короткий!");


    require_once '../src/db.php';

    $pdo = getPDO();
    $pdo->beginTransaction();

        $hash = password_hash($password1,PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('insert into users (email,passwordHash) values (?,?) ');
        $stmt->execute([$email,$hash]);


        $userId =$pdo->lastInsertId();

        $stmt=$pdo->prepare('insert into user_roles (userId,roleId) values (?,?) ');
        $stmt->execute([$userId,1]);
    $pdo->commit();
    header('Location:login.php',302);
    die();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

    <form action="register.php" method="post">
        <div>Email:*</div>
        <div>
            <input type="email" name="email" require>
        </div>
        <div>Пароль:*</div>
        <div>
            <input type="password" name="password1">
        </div>
        <div>Подтвердите пароль: *</div>
        <div>
            <input type="password" name="password2">
        </div>
        <div>
            <input type="submit" value="Зарегистрироваться">
        </div>
    </form>
       
    
</body>
</html>