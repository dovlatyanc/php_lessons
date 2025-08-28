<?php
echo "ЗАДАЧА 4<br>";
if(!isset($_POST['submit'])){
$num = $_POST['num'];
if (is_numeric($num)) {
 $num = floatval($num);
 if ($num >= 0) {  
    $sqrt = sqrt($num);

    echo "Квадратный корень от  $num  ~ " . number_format($sqrt, 2);
    
}
}
}else{
    echo "Кнопка не нажата!<br>";
} 