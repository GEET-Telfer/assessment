<?php
declare( strict_types=1 );
ini_set( 'display_errors', '1' );
ini_set( 'display_startup_errors', '1' );
error_reporting( E_ALL );
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/service/AssessmentService.php' );
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/constant/constant.php' );

/**
 * @return void
 */
function createAssessmentQuestion(): void {
	if ( isset( $_POST ) ) {
		try {
			$result = AssessmentService::createAssessmentQuestion( $_POST );
			echo $result;
		} catch ( Exception $e ) {
			wp_send_json_error( $e->getMessage(), UNPROCESSABLE_ENTITY_ERROR );
		}
	}
	die();
}

/**
 * @return void
 */
function updateAssessmentQuestion(): void {
	if ( isset( $_POST ) ) {
		$result = AssessmentService::updateAssessmentQuestion( $_POST );
		echo $result;
	}
	die();
}

/**
 * @return void
 */
function deleteAssessmentQuestion(): void {
	if ( isset( $_POST ) ) {
		$result = AssessmentService::deleteAssessmentQuestion( $_POST );
		echo $result;
	}
	die();
}

function findAllAssessmentQuestion(): void {
	if ( isset( $_GET ) ) {
		$result = AssessmentService::findAllAssessmentQuestion();

		echo json_encode( $result );
	}
	die();
}