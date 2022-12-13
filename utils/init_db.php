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

	dropTableIfExists($tableName);

	$schema = "CREATE TABLE IF NOT EXISTS " . $tableName . "(
		id  INT UNSIGNED AUTO_INCREMENT,
		uuid VARCHAR(255) NOT NULL,
		component VARCHAR(255) NOT NULL, 
		component_abbrev VARCHAR(255) NOT NULL,
		description VARCHAR(255) NOT NULL,
		has_NA BOOLEAN NOT NULL DEFAULT FALSE,
		scoring TINYINT NOT NULL DEFAULT 5,
		question_status ENUM('draft', 'under_review', 'publish') NOT NULL DEFAULT 'draft',
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

	dropTableIfExists($tableName);

	$schema = "CREATE TABLE IF NOT EXISTS " . $tableName . "(
		id INT UNSIGNED AUTO_INCREMENT,
		user_email VARCHAR(255) NOT NULL,
		responses TEXT,
		score DECIMAL(13,2) NOT NULL DEFAULT 0.00,
		report TEXT,
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

	dropTableIfExists($tableName);

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


function init_table_course() : void {
	global $wpdb;
	$tableName = $wpdb->prefix . "course";

	dropTableIfExists($tableName);

	$schema = "CREATE TABLE IF NOT EXISTS " . $tableName . "(
		id TINYINT UNSIGNED AUTO_INCREMENT,
		uuid VARCHAR(255) NOT NULL,
		title VARCHAR(255) NOT NULL DEFAULT '',
		video_link VARCHAR(255) NOT NULL DEFAULT '',
		content TEXT NOT NULL DEFAULT '',
		course_status ENUM('draft', 'under_review', 'publish') DEFAULT 'draft',
		PRIMARY KEY(id)	
	)";
	
	init_table($schema);
}

/**
 * Drop table if exists in non-production environment.
 * Note: By re-activating this plugin, it will drop all the tables
 * used in this plugin.
 * @param $tableName
 * @return void
 */
function dropTableIfExists($tableName): void {
	global $wpdb;
	if(WP_ENVIRONMENT_TYPE != "production") {
		$sql = "DROP TABLE IF EXISTS " . $tableName;
		$wpdb->query( $sql );
	}
}

