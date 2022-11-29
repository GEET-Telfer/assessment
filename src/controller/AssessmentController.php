<?php
// declare( strict_types=1 );
// ini_set( 'display_errors', '1' );
// ini_set( 'display_startup_errors', '1' );
// error_reporting( E_ALL );

require_once( dirname( __FILE__ ) . "/../service/AssessmentService.php" );
require_once( dirname( __FILE__ ) . "/../constant/constant.php" );

/**
 * Create assessment question from post data.
 * @return void
 */
function createAssessmentQuestion(): void {
	try {
		if ( ! isset( $_POST ) ) {
			throw new Exception( "Invalid Request Method", METHOD_NOT_ALLOWED );
		}
		$_POST = json_decode(file_get_contents("php://input"),true);
		$result = AssessmentService::createAssessmentQuestion( $_POST['data'] );
    
		if($result) {
			wp_send_json_success();
		} else {
			throw new Exception("Something wrong with the server.", INTERNAL_SERVER_ERROR);
		}
	} catch ( Exception $e ) {
		wp_send_json_error( $e->getMessage(), $e->getCode() );
	} finally {
		global $wpdb;
		$wpdb->close();
	}
}

/**
 * Update assessment question content.
 * @return void
 */
function updateAssessmentQuestion() {
	try {
		if ( ! isset( $_POST ) ) {
			throw new Exception( "Invalid Request Method", METHOD_NOT_ALLOWED );
		}
		$_POST = json_decode(file_get_contents("php://input"),true);
		$result = AssessmentService::updateAssessmentQuestion( $_POST['data'] );
		if($result) {
			wp_send_json_success();
		} else {
			throw new Exception("Something wrong with the server.", INTERNAL_SERVER_ERROR);
		}
	} catch ( Exception $e ) {
		wp_send_json_error( $e->getMessage(), $e->getCode() );
	} finally {
		global $wpdb;
		$wpdb->close();
	}
}

/**
 * Hard delete assessment question on given question id.
 * @return void
 */
function deleteAssessmentQuestion() {
	try {
		if ( ! isset( $_POST ) ) {
			throw new Exception( "Invalid Request Method", METHOD_NOT_ALLOWED );
		}
		$_POST = json_decode(file_get_contents("php://input"),true);

		$result = AssessmentService::deleteAssessmentQuestion( $_POST );
		if($result) {
			wp_send_json_success();
		} else {
			throw new Exception("Something wrong with the server.", INTERNAL_SERVER_ERROR);
		}
	} catch ( Exception $e ) {
		wp_send_json_error( $e->getMessage(), $e->getCode() );
	} finally {
		global $wpdb;
		$wpdb->close();
	}
}

/**
 * Fetch all the assessment questions.
 * @return void
 */
function findAllAssessmentQuestion() {
	try {
		if ( ! isset( $_GET ) ) {
			throw new Exception( "Invalid Request Method", METHOD_NOT_ALLOWED );
		}
		$result = AssessmentService::findAllAssessmentQuestion();
		if($result) {
			wp_send_json_success($result);
		} else {
			throw new Exception("Something wrong with the server.", INTERNAL_SERVER_ERROR);
		}
	} catch ( Exception $e ) {
		wp_send_json_error( $e->getMessage(), $e->getCode() );
	} finally {
		global $wpdb;
		$wpdb->close();
	}
}