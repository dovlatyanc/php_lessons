<?php
echo "ЗАДАЧА 4<br>";
if(!isset($_POST['submit'])){
$num = $_POST['num'];
$result = 0;
$sum  = 0;
$str = (string) $num;
        for ($i = 0; $i < strlen($str); $i++) {
            $sum+=$str[$i];
        }
        $result =  $sum/strlen($str);
        echo "Число: $num<br>";
        echo "Сумма цифр: $sum<br>";
        echo "Количество цифр: " . strlen($str) . "<br>";
        echo "Среднее арифметическое: " . number_format($result, 2) . "<br>";

}else{
    echo "Кнопка не нажата!<br>";
}