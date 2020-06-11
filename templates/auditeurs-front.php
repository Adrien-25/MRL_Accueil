<?php

use \Accueil\Base\DataBase;
$req = DataBase::auditeurs_query();
$id = [
        'img1',
        'img2',
        'img3',
        'img4'
];
$i=0;
?>
<div class="">
        <img src="<?= plugin_dir_url( dirname( __FILE__) ).'assets/Images/Auditeurs/Fond_jp.jpg'?>" alt="BEST OF 1">
        <div class="auditeurs-row">
                <?php while ( ($data = $req->fetch()) != false ): ?>
                        <div id="<?= $id[$i] ?>" class="auditeurs-col-3">
                                <?= '<img src="data:image/jpeg;base64,'.base64_encode( $data['image'] ).'"/>' ?>
                                <div class="don-txt"><?= htmlspecialchars(utf8_encode($data['nom'] )) ?></div>
                        </div>
                <?php
                        $i++;
                        endwhile
                ?>
        </div>
</div>