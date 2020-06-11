<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Accueil\Base;

class Activate
{
    public static function activate(){
        flush_rewrite_rules();
        
        var_dump(__METHOD__);

        if (get_option( 'mrl_plugin' )){
            return;
        }

        $default = [];

        update_option( 'mrl_plugin', $default);
    }
}