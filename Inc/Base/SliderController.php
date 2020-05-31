<?php
/**
 * @package MRLAccueil
 */

namespace Inc\Base;

use \Inc\API\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\API\Callbacks\AdminCallbacks;

class SliderController extends BaseController
{
    public $settings;
    public $callbacks;
    public $subpages = array();

    public $custom_post_types = [];

    public function register()
    {
        
        if ( ! $this->activated( 'slider_accueil' ) ) return;

        $this->callbacks = new AdminCallbacks;
        $this->settings = new SettingsApi;
        $this->setSubpages();
        $this->settings->addSubPages($this->subpages)->register();

        add_shortcode( 'slider-front', [$this, 'slider_front'] );
    }

    public function slider_front()
    {
        ob_start();
    
        echo "<link rel=\"stylesheet\"  href=\"$this->plugin_url/assets/mrlslider.css\"></link>";

        require_once( "$this->plugin_path/templates/slider-front.php" );

        return ob_get_clean();

    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'mrl_plugin',
                'page_title' => 'Slider',
                'menu_title' => 'Slider',
                'capability' => 'manage_options',
                'menu_slug' => 'slider_accueil',
                'callback' => [$this->callbacks, 'adminSlider']
            ]
        ];
    }
}