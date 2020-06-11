<?php
/**
 * @package MRLAccueil
 * 
 * On récupère les différent templates correspondant aux sous-pages du menu MRL Accueil
 * dans le Dashboard
 */

namespace Accueil\API\Callbacks;

use \Accueil\Base\BaseController;

class AdminCallbacks extends BaseController
{
    //Récupération de l'accueil
    public function adminDashboard(){
        return require_once( "$this->plugin_path/templates/admin.php");
    }

    public function adminAuditeurs(){
        return require_once( "$this->plugin_path/templates/auditeurs.php");
    }

    public function adminBougeotte(){
        return require_once( "$this->plugin_path/templates/bougeotte.php");
    }
    public function adminBoutique(){
        return require_once( "$this->plugin_path/templates/boutique.php");
    }
    public function adminCaa(){
        return require_once( "$this->plugin_path/templates/caa.php");
    }
    public function adminDernierPodcast(){
        return require_once( "$this->plugin_path/templates/dernierpodcast.php");
    }
    public function adminDons(){
        return require_once( "$this->plugin_path/templates/dons.php");
    }
    public function adminIllustrations(){
        return require_once( "$this->plugin_path/templates/illustrations.php");
    }

    public function adminParticipeEcoute(){
        return require_once( "$this->plugin_path/templates/participeecoute.php");
    }

    public function adminSeptemTrionis(){
        return require_once( "$this->plugin_path/templates/septemtrionis.php");
    }

    public function adminSlider(){
        return require_once( "$this->plugin_path/templates/slider.php");
    }

    public function adminTetaisLa(){
        return require_once( "$this->plugin_path/templates/tetaisla.php");
    }

    public function youtubeDashboard(){
        return require_once( "$this->plugin_path/templates/youtube.php");
    }
    

    public function bibiOptionsGroup( $input ){
        return $input;
    }

    public function bibiAdminSection(){
        echo "hello";
    }
}
