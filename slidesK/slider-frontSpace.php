<?php 

class SliderMrl{
  public $id;
  public $title;
  public $img;
  public $link;
  public $number;

  function __construct($id,$title,$img,$link,$number){
    $this->id = $id;
    $this->title = $title;
    $this->img = $img;
    $this->link = $link;
    $this->number = $number;
  }

  function sliderBody(){
    echo  '<div class="slideshow-container">';
    echo  '<div class="mySlides fade">';

    $this->sliderLink();
    $this->sliderImg();
    echo  '</div>';
    $this->sliderArrows();
    echo  '</div>';
    echo '<div style="text-align:center">';
    $this->sliderDots();
    echo  '</div>';
  } 


  function sliderArrows(){
    echo  '<a class="prev" onclick="plusSlides(-1)">&#10094;</a>';
    echo  '<a class="next" onclick="plusSlides(1)">&#10095;</a>';
  }
  function sliderDots(){
    echo '<span class="dot" onclick="currentSlide(1)"></span> ';
    echo '<span class="dot" onclick="currentSlide(2)"></span>';
  } 

  function sliderTitle(){
    echo '<h2>"'.$this->title.'"</h2>';
  }
  function sliderLink(){
    echo '<a href=" ' .$this->link. ' ">';
  }
  function sliderImg(){
    echo  '<img src =" ' .$this->img. ' "></a>';
  }

}
$linkImg = "assets/images/Slider/";
$sliderMrl1 = new SliderMrl(1,"best-of","Slide_CAA_Best_Off_02.jpg","#","1");





