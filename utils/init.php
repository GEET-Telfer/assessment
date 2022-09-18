<?php

function init_table( $schema ): void {
	global $wpdb;
	$charset = $wpdb->get_charset_collate();
	$schema  = $schema . $charset . ";";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $schema );
}

/**
 * @return void
 */
function init_table_assessment(): void {
	global $wpdb;
	$tableName = $wpdb->prefix . "assessment";

	$schema = "CREATE TABLE IF NOT EXISTS " . $tableName . "(
		id  INT UNSIGNED AUTO_INCREMENT,
		component VARCHAR(255) NOT NULL, 
		description VARCHAR(255) NOT NULL,
		illustrative_metric VARCHAR(255) NOT NULL,
		scoring TINYINT NOT NULL,
		PRIMARY KEY (id)
	) ";

	init_table( $schema );
}


/**
 * @return void
 */
function init_table_user_response(): void {
	global $wpdb;
	$tableName = $wpdb->prefix . "user_response";

	$schema = "CREATE TABLE IF NOT EXISTS " . $tableName . "(
		id INT UNSIGNED AUTO_INCREMENT,
		user_email VARCHAR(255),
		responses TEXT,
		score ENUM('low', 'some', 'moderate', 'high'),
		PRIMARY KEY (id)
	) ";

	init_table( $schema );
}


/**
 * @return void
 */
function init_table_team(): void {
	global $wpdb;
	$tableName = $wpdb->prefix . "team";

	$schema = "CREATE TABLE IF NOT EXISTS " . $tableName . "(
		id TINYINT UNSIGNED AUTO_INCREMENT,
		user_email VARCHAR(255),
		access_token TEXT,
		access_level ENUM('developer', 'researcher', 'administration', 'regular'),
		verified BOOLEAN NOT NULL,
		PRIMARY KEY (id)
	) ";
	init_table( $schema );
}


