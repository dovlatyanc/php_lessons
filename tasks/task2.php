<?php


echo "ЗАДАЧА 2!<br>";
if(!isset($_POST['submit'])){
$num = $_POST['num'];
$isIncreasing = true;
$str = (string) $num;
  
        for ($i = 1; $i < strlen($str); $i++) {
            // Если текущая цифра <= предыдущей — значит, не по возрастанию
            if ($str[$i] <= $str[$i - 1]) {
                $isIncreasing = false;
                break; 
            }
        }
        if ($isIncreasing) {
            echo "✅ Цифры идут по возрастанию!";
        } else {
            echo "❌ Цифры НЕ идут по возрастанию.";
        }

}else{
    echo "Кнопка не нажата!<br>";
}