<?php
/**
 * @package MRLAccueil
 */

namespace Inc\Base;

use \Inc\API\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\API\Callbacks\AdminCallbacks;

class ParticipeEcouteController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'participe_ecoute_accueil' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();

        add_shortcode( 'participeecoute-front', [$this, 'participeecoute_front'] );
    }

    public function participeecoute_front()
    {
        ob_start();

        echo "<link rel=\"stylesheet\"  href=\"$this->plugin_url/assets/mrlparticipeecoute.css\"></link>";

        require_once( "$this->plugin_path/templates/participeecoute-front.php" );

        return ob_get_clean();

    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_plugin',
                'page_title' => 'Participe / Écoute',
                'menu_title' => 'Participe / Écoute',
                'capability' => 'manage_options',
                'menu_slug' => 'participe_ecoute_accueil',
                'callback' => [$this->callbacks, 'adminParticipeEcoute']
            ]
        ];
    }
}