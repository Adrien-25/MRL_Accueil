<?php

/**
 * Trigger this file on Plugin uninstall
 * 
 * @package MRLAccueil
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ){
    die;
}

// Clear database stored data

$books = get_posts( ['post_type' => 'book', 'numberposts' => -1] );

foreach( $books as $book){
    wp_delete_post( $book->ID, true );
}