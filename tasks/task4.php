<?php
echo "ЗАДАЧА 3!<br>";
if(!isset($_POST['submit'])){
$num = $_POST['num'];
$result = 0;
$sum  = 0;
$str = (string) $num;
        for ($i = 0; $i < strlen($str); $i++) {
            
       
        }
    echo "Среднее арифметическое: $result<br>";

}else{
    echo "Кнопка не нажата!<br>";
}