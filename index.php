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
define( 'WP_DEBUG_DISPLAY', false );
define('WP_ENVIRONMENT_TYPE', "development");

require_once( 'utils/init_db.php' ); // initialize required database tables if it hasn't been created yet.
register_activation_hook( __FILE__, 'init_table_assessment' );
register_activation_hook( __FILE__, 'init_table_user_response' );
register_activation_hook( __FILE__, 'init_table_team' );
register_activation_hook(__FILE__, 'init_table_course');

// RESTful endpoints
require_once("utils/router/AssessmentRouter.php");
require_once("utils/router/UserResponseRouter.php");
require_once("utils/router/CourseRouter.php");

// Assessment Controllers
require_once('src/controller/AssessmentController.php');
add_action( 'wp_ajax_create_assessment_question', 'createAssessmentQuestion' );
add_action( 'wp_ajax_find_all_assessment_question', 'findAllAssessmentQuestion' );
add_action( 'wp_ajax_delete_assessment_question', 'deleteAssessmentQuestion' );
add_action( 'wp_ajax_update_assessment_question', 'updateAssessmentQuestion' );
add_action( 'wp_ajax_find_all_assessment_question_for_admin', 'findAllAssessmentQuestion4Admin');

// User Response Controller
require_once('src/controller/UserResponseController.php');
add_action( 'wp_ajax_create_user_response', 'createUserResponse' );
add_action( 'wp_ajax_find_all_user_response', 'findAllUserResponse' );

// Course Controllers
require_once('src/controller/CourseController.php');
add_action( 'wp_ajax_create_course', 'createCourse');
add_action( 'wp_ajax_find_all_course', 'findAllCourse');
add_action( 'wp_ajax_delete_course', 'deleteCourse');
add_action( 'wp_ajax_update_course', 'updateCourse');
add_action( 'wp_ajax_find_course_by_id', 'findCourseById');
add_action( 'wp_ajax_find_course_by_id_for_admin', 'findCourseById4Admin');
add_action( 'wp_ajax_find_all_course_for_admin', 'findAllCourse4Admin');


// require_once( 'utils/admin_ui.php' );
// add_action( "init", "admin_assessment_ui" ); // initiate assessment plugin ui in admin dashboard
// add_action( "admin_init", "CreateAssessmentDetails" ); // create form to save assessment question
// add_action( "admin_init", "findAllAssessmentDetails" ); // create form to save assessment question

