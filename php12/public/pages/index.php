<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header('Location: pages/login.php', true, 302);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список задач</title>
</head>
<body>
    <h1>Список задач</h1>
    
    <h2>Привет, <?= htmlspecialchars($_SESSION['userEmail']) ?></h2>
    <form action="logout.php" method="post">
        <input type="submit" value="Выйти"/>
    </form>

    <!-- показывается только админу -->
    <?php if (in_array(3, $_SESSION['roles'] ?? [])): ?>
        <p><a href="manage_urgency.php">⚙️ Управление уровнями срочности</a></p>
    <?php endif; ?>

    

</body>
</html>