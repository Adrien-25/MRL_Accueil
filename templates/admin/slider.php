<?php
include_once "slider_function.php";

//INITIALISATION DES TABLES SI NON EXISTANTES
if (!isset($table_sliders) && !isset($table_slides)) {
    //CREATION TABLE wp_sliders
    create_table_sliders();
    //CREATION TABLE wp_slides
    create_table_slides();
}

if (isset($_POST['pages'])) {
    $_SESSION['page_id'] = $_POST['pages'];
}
?>

<body id="slider-body">

    <h2>Séléctionner votre page</h2>
    <div class="slider-select">
        <form id="form_slider" action="" method="POST" enctype="multipart/form-data">
            <select name="pages">
                <option value="">--Selectionner une page--</option>
                <?php foreach (get_pages_array() as $row) : ?>
                    <option value="<?= $row->id ?>" <?php if (isset($_SESSION['page_id']) && $_SESSION['page_id'] === $row->id) {
                                                        echo "selected";
                                                    }; ?>>
                        <?= $row->post_title ?>
                    </option>

                <?php endforeach; ?>
            </select>
            <button class="slider-input" type='submit' name="Show">show</button>
        </form>
    </div>
    <?php
    if ((isset($_POST['title'])) && (isset($_POST['link'])) && (isset($_FILES['image']['name']))) {
        //INSERT de nouvelles données dans la table mrl_sliders
        sql_insert_sliders($_SESSION['page_id']);

        //INSERT de nouvelles données dans la table mrl_slides
        sql_insert_slides($_SESSION['page_id'], $_POST['title'], $_FILES['image']['name'], $_POST['link']);

        //IMAGE
        if (save_image()) {
            echo "image sauvegardée";
        } else {
            echo "Un problème est survenu";
        }
    }
    if (isset($_POST['delete'])) {
        slide_delete($_POST['delete']);
    }

    ?>
    <?php if (isset($_SESSION['page_id'])) : ?>

        <form id="form_add" action="" method="POST" enctype="multipart/form-data">
            <fieldset class="slide-fieldset">
                <legend>Creez votre slide</legend>
                <p><label for="title">titre du slide </label><input type="text" name="title" required></p>
                <p><label for="link">lien du slide </label><input type="text" name="link" required></p>
                <p><label for="image">Image du slide </label><input type="file" name='image' required></p>
                <p><label for="add">Ajouter slide</label><button class="slider-input" type="submit" name="Add">add</button></p>
            </fieldset>
        </form>


        <h2>Listes des slides ajoutés</h2>
        <?php foreach (display_slides($_SESSION['page_id']) as $row) : ?>

            <div class="slider-display">
                <p><b>titre : </b><?= $row->title ?></p>
                <p><b>lien du slide : </b><?= $row->link ?></p>
                <img class="slider-image" src="<?= $row->image ?> " alt="<?= "titre de l'image : " . $row->title ?>">
                <form id="form_delete" action="" method="POST" enctype="multipart/form-data">
                    <button class="slider-input slider-input-delete" type="submit" name="delete" value="<?= $row->id ?>">Supprimer</button>
                </form>
            </div>

        <?php
        endforeach; ?>

    <?php endif;
    echo "</body>";
