<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Base;

use \Accueil\Base\BaseController;

class SettingsLink extends BaseController
{

    public function register(){
        add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
    }

    public function settings_link( $links ){
        $settings_link = '<a href="admin.php?page=bibi_plugin">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }
}