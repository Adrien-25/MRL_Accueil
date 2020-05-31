<?php
/**
 * @package MRLAccueil
 */

namespace Inc\Base;

use \Inc\API\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\API\Callbacks\AdminCallbacks;

class AuditeursController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'auditeurs_acceuil' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();

        add_shortcode( 'auditeurs-front', [$this, 'auditeurs_front'] );
    }

    public function auditeurs_front()
    {
        ob_start();

        echo "<link rel=\"stylesheet\"  href=\"$this->plugin_url/assets/mrlauditeurs.css\"></link>";

        require_once( "$this->plugin_path/templates/auditeurs-front.php" );

        return ob_get_clean();

    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_plugin',
                'page_title' => 'Les Auditeurs',
                'menu_title' => 'Les Auditeurs',
                'capability' => 'manage_options',
                'menu_slug' => 'auditeurs_acceuil',
                'callback' => [$this->callbacks, 'adminAuditeurs']
            ]
        ];
    }
}