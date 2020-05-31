<div class="wrap">
    <h1>Bibi Plugin</h1>
    <?php settings_errors()?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-1">Manage Settings</a></li>
        <li><a href="#tab-2">ShortCodes</a></li>
        <li><a href="#tab-3">About</a></li>
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <form method="POST" action="options.php">
                <?php
                    settings_fields( 'mrl_plugin_settings' );
                    do_settings_sections( 'mrl_plugin' );
                    submit_button();
                ?>
            </form>
        </div>
        <div id="tab-2" class="tab-pane">
            <h3>ShortCodes</h3>
            <h6>Copier/Coller le code de la section voulu pour pouvoir l'afficher sur la page</h6>
            <div>
                <p>Accueil Slider: </br>[slider-front]</p>
                <p>Accueil sur Youtube: </br>[video-front]</p>
                <p>Accueil Participe et Écoute: </br>[participeecoute-front]</p>
                <p>Accueil T'Étais là: </br>[tetaisla-front]</p>
                <p>Accueil Bravo pour Vos Dons: </br>[dons-front]</p>
                <p>Accueil SEPTEM TRIONIS: </br>[septemtrionis-front]</p>
                <p>Accueil Dernier Podcast: </br>[dernierpodcast-front]</p>
                <p>Accueil Caa: </br>[caa-front]</p>
                <p>Accueil Auditeurs: </br>[auditeurs-front]</p>
                <p>Accueil Bougeotte: </br>[bougeotte-front]</p>
                <p>Accueil Illustrations: </br>[illustrations-front]</p>
                <p>Accueil Boutique: </br>[boutique-front]</p>
            </div>
        </div>
        <div id="tab-3" class="tab-pane">
            <h3>About</h3>
        </div>
    </div>
</div>
