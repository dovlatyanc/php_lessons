<?php

class Rectangle{

    private float $width;
    private float $height;

    public function getWidth(){return $this->width;}
    public function getHeight(){return $this->height;}

    public function setWidth($width){$this->width = $width;}
    public function setHeight($height){$this->height = $height;}

    public function __construct(float $width, float $height)
    {
        $this->height = $height;
        $this->width = $width;
        
    }
   

}

 $rect = new Rectangle(2,3);

 $rect->setWidth(15);
 $rect->setHeight(10);
 
 echo "{$rect->getWidth()} {$rect->getHeight()}";