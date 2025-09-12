<?php

function  myCollection():iterable{
    yield 1;
    yield 2;
    yield 3;
} 

function where(iterable $collection, callable $condition):iterable{
    foreach($collection as $item)
        if($condition($item))
            yield $item;
}

foreach(myCollection() as $item){
    echo "<div>$item</div>";
}