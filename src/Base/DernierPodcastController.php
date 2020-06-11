<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Base;

use \Accueil\API\SettingsApi;
use \Accueil\Base\BaseController;
use \Accueil\API\Callbacks\AdminCallbacks;

class DernierPodcastController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'dernier_podcast_accueil' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();

        add_shortcode( 'dernierpodcast-front', [$this, 'dernierpodcast_front'] );
    }

    public function dernierpodcast_front()
    {
        ob_start();

        echo "<link rel=\"stylesheet\"  href=\"$this->plugin_url/assets/mrldernierpodcast.css\"></link>";

        require_once( "$this->plugin_path/templates/dernierpodcast-front.php" );

        return ob_get_clean();

    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_plugin',
                'page_title' => 'Dernier Podcast',
                'menu_title' => 'Dernier Podcast',
                'capability' => 'manage_options',
                'menu_slug' => 'dernier_podcast_accueil',
                'callback' => [$this->callbacks, 'adminDernierPodcast']
            ]
        ];
    }
}