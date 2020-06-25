<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Base;

use \Accueil\API\SettingsApi;
use \Accueil\Base\BaseController;
use \Accueil\API\Callbacks\AdminCallbacks;

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
    
        echo "<link rel=\"stylesheet\"  href=\"$this->plugin_url/assets/css/mrlslider.css\"></link>";

        require_once( "$this->plugin_path/templates/slider-front.php" );

        echo "<script src=\"$this->plugin_url/assets/js/mrlslider.js\"></script>";

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

