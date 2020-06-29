<?php 
// print_r(get_defined_constants(true));
// var_dump(ini_get('upload_tmp_dir'));
// echo "<br />";
$slideIns = $slideManager->getSlides();
foreach ($slideIns as $slidess): 
$slidess;
?>
<div style="float:left">
<div style="border:1px solid; margin:5px">
<span>X</span>
<p><b>titre du slider : </b><?= $slidess->title;?></p>
<p><b>lien du slider : </b><?= $slidess->link;?></p>
<img style="width: 300px" src="<?= plugin_dir_url( dirname( __FILE__) ). $slidess->image; ?>">
</div>
</div>
<?php endforeach ?>

<?php
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
print("<center>Bonjour $prenom $nom</center>");
?>


<?php
$slideManager->addSlide($slide3); 
$slide3 = new Slide($_POST['title'],$_POST['link'],$_POST['img']);
print_r($slide3);
?>
<?php 

$slideIns = $slideManager->getSlides();

foreach ($slideIns as $slidess): 
    $slidess;
?>

<div style="float:left">
<div style="border:1px solid; margin:5px">
<span>X</span>
<p><b>titre du slider : </b><?= $slidess->title = $_POST['title'];?></p>
<p><b>lien du slider : </b><?= $slidess->link = $_POST['link'];?></p>
<img style="width: 300px" src="<?= plugin_dir_url( dirname( __FILE__) . WP_CONTENT_DIR ."/uploads/2020/06"). basename($_FILES["image"]['name']); ?>">

</div>
</div>
<?php endforeach ?>


$adressVersImage = WP_CONTENT_DIR ."/uploads/2020/06/" . basename($_FILES["image"]['name']);
                        move_uploaded_file($_FILES["image"]['tmp_name'], $adressVersImage );
                        echo "image envoyé!!<br>";


print_r($slide3);
echo "<br>";
var_dump(WP_CONTENT_URL);