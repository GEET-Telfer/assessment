<?php
/*
 * Plugin Name: Custom Database Initialization
 * Description: Database Table loader
 * Version: 1.0
 * Author: Puck Wang
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}
require_once( 'init.php' ); // initialize required database tables if it hasn't been created yet.
register_activation_hook( __FILE__, 'init_table_assessment' );
register_activation_hook( __FILE__, 'init_table_user_response' );
register_activation_hook( __FILE__, 'init_table_team' );


require_once( 'includes/controller/AssessmentController.php' );
add_action( 'wp_ajax_create_assessment_question', 'createAssessmentQuestion' );
add_action( 'wp_ajax_update_assessment_question', 'updateAssessmentQuestion' );
add_action( 'wp_ajax_delete_assessment_question', 'deleteAssessmentQuestion' );

// TODO: add plugin interface