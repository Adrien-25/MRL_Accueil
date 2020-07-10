<?php require_once "admin/slider_function.php" ?>

<div id="slider_Accueil" class="slideshow-container">

  <?php

  ///////

  foreach (display_front($_GET['page_id']) as $slide) :
  ?>

    <div class="mySlides fade">
      <a href="<?= $slide->link; ?>">
        <img src="<?= $slide->image; ?>">
      </a>
    </div>
  <?php endforeach; ?>

  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
</div>

<?php

?>