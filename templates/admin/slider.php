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
            <option value="<?= $row->id ?>" <?php if (isset($_SESSION['page_id']) && $_SESSION['page_id'] === $row->id) {
                                                echo "selected";
                                            }; ?>>
                <?= $row->post_title ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type='submit' name="show">show</button>
</form> 

<?php if (((isset($_POST['pages'])) || (isset($_SESSION['page_id'])))) : ?>
<form id="form_add" action="" method="POST" enctype="multipart/form-data">
    

        <p>titre du slide :<input type="text" name="title" required></p>
        <p>lien du slide : <input type="text" name="link" required></p>
        <p>Image du slider :<input type="file" name='image' required></p>

        <p><button type="submit" name="add">add</button></p>

        <?php foreach ($slide_display as $row) : ?>
            <div style="display:inline-block">
                <div style="border:1px solid; margin:5px ;width:200px;height:auto">
                    <span>X</span>
                    <p><b>id : </b><?= $row->id ?></p>
                    <p><b>titre : </b><?= $row->title ?></p>
                    <p><b>lien du slide : </b><?= $row->link ?></p>
                    <p><img style="width:200px ; height:80px" src="<?= $row->image ?>"></p>
                </div>
            </div>
        <?php endforeach; ?>

</form>
<?php endif; ?>