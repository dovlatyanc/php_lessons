<?php

class Dynamic{
    private array $fields = [ ];
    public function __get($name){
        return $this->fields[$name];
    }
    public function __set($name,$value){
        $this->fields[$name] = $value;
    }
    public function __isset($name){
        return isset($this->fields[$name]);
    }
    public function __unset($name){
        unset($this->fields[$name]);
    }
    public function __call($functionName,array $arg){
        if($functionName=='print')
            print_r($arg);
        else
            throw new Exception( "method not exist") ;
    }
}

$o= new Dynamic;
$o->x=6;


if(isset($o->x))
    echo 'Exist';
else
    echo 'Not exist';