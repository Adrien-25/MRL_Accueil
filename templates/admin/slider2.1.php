<?php
require_once "slider_control.php";
global $wpdb;
if (isset($_POST['pages'])) {
    $_SESSION['page_id'] = $_POST['pages'];
}

    


?>

<form id="form_slider" action="" method="POST" enctype="multipart/form-data">
    <select name="pages">
        <option value="">--Selectionner une page--</option>
        <?php foreach ($select_page as $row) : ?>
            <option value="<?= $row->id ?>" <?php
                                            if (isset($_SESSION['page_id']) && $_SESSION['page_id'] === $row->id) {
                                                echo "selected";

                                            };
                                            ?>>
                <?=  $row->post_title ?>
            </option>

        <?php endforeach; ?>
    </select>

    <?php if(!isset($_POST['pages'])){
    echo "<button type='submit'>show</button>";
    }?>

    <?php if(isset($_POST['pages']) || (isset($_SESSION['page_id']))) : ?>

        <p>titre du slide :
            <span><input type="text" name="title" required></span></p>
        <p>lien du slide :
            <span><input type="text" name="link" required></span></p>
        <p>Image du slider :
            <span><input type="file" name='image' required></span></p>
        <p>
            <span><button type="submit">add</button></span></p>
            

        <div style="display:inline-block">
            <div style="border:1px solid; margin:5px ;width:200px;height:auto">
                <span>X</span>
                <?php foreach ($slide_display as $row) : ?>
                    <p><b>id : </b><?= $row->id ?></p>
                    <p><b>titre : </b><?= $row->title ?></p>
                    <!-- <p><b>lien du slide : </b><?= $row->link ?></p> -->
                    <p><img style="width:200px ; height:80px" src="<?= $row->image ?>"></p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</form>