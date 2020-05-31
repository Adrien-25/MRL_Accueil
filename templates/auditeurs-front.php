<?php
$db = dbConnect();
$req = $db-> query('SELECT nom, ville, img FROM auditeurs_membres ORDER BY RAND() LIMIT 4') ;
?>
<div class="">
        <img src="<?= plugin_dir_url( dirname( __FILE__) ).'assets/Images/Auditeurs/Fond_jp.jpg'?>" alt="BEST OF 1">
        <div class="auditeurs-row">
                <?php while ( $data = $req->fetch(PDO::FETCH_ASSOC) ){ ?>
                        <div class="auditeurs-col-3">
                                <?= '<img src="data:image/jpeg;base64,'.base64_encode( $data['img'] ).'"/>' ?>
                                <div class="don-txt"><?= htmlspecialchars(utf8_encode($data['nom'] . '(' . $data['ville'] . ')')) ?></div>
                        </div>
                <?php }?>
        </div>
</div>