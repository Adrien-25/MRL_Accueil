<?php 
 
require_once "slidesK/slider-front-class.php" ;

?>





<div class="slideshow-container">

<?php 

$slideIns = $slideManager->getSlides();

foreach ($slideIns as $slidess): 
    $slidess;
?>

<div class="mySlides fade">
  <a href="<?= $slidess->link;?>">
  <img src="<?= plugin_dir_url( dirname( __FILE__) ). $slidess->image; ?>">
  </a>
</div>

<?php endforeach ?>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a> 

</div>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span>
</div>  


