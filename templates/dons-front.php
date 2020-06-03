<?php 

use \Inc\Base\DataBase;
$req = DataBase::dons_query();

?>
<div class="dons-container">
        <img src="<?= plugin_dir_url( dirname( __FILE__) ).'assets/Images/Dons/Fond_Don_jp.jpg'?>" alt="">
        <div class="dons-position-txt">
                <?php while ( $data = $req->fetch() ): ?>
                        <div class="don-img-txt">
                                <div class="don-img"><img src="<?= plugin_dir_url( dirname( __FILE__) ).'assets/Images/Dons/moto.png'?>" alt=""></div>
                                <div class="don-txt"><?= htmlspecialchars(utf8_encode($data['nom'] . '(' . $data['ville'] . ')')) ?></div>
                        </div>
                <?php endwhile?>
        </div>
</div>