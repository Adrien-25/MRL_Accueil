<?php
/**
 * @package MRLAccueil
 */

namespace Inc\API\Callbacks;

use \Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
    public function checkboxSanitize( $input ){
        $output = [];

        foreach ( $this->managers_admin as $key => $value ) {
        $output[$key] = isset($input[$key]) ? true : false;
        }

        return $output;
    }

    public function adminSectionManager(){
        echo "Cochez les sections qui vous intéresse pour les activer";
    }

    public function checkboxField( $args ){
        $option_name = $args[0]['option_name'];
        $name = $args[0]['label_for'];
        $classes = $args[0]['class'];
        $checkbox = get_option($option_name);
        $checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;
        echo '<input type="checkbox" id="'. $name . '" name="' . $option_name . '[' . $name . ']' . '" value="1" class="' . $classes . '" ' . ($checked ? 'checked' : '' ) . '>';
    }
}