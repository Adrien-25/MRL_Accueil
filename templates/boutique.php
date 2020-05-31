<?php
    //Récupérer l'ID des images enregistré
    $image_id = get_option('myprefix_image_id');

    //Récupérer les liens enregistré
    $link =  get_option('myprefix_link');

    //Récupérer les descriptions enregistré
    $description =  get_option('myprefix_description');

    //Récupérer les descriptions enregistré
    $price =  get_option('myprefix_prix');

    //Récupérer toute les rangés dans la database que l'on a besoin de modifier
    $database_rows = [
        'myprefix_image_id',
        'myprefix_link',
        'myprefix_description',
        'myprefix_prix'
    ];

    $product_number = [
        'Produit 1',
        'Produit 2',
        'Produit 3',
        'Produit 4'
    ];

    $my_prefix_image = [
        'myprefix_image_id',
        'myprefix_image_id_2',
        'myprefix_image_id_3',
        'myprefix_image_id_4'
    ];

    $myprefix_media_manager = [
        'myprefix_media_manager',
        'myprefix_media_manager_2',
        'myprefix_media_manager_3',
        'myprefix_media_manager_4',
    ];

    $image_saved = [];

    for ($i = 0; $i < count($database_rows); $i++) {
        if ( intval( $image_id ) > 0 ) {
            //Equivalent d'une balise <img> en HTML
            $image_saved[] = wp_get_attachment_image($image_id[$i], 'medium', false, [ 'id' => 'myprefix-preview-image'] );
        }else {
            $image_saved[] = '<p>Image Not Found </p>';
        }
    }

    //Modifier les élément modifiable, si la database est vide, crée les rangés d'abord
    foreach ($database_rows as $database_row) {
        if ( isset($_POST[$database_row]) && $_POST[$database_row] != '' ){
            if( ! get_option($database_row) ){
                add_option($database_row);
            }
            $image = $_POST[$database_row];
            update_option( $database_row, $image );
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
    ?>
    <h1>Gestion des produits mis en avant</h1>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="boutique-container">
        <?php for ($i = 0; $i < count($my_prefix_image); $i++):?>
            <div>
                <h2><?= $product_number[$i] ?></h2>
                <?= $image_saved[$i] ?>
                <p>Image du produit</p>
                <input type="text" name='myprefix_image_id[]' id='<?= $my_prefix_image[$i] ?>' value='<?= esc_attr($image_id[$i])?>' class="regular-text"/>
                <input type="button" class="button-primary" value="<?php esc_attr_e( 'Sélectionner une image' )?>" id="<?= $myprefix_media_manager[$i] ?>"/>
                <p>Lien du produit vers la boutique</p>
                <input type="text" name='myprefix_link[]' value='<?= esc_attr($link[$i])?>' class="regular-text"/>
                <p>Description du produit</p>
                <input type="text" name='myprefix_description[]' value='<?= esc_attr($description[$i])?>' class="regular-text"/>
                <p>Prix du produit</p>
                <input type="text" name='myprefix_prix[]' value='<?= esc_attr($price[$i])?>' class="regular-text"/>
            </div>
        <?php endfor ?>
        
    </div>
        <button class="boutique-save">Enregistrer</button>
    </form>
<?php


