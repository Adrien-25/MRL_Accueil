<?php
/**
 * @package MRLAccueil
 */

namespace Inc\Base;

use \Inc\API\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\API\Callbacks\AdminCallbacks;

class TetaisLaController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'tetais_la_accueil' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();

        add_shortcode( 'tetaisla-front', [$this, 'tetaisla_front'] );
    }

    public function tetaisla_front()
    {
        ob_start();

        echo "<link rel=\"stylesheet\"  href=\"$this->plugin_url/assets/mrltetaisla.css\"></link>";

        require_once( "$this->plugin_path/templates/tetaisla-front.php" );

        return ob_get_clean();

    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_plugin',
                'page_title' => 'T\'étais Là',
                'menu_title' => 'T\'étais Là',
                'capability' => 'manage_options',
                'menu_slug' => 'tetais_la_accueil',
                'callback' => [$this->callbacks, 'adminTetaisLa']
            ]
        ];
    }
}