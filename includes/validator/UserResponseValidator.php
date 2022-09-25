<?php
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/validator/BaseValidator.php' );

class UserResponseValidator extends BaseValidator {

	public function __construct() {
	}


	public function isUserResponse( $content, $message = "Invalid User Response." ) {
		parent::isRequired( $content, $message );
	}

	public function isScore( $content, $message = "Invalid Evaluation" ) {
		parent::isRequired( $content, $message );
		$evaluation = [ 'low', 'some', 'moderate', 'high' ];
		if ( ! in_array( $content, $evaluation, true ) ) {
			throw new Exception( $message );
		}
	}

	public function isUserEmail( $content, $message = "Invalid User Email." ) {
		parent::isEmail( $content, $message );
	}
}