<?php
/**
 * @package MRLAccueil
 * 
 * Ici on a tous les callbacks appelé dans les fichiers contrôleur du dossier Base, représentant des pages et/ou sous pages affiché dans le tableau de bord.
 * Chaque fonction reprèsente un template correspondant aux pages/sous-pages lié au tableau de bord.
 */

namespace Accueil\API\Callbacks;

use \Accueil\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard(){
        return require_once( "$this->plugin_path/templates/admin/admin.php");
    }

    public function adminAuditeurs(){
        return require_once( "$this->plugin_path/templates/admin/auditeurs.php");
    }

    public function adminBougeotte(){
        return require_once( "$this->plugin_path/templates/admin/bougeotte.php");
    }
    public function adminBoutique(){
        return require_once( "$this->plugin_path/templates/admin/boutique.php");
    }
    public function adminCaa(){
        return require_once( "$this->plugin_path/templates/admin/caa.php");
    }
    public function adminDernierPodcast(){
        return require_once( "$this->plugin_path/templates/admin/dernierpodcast.php");
    }
    public function adminDons(){
        return require_once( "$this->plugin_path/templates/admin/dons.php");
    }
    public function adminIllustrations(){
        return require_once( "$this->plugin_path/templates/admin/illustrations.php");
    }

    public function adminParticipeEcoute(){
        return require_once( "$this->plugin_path/templates/admin/participeecoute.php");
    }

    public function adminSeptemTrionis(){
        return require_once( "$this->plugin_path/templates/admin/septemtrionis.php");
    }

    public function adminSlider(){
        return require_once( "$this->plugin_path/templates/admin/slider.php");
    }

    public function adminTetaisLa(){
        return require_once( "$this->plugin_path/templates/admin/tetaisla.php");
    }

    public function youtubeDashboard(){
        return require_once( "$this->plugin_path/templates/admin/youtube.php");
    }
    

    public function bibiOptionsGroup( $input ){
        return $input;
    }

    public function bibiAdminSection(){
        echo "hello";
    }
}
