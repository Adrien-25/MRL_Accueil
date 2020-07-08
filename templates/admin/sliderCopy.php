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

<h1>Sliders </h1>
<form method="POST" action="" enctype="multipart/form-data">
        <div>
            <table>
                <tr>
                    <td>Page slider :</td>
                    <td>
                        <select id="pageSlider">
                            <option value="">--Page du Slider--</option>
                            <?php $slide_title = $_POST['title'];?>
                            <option value="<?= $slide_title?>"><?= $slide_title?></option>
                            
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
if((isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_FILES['image']['name']))){
    
    echo '<div style="float:left">
    <div style="border:1px solid; margin:5px">
    <span>X</span>
    <p><b>titre du slider : </b>'.$_POST['title'].'
    <p><b>lien du slider : </b>'.$_POST['link'].'
    <p><img style="width: 300px" src="'.WP_CONTENT_URL."/uploads/2020/06/".basename($_FILES['image']['name']).'">
    </p>
    </div>';
}




global $wpdb;
$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."slide_list");
foreach ( $results as $row ) 
{
    echo $row->slide_title.'<br>';
    echo $row->slide_link.'<br>';
    echo $row->slide_image.'<br>';
    echo $row->slide_page_name.'<br>';
};
?>  

<?php
if((isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_FILES['image']['name']))){
global $wpdb;
$tablename = $wpdb->prefix.'slide_list';
$slide_title        = $_POST['title']; 
$slide_link         = $_POST['link']; 
$slide_image        = $_FILES['image']['name']; 
$slide_page_name    = $slide_title; 
// $sql = $wpdb->prepare("INSERT INTO  $tablename     
//                         (slide_title','slide_link','slide_image','slide_page_name') 
//                 values  ($slide_title, $slide_link, $slide_image, $slide_page_name)");
// $wpdb->query($sql);
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
// echo "<pre>";
// print_r($sql);
// echo "</pre>";
echo "<pre>";
print_r($wpdb);
echo "</pre>";
// echo "<pre>";
// var_dump($wpdb);
// echo "</pre>";
}
?>




<?php
// global $wpdb;
// "<pre>";
// $myrows = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}users WHERE ID = 1" );
// print_r($myrows);   
// "</pre>";
//creation de la table wp_slide_list
global $wpdb;

$table_name1 = $wpdb->prefix . 'slide_list';

$charset_collate1 = $wpdb->get_charset_collate();

$sql1 = "CREATE TABLE IF NOT EXISTS $table_name1 (
    id int NOT NULL AUTO_INCREMENT,
    slide_title VARCHAR(50) NOT NULL,
    slide_link VARCHAR(255) NOT NULL,
    slide_image VARCHAR(255) NOT NULL,
    slide_page_name VARCHAR(50) NOT NULL ,
    PRIMARY KEY  (id)
) $charset_collate1;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql1 );
?>




<?php
//creation de la table wp_slider_page_list
global $wpdb;

$table_name2 = $wpdb->prefix . 'sliders_page_list';

$charset_collate2 = $wpdb->get_charset_collate();

$sql2 = "CREATE TABLE IF NOT EXISTS $table_name2 (
    id int NOT NULL AUTO_INCREMENT,
    slider_page_name VARCHAR(255) NOT NULL,
    slider_name VARCHAR(50) NOT NULL,
    PRIMARY KEY  (id)
) $charset_collate2;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql2 );
?>