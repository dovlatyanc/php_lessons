<?php

// Получаем данные из формы
$title = $_POST['title'] ?? '';
$isbn = $_POST['isbn'] ?? '';
$pub_date = $_POST['pub_date'] ?? '';
$pages = $_POST['pages'] ?? '';

$errors = [];

if (!preg_match('/\S/', $title)) {
    $errors[] = "Название книги не может быть пустым или состоять только из пробелов.";
}

//  формат XXX-X-XXXXX-XXX-X
if (!preg_match('/^\d{3}-\d{1}-\d{5}-\d{3}-\d{1}$/', $isbn)) {
    $errors[] = "ISBN должен быть 13-значным и в формате XXX-X-XXXXX-XXX-X (например: 978-0-306-40615-7).";
}

$isbn_clean = preg_replace('/[^0-9]/', '', $isbn);
if (strlen($isbn_clean) !== 13) {
    $errors[] = "ISBN должен содержать ровно 13 цифр.";
}


if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $pub_date)) {
    $errors[] = "Дата публикации должна быть в формате ГГГГ-ММ-ДД.";
} 

if (!preg_match('/^[1-9]\d*$/', $pages)) {
    $errors[] = "Количество страниц должно быть положительным целым числом.";
}


if (empty($errors)) {
    echo "<h2> Всё верно! Книга принята.</h2>";
    echo "<p><strong>Название:</strong> " . htmlspecialchars($title) . "</p>";
    echo "<p><strong>ISBN:</strong> " . htmlspecialchars($isbn) . "</p>";
    echo "<p><strong>Дата публикации:</strong> " . htmlspecialchars($pub_date) . "</p>";
    echo "<p><strong>Страниц:</strong> " . htmlspecialchars($pages) . "</p>";
} else {
    echo "<h2>Ошибки в заполнении:</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    echo '<a href="javascript:history.back()"> ← Вернуться и исправить</a>';
}

?>