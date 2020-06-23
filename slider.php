<?php require_once "slidesK/slider-front-class.php" ?>


<?php

if (isset($_FILES["image"]) AND $_FILES["image"]['error'] == 0)
{
        if ($_FILES["image"]['size'] <= 1000000)
        {
                $infosfichier = pathinfo($_FILES["image"]['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {       
                    $adressVersImage = WP_CONTENT_DIR . "/uploads/2020/06/" . basename($_FILES["image"]['name']);
                    move_uploaded_file($_FILES["image"]['tmp_name'], $adressVersImage );
                    echo "image envoyé!!<br>";
                }       
        }
}
?>

<h1>Sliders </h1>
<form method="POST" action="" enctype="multipart/form-data">
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
                    <td>titre slider : </td>
                    <td><input type="text" name="title" required></td>
                </tr>
                <tr>
                    <td>lien du slider : </td>
                    <td><input type="text" name="link" required></td>
                </tr>
                <tr>
                    <td>Image du slider : </td>
                    <td><input type="file" name="image" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit">Ajout du slider</button></td>
                </tr>
            </table>
            
        </div>
     </form>
<?php
if((isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_POST['link']))){
    echo "<div style=\"float:left\">
    <div style=\"border:1px solid; margin:5px\">
    <span>X</span>
    <p><b>titre du slider : </b>".$_POST['title']."
    <p><b>lien du slider : </b>".$_POST['link']."
    <p><img style=\"width: 300px\" src=".WP_CONTENT_URL."/uploads/2020/06/".basename($_FILES["image"]['name']).">
    </p>
    </div>";
}
?>
