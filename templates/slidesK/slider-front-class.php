<?php 

class Slide{

  public $title;
  public $image;
  public $link; 

  public function __construct($title, $link, $image){ 

    $this->title = $title;
    $this->link = $link;
    $this->image = $image;

  }
}

$slide1 = new Slide("Best-of", "https://www.google.com/", "assets/Images/Slider/Slide_CAA_Best_Off_02.jpg");
$slide2 = new Slide("Application", "https://www.facebook.com/", "assets/Images/Slider/Slide_Appli_02.jpg");


class SlideManager{

  public $slides;

  public function addSlide($slide){
      $this->slides[] = $slide; 
  }
  
  public function getSlides(){
      return $this->slides;
  }
}
$slideManager = new SlideManager; 
$slideManager->addSlide($slide1); 
$slideManager->addSlide($slide2);
?>