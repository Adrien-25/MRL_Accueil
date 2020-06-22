<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Base;

use \Accueil\API\SettingsApi;
use \Accueil\Base\BaseController;
use \Accueil\API\Callbacks\AdminCallbacks;

class IllustrationController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'illustration_accueil' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();

        add_shortcode( 'illustrations-front', [$this, 'illustrations_front'] );
    }

    public function illustrations_front()
    {
        ob_start();

        echo "<link rel=\"stylesheet\"  href=\"$this->plugin_url/assets/css/mrlillustrations.css\"></link>";

        require_once( "$this->plugin_path/templates/illustrations-front.php" );

        return ob_get_clean();

    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_plugin',
                'page_title' => 'Video Youtube',
                'menu_title' => 'Video Youtube',
                'capability' => 'manage_options',
                'menu_slug' => 'illustration_accueil',
                'callback' => [$this->callbacks, 'adminIllustrations']
            ]
        ];
    }
}