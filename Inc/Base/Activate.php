<?php
/**
 * @package MRLAccueil
 */

namespace Inc\Base;

class Activate
{
    public static function activate(){
        flush_rewrite_rules();

        if (get_option( 'mrl_plugin' )){
            return;
        }

        $default = [];

        update_option( 'mrl_plugin', $default);
    }
}