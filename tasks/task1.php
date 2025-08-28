<?php
echo "ЗАДАЧА 1 <br>";
if(!isset($_POST['submit'])){
  $p = $_POST["tf"];
    $tf=$_POST["tf"];
   $p = ($p - 32) * (5 / 9);

  echo "Температура в Цельсии: <br>"; 
     echo "$tf °F = " . number_format($p, 2) . " °C <br>";

}else{
    echo "Кнопка не нажата!<br>";
}

