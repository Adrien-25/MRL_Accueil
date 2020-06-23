<?php

class SliderMrl{
  public $title;
  public $img;
  public $link;

  function __construct($title,$img,$link){
   
    $this->title = $title;
    $this->img = $img;
    $this->link = $link;
  }
}

class SliderNext{
  static $next = 1;

  public $title = [];
  public $link = [];
  public $img = [];


  public function __construct(){
    $this->number = self::$next;
    self::$next ++;
  } 

  public function addSlide($slide){

  }

}


