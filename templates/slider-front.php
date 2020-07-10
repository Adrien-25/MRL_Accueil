<?php require_once "admin/slider_function.php" ?>

<div id="slider_Accueil" class="slideshow-container">

  <?php
   global $post;
  foreach (display_front($post->ID) as $slide) :
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
  <?php
  for ($i = 0; $i < count_dot($post->ID); $i++) : ?>
    <span class="dot" onclick="currentSlide($i)"></span>
  <?php endfor ?>
</div>