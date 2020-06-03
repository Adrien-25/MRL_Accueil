<?php

use \Inc\Base\DataBase;
$req = DataBase::auditeurs_query();
?>
<div class="">
        <img src="<?= plugin_dir_url( dirname( __FILE__) ).'assets/Images/Auditeurs/Fond_jp.jpg'?>" alt="BEST OF 1">
        <div class="auditeurs-row">
                <?php while ( ($data = $req->fetch()) != false ): ?>
                        <div class="auditeurs-col-3">
                                <?= '<img src="data:image/jpeg;base64,'.base64_encode( $data['image'] ).'"/>' ?>
                                <div class="don-txt"><?= htmlspecialchars(utf8_encode($data['nom'] . '(' . $data['ville'] . ')')) ?></div>
                        </div>
                <?php endwhile?>
        </div>
</div>