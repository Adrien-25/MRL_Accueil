<?php
global $wpdb;
// $slide_page_name;
// $slide_title; 
// $slide_link ; 
// $slide_image_url ;
// $slide_image ;
// $find_page;

////////////////////////IMAGE//////////////////////////////////////

if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
{
        if ($_FILES['image']['size'] <= 1000000)
        {
                $infosfichier = pathinfo($_FILES['image']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {       
                    $adressVersImage = WP_CONTENT_DIR . "/uploads/2020/07/" . basename($_FILES['image']['name']);
                    move_uploaded_file($_FILES['image']['tmp_name'], $adressVersImage );
                    echo "image envoyé!!<br>";
                }       
        }
}

        //CREATION TABLE wp_sliders
// $table_sliders = $wpdb->prefix . 'sliders';
if(!isset($table_sliders) && !isset($table_slides)){
$table_sliders = "mrl_sliders";
$charset_collate = $wpdb->get_charset_collate();
$sql2 = "CREATE TABLE IF NOT EXISTS $table_sliders 
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `name_slider` VARCHAR(32) NOT NULL,
    `posts_id` BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_sliders_posts_idx` (`posts_id` ASC),
    CONSTRAINT `fk_sliders_posts`
    FOREIGN KEY (`posts_id`)
    REFERENCES `BddDevFusionMrl`.`wp_posts` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION

) 
$charset_collate";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql2 );

        //CREATION TABLE wp_slides
// $table_slides = $wpdb->prefix . 'slides';
$table_slides = "mrl_slides";
$charset_collate = $wpdb->get_charset_collate();
$sql3 = "CREATE TABLE IF NOT EXISTS $table_slides 
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `sliders_id` INT NOT NULL,
    `title` VARCHAR(32) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `link` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_slides_sliders_idx` (`sliders_id` ASC),
    CONSTRAINT `fk_slides_sliders`
    FOREIGN KEY (`sliders_id`)
    REFERENCES `BddDevFusionMrl`.`mrl_sliders` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
) 
$charset_collate";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql3 ); 
}

////////////////////////////
//DECLARATION DE VARIABLE si formulaire remplis
if((isset($_POST['pages'])) && (isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_FILES['image']['name']))){
 
        $_SESSION['page_id'] = $_POST['pages'];
        $slide_title        = $_POST['title']; 
        $slide_link         = $_POST['link']; 
        $slide_image_url    = WP_CONTENT_URL."/uploads/2020/07/".basename($_FILES['image']['name']);
        $slide_image        = $slide_image_url;

        $select_name = $wpdb->get_var( "SELECT post_title FROM wp_posts WHERE id = '".$_SESSION['page_id']."'");

        // echo "<pre>";
        // var_dump($slide_page_name,$_POST['pages']);
        // echo "</pre>";
        //INSERT de nouvelles données dans la table mrl_sliders
                $insert_sliders = $wpdb->insert(
                        'mrl_sliders',
                        array(
                        'name_slider' => $select_name,
                        'posts_id' => $_SESSION['page_id']
                        )
                );
                //INSERT de nouvelles données dans la table mrl_slides
                $select_id_sliders = $wpdb->get_var( "SELECT id FROM mrl_sliders WHERE name_slider = '$select_name'");
                // var_dump($select_id_sliders);
                
                        $insert_slides = $wpdb->insert(
                                'mrl_slides',
                                array(
                                'sliders_id' => $select_id_sliders,   
                                'title' => $slide_title,
                                'image' => $slide_image,
                                'link' => $slide_link 
                                )         
                        );
}  

//affiche menu déroulant des pages
$select_page = $wpdb->get_results(
        "SELECT id, post_title 
        FROM ".$wpdb->prefix."posts 
        WHERE post_type = 'page'" 
);

// AFFICHE RESULTAT SELON SELECTION MENU


