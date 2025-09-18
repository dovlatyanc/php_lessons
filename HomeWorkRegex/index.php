<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regex</title>
    <link rel="stylesheet" href="index.css"> 
</head>
    <body>
        <div>Введите данные книги:</div>
        <form action="script.php" method="POST">


            <div>
                <label for="title">Название книги:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="isbn">ISBN (13 цифр): </label>
                <input type="text" id="isbn"  name="isbn" required>
            </div>
            <div>
                <label for="pub_date">Дата публикации :</label>
                <input type="text" id="pub_date" name="pub_date" placeholder="2000-12-31" required>
            </div>

            <div>
                <label for="pages">Количество страниц:  </label>
                <input type="text" id="pages" name="pages" required>
            </div>

            <button type="submit">Отправить</button>
        </form>
    </body>
</html>