<?php


declare( strict_types=1 );

use PHPUnit\Framework\TestCase;

require_once( dirname( __FILE__ ) . "/../../src/constant/constant.php" );
require_once( dirname( __FILE__ ) . "/../../src/controller/AssessmentController.php" );

final class AssessmentControllerTest extends TestCase {
	/**
	 * TODO: resolve undefined wp_send_json_error
	 * @return void
	 */
	public function test_createAssessment_should_throw_MethodNotAllow_withGetRequest(): void {
		$this->expectError();

		$_POST = [];
		unset( $_POST );
		createAssessmentQuestion();
	}

	/**
	 * TODO: resolve undefined wp_send_json_error
	 * @return void
	 */
	public function test_deleteAssessment_should_throw_MethodNotAllow_withGetRequest(): void {
		$this->expectError();

		$_POST = [];
		unset( $_POST );
		deleteAssessmentQuestion();
	}

	/**
	 * TODO: resolve undefined wp_send_json_error
	 * @return void
	 */
	public function test_updateAssessment_should_throw_MethodNotAllow_withGetRequest(): void {
		$this->expectError();

		$_POST = [];
		unset( $_POST );
		updateAssessmentQuestion();
	}


}

