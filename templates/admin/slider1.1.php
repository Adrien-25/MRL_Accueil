<?php require_once __DIR__."/../slidesK/slider-front-class.php" ?>

<?php
if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
{
        if ($_FILES['image']['size'] <= 1000000)
        {
                $infosfichier = pathinfo($_FILES['image']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {       
                    $adressVersImage = WP_CONTENT_DIR . "/uploads/2020/06/" . basename($_FILES['image']['name']);
                    move_uploaded_file($_FILES['image']['tmp_name'], $adressVersImage );
                    echo "image envoyé!!<br>";
                }       
        }
}
?>
Maquette_ActualiteÌs_MRL_07.png
Maquette_Rock_Symbol_05.png
Maquette_ActualiteÌs_Caa_02.png
Maquette_Acceuil_12.png

<h1>Liste des slides : </h1>
<form method="POST" action="" enctype="multipart/form-data">
        <div>
            <table>
                <tr>
                    <td>page attribuée : </td>
                    <td><input type="text" name="page_title" required></td>
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
                    <td><input type="file" name='image' required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit">Ajout du slider</button></td>
                </tr>
            </table>
            
        </div>
     </form>
<?php
global $wpdb;

if((isset($_POST['page_title'])) && (isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_FILES['image']['name']))){
    
    //creation de la table wp_slide_list
    $table_name1 = $wpdb->prefix . 'slide_list';
    $charset_collate1 = $wpdb->get_charset_collate();
    $sql1 = "CREATE TABLE IF NOT EXISTS $table_name1 (
        id int NOT NULL AUTO_INCREMENT,
        slide_title VARCHAR(250) NOT NULL,
        slide_link VARCHAR(250) NOT NULL,
        slide_image VARCHAR(250) NOT NULL,
        slide_page_name VARCHAR(50) NOT NULL ,
        PRIMARY KEY  (id)
    ) $charset_collate1;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql1 );
}

if((isset($_POST['page_title'])) && (isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_FILES['image']['name']))){
    
    $slide_image_url = WP_CONTENT_URL."/uploads/2020/06/".basename($_FILES['image']['name']);
    $slide_title        = $_POST['title']; 
    $slide_link         = $_POST['link']; 
    $slide_image        = $slide_image_url;
    $slide_page_name    = $_POST['page_title'];
}

// if(isset($table_name1)){

        $result_list = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."slide_list");
        foreach ( $result_list as $row ) {
            echo '<div style="display:inline-block">
            <div style="border:1px solid; margin:5px ;width:200px;height:auto">
            <span>X</span>
            <p><b>page attirbuée : </b>'.$row->slide_page_name.'</p>
            <p><b>titre du slide : </b>'.$row->slide_title.'</p>
            <p><b>lien du slide : </b>'.$row->slide_link.'</p>
            <p><img style="width:200px ; height:80px" src="'.$row->slide_image.'">
            </p>
            </div>
            </div>';
        };

//     }else{
//     echo "aucune image du slide n' a été défini.";    
// }

if((isset($_POST['page_title'])) && (isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_FILES['image']['name']))){
  
    $slide_title        = $_POST['title']; 
    $slide_link         = $_POST['link']; 
    $slide_image        = $slide_image_url;
    $slide_page_name    = $_POST['page_title']; 

    $wpdb->insert(
        $wpdb->prefix.'slide_list',
        array(
            'slide_title' => $slide_title,
            'slide_link' => $slide_link,
            'slide_image' => $slide_image,
            'slide_page_name' => $slide_page_name
        ),
        array(
            '%s',
            '%s',
            '%s',
            '%s'
        )
    );
}
?>
<h1>Pages Slides : </h1>
<form method="POST" action="" enctype="multipart/form-data">
        <div>
            <table>

                <tr>
                    <td>page slider : </td>
                    <td><select name="my_slider">
                        <?php 
                            $result_list_page = $wpdb->get_results("SELECT DISTINCT slide_page_name FROM ".$wpdb->prefix."slide_list");
                            foreach ( $result_list_page as $row ):?>
                            <option name="find_page" ><?=$row->slide_page_name;?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit">affiche slide par page</button></td>
                </tr>
                </table>
            
            </div>
    </form>
