<?php require_once "slidesK/slider-class.php" ?>

<?php 

// define('UPLOADS', 'assets/Images/Slider/');
// class SlideAdd{


//     public function addImage($file, $dir){
        
//         $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
//         $random = rand(0,99999);
//         $target_file = $dir.$random."_".$file['name'];

//         return ($random."_".$file['name']);
//     }

//     public function addSlider(){
//         $file = $_FILES['image'];
//         $repertoire = 'assets/Images/Slider/';
//         $nomImageAjoute = $this->addImage($file,$repertoire);
//         print_r($file);
//     }
 
// }



?>
<h1>Sliders du Noob</h1>
<form method="post" action="" enctype="multipart/form-data">
        <div>
            <table>
                <tr>
                    <td>Page slider</td>
                    <td>
                        <select id="pageSlider">
                            <option value="">--Choisir une page--</option>
                            <option value="sliderAccueil">MRL Accueil</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Titre slider : </td>
                    <td><input type="text" name="prenom"></td>
                </tr>
                <tr>
                    <td>Url du slider : </td>
                    <td><input type="text" name="nom"></td>
                </tr>
                <tr>
                    <td>Image du slider : </td>
                    <td><input type="file" name="prenom"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit">Ajout du slider</button></td>
                </tr>
            </table>
            
        </div>
     </form>
<?php 
echo "<br />";
$slideIns = $slideManager->getSlides();
foreach ($slideIns as $slidess): 
$slidess;
?>
<span>X</span>
<img style="width: 300px" src="<?= plugin_dir_url( dirname( __FILE__) ). $slidess->image; ?>">

<?php endforeach ?>
