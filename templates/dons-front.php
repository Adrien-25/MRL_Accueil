<?php 
function dbConnect(){ 
        try
        {
                $db = new PDO('mysql:host=localhost;dbname=wordpress4', 'root', 'toto');
                return $db;
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
        }
}

$db = dbConnect();
$req = $db-> query('SELECT nom, ville FROM auditeurs_membres ORDER BY RAND() LIMIT 3') ;

?>
<div class="dons-container">
        <img src="<?= plugin_dir_url( dirname( __FILE__) ).'assets/Images/Dons/Fond_Don_jp.jpg'?>" alt="">
        <div class="dons-position-txt">
        <?php while ( $data = $req->fetch(PDO::FETCH_ASSOC) ){ ?>
                <div class="don-img-txt">
                        <div class="don-img"><img src="<?= plugin_dir_url( dirname( __FILE__) ).'assets/Images/Dons/moto.png'?>" alt=""></div>
                        <div class="don-txt"><?= htmlspecialchars(utf8_encode($data['nom'] . '(' . $data['ville'] . ')')) ?></div>
                </div>
                <?php }?>
        </div>
</div>