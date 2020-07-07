<?php

	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'slide_list';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		slide_id int NOT NULL AUTO_INCREMENT,
		slide_title VARCHAR(50) NOT NULL,
		slide_link VARCHAR(255) NOT NULL,
		slide_image VARCHAR(255) NOT NULL,
        slide_page_link VARCHAR(50) NOT NULL ,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );


// function jal_install_data() {
// 	global $wpdb;
	
// 	$welcome_name = 'Mr. WordPress';
// 	$welcome_text = 'Congratulations, you just completed the installation!';
	
// 	$table_name = $wpdb->prefix . 'liveshoutbox';
	
// 	$wpdb->insert( 
// 		$table_name, 
// 		array( 
// 			'time' => current_time( 'mysql' ), 
// 			'name' => $welcome_name, 
// 			'text' => $welcome_text, 
// 		) 
// 	);
// }