<?php

if(isset($_POST['my_slider'])){

    $slide_page_name_result = $_POST['my_slider'];
    $slide_all_title = $wpdb->get_results("SELECT * FROM wp_slide_list WHERE slide_page_name = '$slide_page_name_result'");
    
        foreach ( $slide_all_title as $row ) {
            echo '<div style="display:inline-block">
            <div style="border:1px solid; margin:5px ;width:200px;height:auto">
            <p><b>page attirbuée : </b>'.$row->slide_page_name.'</p>
            <p><b>titre du slide : </b>'.$row->slide_title.'</p>
            <p><b>lien du slide : </b>'.$row->slide_link.'</p>
            <p><img style="width:200px ; height:80px" src="'.$row->slide_image.'">
            <p>id : '.$row->id.'</p>
            <form method="POST" action="">
                <input type="text" name="id">ecrire l\'id à supprimer</input>
                <input type="submit" name="supprimer" value="Supprimer"></input>
            </form>
            </div>
            </div>'; 

        };
        
 
        // if(isset($delete)){
        // $slide_delete = $wpdb->get_results("SELECT slide_title FROM wp_slide_list WHERE '$delete' = '$slide_title'");
        // echo '<pre>';
        // var_dump($slide_title);
        // echo '</pre>';
        // echo '<pre>';
        // var_dump($slide_delete);
        // echo '</pre>';
        // }

}
if(isset($_POST['id'])){
    $supprimer = $_POST['id'];
    $select = $wpdb->get_results("SELECT slide_title FROM wp_slide_list");
    $slide_delete = $wpdb->get_results("DELETE FROM wp_slide_list WHERE id = $supprimer ");
        echo '<pre>';
        var_dump($supprimer);
        echo '</pre>';
        echo '<pre>';
        var_dump($slide_delete);
        echo '</pre>';
}
?>

-- -----------------------------------------------------
-- Schema BddDevFusionMrl
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BddDevFusionMrl
-- -----------------------------------------------------
USE `BddDevFusionMrl` ;

-- -----------------------------------------------------
-- Table `BddDevFusionMrl`.`slider_page`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `BddDevFusionMrl`.`slider_page` ;

CREATE TABLE IF NOT EXISTS `BddDevFusionMrl`.`slider_page` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name_page` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BddDevFusionMrl`.`sliders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `BddDevFusionMrl`.`sliders` ;

CREATE TABLE IF NOT EXISTS `BddDevFusionMrl`.`sliders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name_slider` VARCHAR(32) NOT NULL,
  `page_slider_id` INT NOT NULL,
  PRIMARY KEY (`id`, `page_slider_id`),
  INDEX `fk_sliders_page_slider1_idx` (`page_slider_id` ASC) ,
  CONSTRAINT `fk_sliders_page_slider1`
    FOREIGN KEY (`page_slider_id`)
    REFERENCES `BddDevFusionMrl`.`slider_page` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BddDevFusionMrl`.`slides`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `BddDevFusionMrl`.`slides` ;

CREATE TABLE IF NOT EXISTS `BddDevFusionMrl`.`slides` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `sliders_id` INT NOT NULL,
  `title` VARCHAR(32) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `link` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`, `sliders_id`),
  INDEX `fk_slides_sliders_idx` (`sliders_id` ASC) ,
  CONSTRAINT `fk_slides_sliders`
    FOREIGN KEY (`sliders_id`)
    REFERENCES `BddDevFusionMrl`.`sliders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


//////////////////////////////////////////////

"SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
    SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
    SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

     -- -----------------------------------------------------
     -- Table `BddDevFusionMrl`.`wp_page_slider`
     -- -----------------------------------------------------
    ".$table_page_slider = $wpdb->prefix . 'slider_page'.";
    DROP TABLE IF EXISTS ".$table_page_slider.";

    CREATE TABLE IF NOT EXISTS ".$table_page_slider." (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name_page` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;
        

     -- -----------------------------------------------------
     -- Table `BddDevFusionMrl`.`wp_sliders`
     -- -----------------------------------------------------
    ".$table_sliders = $wpdb->prefix . 'sliders'.";
    DROP TABLE IF EXISTS ".$table_sliders.";
    
    CREATE TABLE IF NOT EXISTS ".$table_sliders." (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name_slider` VARCHAR(32) NOT NULL,
    `page_slider_id` INT NOT NULL,
    PRIMARY KEY (`id`, `page_slider_id`),
    INDEX `fk_sliders_page_slider1_idx` (`page_slider_id` ASC) ,
    CONSTRAINT `fk_sliders_page_slider1`
    FOREIGN KEY (`page_slider_id`)
    REFERENCES ".$table_page_slider."(`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;

     -- -----------------------------------------------------
     -- Table `BddDevFusionMrl`.`wp_slides`
     -- -----------------------------------------------------
     
    ".$table_slides = $wpdb->prefix . 'slides'.";
    DROP TABLE IF EXISTS ".$table_slides.";
    
    CREATE TABLE IF NOT EXISTS ".$table_slides." (
    `id` INT NOT NULL AUTO_INCREMENT,
    `sliders_id` INT NOT NULL,
    `title` VARCHAR(32) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `link` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`, `sliders_id`),
    INDEX `fk_slides_sliders_idx` (`sliders_id` ASC) ,
    CONSTRAINT `fk_slides_sliders`
    FOREIGN KEY (`sliders_id`)
    REFERENCES ".$table_sliders." (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS";


/////////////////////////////////////////

"USE `BddDevFusionMrl` ;
    
    -- -----------------------------------------------------
    -- Table `BddDevFusionMrl`.`wp_slider_page`
    -- -----------------------------------------------------
    DROP TABLE IF EXISTS `BddDevFusionMrl`.`wp_slider_page` ;
    
    CREATE TABLE IF NOT EXISTS `BddDevFusionMrl`.`wp_slider_page` (
      `id` INT NOT NULL AUTO_INCREMENT,
      `name_page` VARCHAR(255) NOT NULL,
      PRIMARY KEY (`id`))
    ENGINE = InnoDB;
  
    
    -- -----------------------------------------------------
    -- Table `BddDevFusionMrl`.`wp_sliders`
    -- -----------------------------------------------------
    DROP TABLE IF EXISTS `BddDevFusionMrl`.`wp_sliders` ;
    
    CREATE TABLE IF NOT EXISTS `BddDevFusionMrl`.`wp_sliders` (
      `id` INT NOT NULL AUTO_INCREMENT,
      `name_slider` VARCHAR(32) NOT NULL,
      `page_slider_id` INT NOT NULL,
      PRIMARY KEY (`id`, `page_slider_id`),
      INDEX `fk_sliders_page_slider1_idx` (`page_slider_id` ASC),
      CONSTRAINT `fk_sliders_page_slider1`
        FOREIGN KEY (`page_slider_id`)
        REFERENCES `BddDevFusionMrl`.`wp_slider_page` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;
    
    
    -- -----------------------------------------------------
    -- Table `BddDevFusionMrl`.`wp_slides`
    -- -----------------------------------------------------
    DROP TABLE IF EXISTS `BddDevFusionMrl`.`wp_slides` ;
    
    CREATE TABLE IF NOT EXISTS `BddDevFusionMrl`.`wp_slides` (
      `id` INT NOT NULL AUTO_INCREMENT,
      `sliders_id` INT NOT NULL,
      `title` VARCHAR(32) NOT NULL,
      `image` VARCHAR(255) NOT NULL,
      `link` VARCHAR(255) NOT NULL,
      PRIMARY KEY (`id`, `sliders_id`),
      INDEX `fk_slides_sliders_idx` (`sliders_id` ASC),
      CONSTRAINT `fk_slides_sliders`
        FOREIGN KEY (`sliders_id`)
        REFERENCES `BddDevFusionMrl`.`wp_sliders` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB";




    ALTER TABLE `wp_sliders` DROP INDEX `fk_sliders_posts_idx`;
SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE `wp_sliders` DROP `posts_id`;

ALTER TABLE wp_sliders
  DROP FOREIGN KEY fk_sliders_posts