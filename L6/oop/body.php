
<?php
include ('head.php');

class Task{
    public function __construct(
        public int $id,
        public string $title,
        public string $due
       )
       {  }

    public function print(){
        
        echo "<div>{$this -> id} </div>
              <div>{$this->title} </div>
              <div>{$this->due} </div>";
   
        
    }
}

$task1 = new Task(1, "Выдать домашки", "2025-09-04");
$task2 = new Task(2, "Позавтракать", "2025-09-04");
$task3 = new Task(3, "Выгулять собаку", "2025-09-04");
$tasks = [$task1, $task2, $task3];

echo "<div class=\"grid\">";
foreach ($tasks as $task){
    $task->print() ;
}
echo "</div>";

include ('footer.php');