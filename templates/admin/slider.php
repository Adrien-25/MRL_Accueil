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

<h1>Sliders List : </h1>
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

if((isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_FILES['image']['name']))){
    
    //creation de la table wp_slide_list
    $table_name1 = $wpdb->prefix . 'slide_list';
    $charset_collate1 = $wpdb->get_charset_collate();
    $sql1 = "CREATE TABLE IF NOT EXISTS $table_name1 (
        id int NOT NULL AUTO_INCREMENT,
        slide_title VARCHAR(250) NOT NULL,
        slide_link VARCHAR(250) NOT NULL,
        slide_image VARCHAR(250) NOT NULL,
        slide_page_name_1 VARCHAR(50) NOT NULL ,
        FOREIGN KEY (slide_page_name_1) REFERENCES $table_name2(slide_page_name),
        PRIMARY KEY  (id)
    ) $charset_collate1;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql1 );

    //creation de la table wp_slide_page_list
    $table_name2 = $wpdb->prefix . 'sliders_page_list';
    $charset_collate2 = $wpdb->get_charset_collate();
    $sql2 = "CREATE TABLE IF NOT EXISTS $table_name2 (
        id int NOT NULL AUTO_INCREMENT, 
        slide_page_name VARCHAR(50) NOT NULL ,
        slide_title VARCHAR(250) NOT NULL,
        
        PRIMARY KEY  (id)
    ) $charset_collate2;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql2 );


}
 if(isset($_FILES['image']['name'])){
    $slide_image_url = WP_CONTENT_URL."/uploads/2020/06/".basename($_FILES['image']['name']);
 }
    if((isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_FILES['image']['name']))){
    // global $wpdb;
    $slide_title        = $_POST['title']; 
    $slide_link         = $_POST['link']; 
    $slide_image        = $slide_image_url;
    $slide_page_name_1    = $_POST['page_title'];
}
    
    $result_list = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."slide_list");
    foreach ( $result_list as $row ) 
    {
        echo '<div style="display:inline-block">
        <div style="border:1px solid; margin:5px ;width:200px;height:auto">
        <span>X</span>
        <p><b>titre du slider : </b>'.$row->slide_title.'</p>
        <p><b>lien du slider : </b>'.$row->slide_link.'</p>
        <p><img style="width:200px ; height:80px" src="'.$row->slide_image.'">
        </p>
        </div>
        </div>';
    };
    echo "<pre>";
    // var_dump($result_list);
    echo "</pre>";
    

?>
     <h1>Page du Slider : </h1>
<form method="POST" action="" enctype="multipart/form-data">
        <div>
            <table>

                <tr>
                    <td>page slider : </td>
                    <td><select name="mes sliders">
                        <?php foreach ( $result_list as $row ):?>
                            <option name="page_title_list" ><?=$row->slide_page_name;?></option>
                        <?php endforeach ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit">voir Slider</button></td>
                </tr>
                </table>
            
            </div>
    </form>

    <?php
        //  $slide_all_title = $wpdb->get_results("SELECT $slide_title FROM $table_name1 
        // INNER JOIN $table_name2
        // WHERE $table_name2.$slide_page_name = $table_name1.$slide_page_name");
    // if(isset($_POST['page_title'])){    
        // ('SELECT Reponse FROM FAC WHERE Question="'.$questionfac.'"');SELECT * FROM `wp_sliders_page_list` WHERE `slide_page_name`
        if(isset($_POST['page_title_list'])){
            $slide_page_name = $_POST['page_title_list'];
        // $slide_all_title = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."sliders_page_list WHERE slide_page_name='".$_POST."['page_title_list']'");
        $slide_all_title = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."sliders_page_list WHERE `slide_page_name`=".$_POST['page_title_list']."");


        foreach ( $slide_all_title as $row ) 
        {
            echo '<div style="display:inline-block">
            <div style="border:1px solid; margin:5px ;width:200px;height:auto">
            <h2>'.$row->slide_page_name.'</h2>
            <p>'.$row->slide_title.'</p>
            </div>
            </div>';
        };
        // }
        echo "<pre>";
        var_dump($slide_all_title);
        echo "</pre>";
        echo "<pre>";
        var_dump($row->slide_page_name);
        echo "</pre>";
    }




if((isset($_POST['page_title'])) && (isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_FILES['image']['name']))){
    // global $wpdb;
    $slide_title        = $_POST['title']; 
    $slide_link         = $_POST['link']; 
    $slide_image        = $slide_image_url;
    $slide_page_name_1    = $_POST['page_title']; 

    
    $wpdb->insert(
        $wpdb->prefix.'sliders_page_list',
        array(
            'slide_page_name' => $slide_page_name,
            'slide_title' => $slide_title
        ),
        array(
            '%s',
            '%s'
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'slide_list',
        array(
            'slide_title' => $slide_title,
            'slide_link' => $slide_link,
            'slide_image' => $slide_image,
            'slide_page_name_1' => $slide_page_name_1
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