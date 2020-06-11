<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Base;

use \Accueil\Base\BaseController;

class Enqueue extends BaseController
{

    public function register(){
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );//send the js and css
        add_action( 'wp_ajax_myprefix_get_image', 'myprefix_get_image'   );
        add_action( 'wp_enqueue_scripts', [$this, 'boutique_link']);
        add_action( 'wp_enqueue_scripts', [$this, 'slider_link']);
    }

    function boutique_link(){
        wp_enqueue_script( 'mrlboutique', $this->plugin_url . 'assets/mrlboutique.js', '', '', true );
        wp_localize_script( 'mrlboutique', 'script_params', ['myPrefixLink' => get_option('myprefix_link')] );
    }

    function slider_link(){
        wp_enqueue_script( 'mrlslider', $this->plugin_url . 'assets/mrlslider.js', '', '', true );
    }

    function enqueue(){
        wp_enqueue_style('mrlstyle', $this->plugin_url . 'assets/mrlstyle.css', __FILE__ );
        wp_enqueue_script('script', $this->plugin_url . 'assets/script.js', __FILE__ );
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_media();
        wp_localize_script( 'script', 'script_params', ['myPrefixLink' => get_option('myprefix_link')] );
        
    }

    function myprefix_get_image() {
        if(isset($_GET['id']) ){
            $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'myprefix-preview-image' ) );
            $data = array(
                'image'    => $image,
            );
            wp_send_json_success( $data );
        } else {
            wp_send_json_error();
        }
    }
}