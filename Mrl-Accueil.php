<?php
/**
 * @package MRLAccueil
 */

/*
Plugin Name: MRL Accueil
Description: Gestion de la page d'accueil.
Version: 1.0.0
Author: MRL
*/

use Accueil\Base;
use Accueil\Base\Activate;
use Accueil\Base\Deactivate;

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
    Activate::activate();
}
register_activation_hook( __FILE__, 'activate_mrl_accueil' );

function deactivate_mrl_accueil(){
    Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_mrl_accueil' );


//initialisation du Plugin
if (class_exists( 'Accueil\\Init' ) ) {
    \Accueil\Init::register_services();
}
