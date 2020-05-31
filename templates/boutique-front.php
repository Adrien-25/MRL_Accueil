<?php 
$image = get_option('myprefix_image_id');
$description = get_option('myprefix_description');
$price = get_option('myprefix_prix');
$item = [
    'item1',
    'item2',
    'item3',
    'item4'
];
$default_img_url = [
    'assets/Images/Boutique/Article_1jp.jpg',
    'assets/Images/Boutique/Article_2jp.jpg',
    'assets/Images/Boutique/Article_3jp.jpg',
    'assets/Images/Boutique/Article_4jp.jpg'
];
?>

<div class="container-fluid">
        <img src="<?= plugin_dir_url( dirname( __FILE__) ).'assets/Images/Boutique/Boutique_jp.jpg'?>" alt="BEST OF 1">
    <div class="row">
    <?php for ($i = 0; $i < count($item); $i++):?>
        <div id="<?= $item[0] ?>" class="col-3">
            <div>
                <?php if ( $image ):?>
                    <?= wp_get_attachment_image($image[$i], 'medium', false, [ 'id' => 'myprefix-preview-image'] )?>
                <?php else: ?>
                    <img src="<?= plugin_dir_url( dirname( __FILE__) ). $default_img_url[$i] ?>" alt="">
                <?php endif ?>
            </div>
            <div>
                <p><b><?= ($description ? $description[$i] : $item[$i]) ?></b></p>
                <p><b><?= ($price ? "$price[$i]€" : "15€") ?></b></p>
            </div>
        </div>
    <?php endfor ?>
    </div>
</div>