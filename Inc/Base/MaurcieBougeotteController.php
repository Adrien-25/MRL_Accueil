<?php
/**
 * @package MRLAccueil
 */

namespace Inc\Base;

use \Inc\API\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\API\Callbacks\AdminCallbacks;

class MaurcieBougeotteController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'maurice_bougeotte_accueil' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();

        add_shortcode( 'bougeotte-front', [$this, 'bougeotte_front'] );
    }

    public function bougeotte_front()
    {
        ob_start();

        echo "<link rel=\"stylesheet\"  href=\"$this->plugin_url/assets/mrlbougeotte.css\"></link>";

        require_once( "$this->plugin_path/templates/bougeotte-front.php" );

        return ob_get_clean();

    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_plugin',
                'page_title' => 'Maurice Bougeotte',
                'menu_title' => 'Maurice Bougeotte',
                'capability' => 'manage_options',
                'menu_slug' => 'maurice_bougeotte_accueil',
                'callback' => [$this->callbacks, 'adminBougeotte']
            ]
        ];
    }
}