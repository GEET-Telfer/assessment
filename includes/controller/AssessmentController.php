<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/service/AssessmentService.php' );

/**
 * @return void
 */
function createAssessmentQuestion(): void {
	if(isset($_POST)){
		$result = AssessmentService::createAssessmentQuestion($_POST);
		echo $result;
	}
	die();
}

/**
 * @return void
 */
function updateAssessmentQuestion(): void {
	if(isset($_POST)){
		$result = AssessmentService::updateAssessmentQuestion($_POST);
		echo $result;
	}
	die();
}

/**
 * @return void
 */
function deleteAssessmentQuestion(): void {
	if(isset($_POST)){
		$result = AssessmentService::deleteAssessmentQuestion($_POST);
		echo $result;
	}
	die();
}