<?php
echo "ЗАДАЧА 3<br>";
if(!isset($_POST['submit'])){
$num = $_POST['num'];
$new_arr=[];
$str = (string) $num;
  
        for ($i = 0; $i < strlen($str); $i++) {
            
       
            $new_arr[] = $str[$i];
            $new_arr[] = $str[$i];
     
          
           $result = implode('', $new_arr);  
        }
    echo "Исходное число: $num<br>";
    echo "После дублирования: $result<br>";

}else{
    echo "Кнопка не нажата!<br>";
}