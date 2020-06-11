<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Base;

use \Accueil\API\SettingsApi;
use \Accueil\Base\BaseController;
use \Accueil\API\Callbacks\AdminCallbacks;

class BoutiqueController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'boutique_accueil' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();

        add_shortcode( 'boutique-front', [$this, 'boutique_front'] );
    }

    public function boutique_front()
    {
        ob_start();

        echo "<link rel=\"stylesheet\"  href=\"$this->plugin_url/assets/mrlboutique.css\"></link>";

        require_once( "$this->plugin_path/templates/boutique-front.php" );

        // echo "<script src=\"$this->plugin_url/assets/mrlboutique.js\"></script>";

        return ob_get_clean();

    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_plugin',
                'page_title' => 'Boutique',
                'menu_title' => 'Boutique',
                'capability' => 'manage_options',
                'menu_slug' => 'boutique_accueil',
                'callback' => [$this->callbacks, 'adminBoutique']
            ]
        ];
    }
}