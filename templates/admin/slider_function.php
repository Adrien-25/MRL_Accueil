<?php

global $wpdb;
//CREATION TABLE wp_sliders
// $table_sliders = $wpdb->prefix . 'sliders';
function create_table_sliders(){
        global $wpdb;
        $table_sliders = "mrl_sliders";
        $charset_collate = $wpdb->get_charset_collate();
        $sql2 = "CREATE TABLE IF NOT EXISTS $table_sliders 
        (
            `id` INT NOT NULL AUTO_INCREMENT,
            
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
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql2);
}
        ////////////////////////////////////////////////////////////////////////////////////////////////

        //CREATION TABLE wp_slides
        // $table_slides = $wpdb->prefix . 'slides';
function create_table_slides(){
        global $wpdb;
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
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql3);
}
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////IMAGE//////////////////////////////////////
function save_image(){
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                if ($_FILES['image']['size'] <= 1000000) {
                        $extension_upload = pathinfo($_FILES['image']['name'])['extension'];
                        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                        if (in_array($extension_upload, $extensions_autorisees)) {
                                $adressVersImage = WP_CONTENT_DIR . "/uploads/" . date('Y'). "/".date('m'). "/" . basename($_FILES['image']['name']);
                                return move_uploaded_file($_FILES['image']['tmp_name'], $adressVersImage);     
                        }
                }
        }
        return false;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////


//affiche menu déroulant des pages
function get_pages_array(){
        global $wpdb;
        $select_page = $wpdb->get_results(
                "SELECT id, post_title 
                FROM " . $wpdb->prefix . "posts 
                WHERE post_type = 'page'"
                
        );
return $select_page;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////

//INSERT de nouvelles données dans la table mrl_sliders
function sql_insert_sliders($page_id){
        global $wpdb;

        $page = $wpdb->get_var("SELECT posts_id FROM mrl_sliders WHERE posts_id = $page_id");

        if(empty($page)){
                $result = $wpdb->insert(
                        'mrl_sliders',
                        array(
                                'posts_id'      => $page_id,     
                        )    
                );
                return $result;
        }
}
//INSERT de nouvelles données dans la table mrl_slides
function sql_insert_slides($page_id,$slide_title,$slide_image,$slide_link){
        
        global $wpdb;
        $slider_id = $wpdb->get_var("SELECT id FROM mrl_sliders WHERE posts_id = $page_id");
        $insert_slides = $wpdb->insert(
                'mrl_slides',
                array(
                        'sliders_id'    => $slider_id,
                        'title'         => $slide_title,
                        'image'         => WP_CONTENT_URL . "/uploads/" . date('Y'). "/".date('m'). "/" . basename($slide_image),
                        'link'          => $slide_link
                )

        );
        return $insert_slides;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////


// AFFICHE RESULTAT SELON SELECTION MENU
function display_slides($page_id) {
        global $wpdb;
        
        $all_slides = $wpdb->get_results(
                "SELECT mrl_slides.id, mrl_slides.title, mrl_slides.link, mrl_slides.image 
                        FROM mrl_slides 
                        JOIN mrl_sliders 
                        ON mrl_slides.sliders_id = mrl_sliders.id 
                        where mrl_sliders.posts_id = '$page_id'"
        );
        return $all_slides;

}


//FUNCTION DELETE CHECKBOX
function slide_delete($slide_id){
        global $wpdb;

        return is_int($wpdb->delete( 'mrl_slides', array( 'id' => $slide_id ), array( '%d' ) ));

}

///Front

function display_front($current_page){
        global $wpdb;
        $result = $wpdb->get_results(
          "SELECT mrl_slides.id, mrl_slides.title, mrl_slides.link, mrl_slides.image 
        FROM mrl_slides 
        JOIN mrl_sliders 
        ON mrl_slides.sliders_id = mrl_sliders.id 
        where mrl_sliders.posts_id = $current_page"
        );
        return $result;
      }