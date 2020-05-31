<?php
/**
 * @package MRLAccueil
 */

/*
Plugin Name: MRL Accueil
Description: Test for create a plugin.
Version: 1.0.0
Author: Axel
*/

//check si le plugin est utilisé par wordpress
if( ! defined('ABSPATH') ){
    die( "You're wrong" );
}

//check si l'autoload est ne place pour les namespace
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


//activation et deactivation du plugin

function activate_mrl_accueil(){
    Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_mrl_accueil' );

function deactivate_mrl_accueil(){
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_mrl_accueil' );


//initialisation du Plugin
if (class_exists( 'Inc\\Init' ) ) {
    Inc\Init::register_services();
}
