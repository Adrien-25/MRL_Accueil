
<?php require_once "admin/slider_control.php"?>


<div id = "slider_Accueil" class="slideshow-container">

<?php 

global $wpdb;

//  if(isset($table_name1)){


//a mettre à chaque page ou l'on desire le slider

$slider_page = 'accueil';//changer accueil selon page
$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."slide_list WHERE slide_page_name = '$slider_page'");
///////

foreach ($results as $slide): 
?>

<div class="mySlides fade">
  <a href="<?= $slide->slide_link;?>">
  <img src="<?= $slide->slide_image; ?>">
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

//  }else{
//    echo "<p style='color:red'>aucune image du slide n'a encore été défini.</p>";
//  }
?>
