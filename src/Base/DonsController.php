<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Base;

use \Accueil\API\SettingsApi;
use \Accueil\Base\BaseController;
use \Accueil\API\Callbacks\AdminCallbacks;

class DonsController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'bravo_dons_accueil' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();

        add_shortcode( 'dons-front', [$this, 'dons_front'] );
    }

    public function dons_front()
    {

        ob_start();
        
        echo "<link rel=\"stylesheet\"  href=\"$this->plugin_url/assets/mrldons.css\"></link>";

        require_once( "$this->plugin_path/templates/dons-front.php" );

        return ob_get_clean();

    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_plugin',
                'page_title' => 'Bravo Don',
                'menu_title' => 'Bravo Don',
                'capability' => 'manage_options',
                'menu_slug' => 'bravo_dons_accueil',
                'callback' => [$this->callbacks, 'adminDons']
            ]
        ];
    }
}