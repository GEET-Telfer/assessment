<?php
/*
 * Plugin Name: GEET+ Database Initialization
 * Description: Database Table loader
 * Version: 1.0
 * Author: Puck Wang
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}
require_once( 'utils/init_db.php' ); // initialize required database tables if it hasn't been created yet.
register_activation_hook( __FILE__, 'init_table_assessment' );
register_activation_hook( __FILE__, 'init_table_user_response' );
register_activation_hook( __FILE__, 'init_table_team' );

require_once( 'utils/rest_config.php' ); // define RESTful endpoints for Assessment Question

require_once('src/controller/AssessmentController.php');
add_action( 'wp_ajax_create_assessment_question', 'createAssessmentQuestion' );
add_action( 'wp_ajax_find_all_assessment_question', 'findAllAssessmentQuestion' );

require_once('src/controller/UserResponseController.php');
add_action( 'wp_ajax_create_user_response', 'createUserResponse' );

require_once( 'utils/admin_ui.php' );
add_action( "init", "admin_assessment_ui" ); // initiate assessment plugin ui in admin dashboard
add_action( "admin_init", "CreateAssessmentDetails" ); // create form to save assessment question
add_action( "admin_init", "findAllAssessmentDetails" ); // create form to save assessment question