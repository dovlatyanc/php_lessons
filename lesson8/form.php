<?php
//create or edit

function showForm(array $task,bool $isNew){
    echo '<form action = " ' . ($isNew ? 'insert.php':'update.php') . '" method = "post">';

 
        if(!$isNew)
            echo '<input type ="hidden" name="name" value ="" ' . htmlentities($task['id']) . '" />';

        echo '<div>Название:</div>';
        echo '<input type ="text" name="name" value ="" ' . htmlentities($task['name']) . '" />';

        echo '<div>Срок:</div>';
        echo '<input type ="date" name="name" value ="" ' . htmlentities($task['due']) . '" />';

        echo '<div>Приоритет:</div>';
        echo '<input type ="number"min="1" max ="5" name="name" value ="" ' . htmlentities($task['prioryty']) . '" />';

        echo '<div>Описание:</div>';
        echo '<input type ="textarea" name="name" value ="" ' . htmlentities($task['description']) . '" />';

        echo '<div>';
             echo '<input type ="submit"  value="' . ($isNew ? 'Создать':'Сохранить') .'" />';
        echo '</div>';
    echo '</form>';
}