// $find_page = $_POST['find_page'];
if (isset($_POST['pages']))
{
        // $select_id_posts = $wpdb->get_var( "SELECT id FROM wp_posts WHERE post_title = '".$_POST['pages']."'");
        
        $slide_display = $wpdb->get_results(
                "SELECT mrl_slides.id, mrl_slides.title, mrl_slides.link, mrl_slides.image 
                FROM mrl_slides 
                JOIN mrl_sliders 
                ON mrl_slides.sliders_id = mrl_sliders.id 
                JOIN wp_posts 
                ON mrl_sliders.posts_id = wp_posts.id 
                WHERE mrl_sliders.posts_id =   (SELECT id 
                                                FROM wp_posts 
                                                WHERE id = '".$_POST['pages']."')"
        );

        // echo "<pre>";
        // var_dump('pages',$_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($find_page);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($select_id_posts);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($slide_display);
        // echo "</pre>";

}
////////////////////////////





////////////////////////////
// $sliders_join = $wpdb->get_results
//                 ("SELECT 'id' 
//                 FROM mrl_slides
//                 JOIN mrl_sliders
//                 ON mrl_slides.sliders_id = mrl_sliders.id
//                 JOIN wp_posts
//                 ON mrl_sliders.posts_id = wp_posts.id
//                 WHERE 'id' = (SELECT id 
//                         FROM wp_posts 
//                         WHERE post_title = $slide_page_name)
//                 ");


// $slide_display = $wpdb->get_results
//                 ("SELECT 'id', 'title', 'link', 'image' 
//                 FROM mrl_slides AS slides
//                 JOIN mrl_sliders AS sliders
//                 ON slides.sliders_id = sliders.id
//                 JOIN wp_posts AS posts
//                 ON sliders.posts_id = posts.id
//                 WHERE 'id' = (SELECT id 
//                         FROM posts 
//                         WHERE post_title = $slide_page_name)
//                 ");

// $slide_display = $wpdb->get_results
//                 ("SELECT 'id', 'title', 'link', 'image' 
//                 FROM mrl_slides
//                 JOIN mrl_sliders
//                 ON mrl_slides.sliders_id = mrl_sliders.id
//                 JOIN wp_posts
//                 ON mrl_sliders.posts_id = wp_posts.id
//                 WHERE 'id' = (SELECT id 
//                         FROM wp_posts 
//                         WHERE post_title = $slide_page_name)
//                 ");

// $find_page = $_POST['find_page'];

// $slide_display = $wpdb->get_results(
// "SELECT mrl_slides.id, mrl_slides.title, mrl_slides.link, mrl_slides.image 
// FROM mrl_slides 
// JOIN mrl_sliders 
// ON mrl_slides.sliders_id = mrl_sliders.id 
// JOIN wp_posts 
// ON mrl_sliders.posts_id = wp_posts.id 
// WHERE mrl_sliders.posts_id IN (SELECT id 
//                                FROM wp_posts 
//                                WHERE post_title LIKE '".$slide_page_name."')");


// $slide_display = $wpdb->get_results(
//         "SELECT mrl_slides.id, mrl_slides.title, mrl_slides.link, mrl_slides.image 
//         FROM mrl_slides 
//         JOIN mrl_sliders 
//         ON mrl_slides.sliders_id = mrl_sliders.id 
//         JOIN wp_posts 
//         ON mrl_sliders.posts_id = wp_posts.id 
//         WHERE mrl_sliders.posts_id IN (SELECT id 
//                                         FROM wp_posts 
//                                         WHERE post_title = $slide_page_name)");

                               
                               
                               //sortir le résultat entrée en bdd
// $result_list = $wpdb->get_results("SELECT * FROM mrl_sliders");
////////////////////////////






////////////////////////////






////////////////////////////







////////////////////////////




//////////////////////////////////////////////////////////////
//BROUILLON
// $resultats = $wpdb->get_results(
//         $wpdb->prepare(
//             "SELECT distinct id,post_title FROM {$wpdb->prefix}posts WHERE post_type = 'page'",
            
//         )
//     );
//     echo "<pre>";
//     var_dump($resultats);
//     echo "</pre>";
//////////////////

// $insert_sliders = "INSERT INTO `mrl_sliders`('name_slider')
//                 VALUES('".$slide_title."')";
// $wpdb->query(
// $wpdb->prepare($insert_sliders)
// );
// $insert_slides = "INSERT INTO `mrl_slides`('title','image','link')
//                 VALUES('".$slide_title."','".$slide_image."','".$slide_link."')";
// $wpdb->query(
// $wpdb->prepare($insert_slides)
// );