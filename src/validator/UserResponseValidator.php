<?php
//require_once( ABSPATH . 'wp-content/plugins/assessment/src/validator/BaseValidator.php' );
require_once(__DIR__."/../validator/BaseValidator.php");

class UserResponseValidator extends BaseValidator {

	public function isUserResponse( $content, $message = "Invalid User Response." ) {
		parent::isRequired( $content, $message );
//		if ( ! is_array( json_decode( $content ) ) || count( json_decode( $content ) ) === 0 ) {
//			throw new Exception( $message, UNPROCESSABLE_ENTITY_ERROR );
//		}
	}

	public function isScore( $content, $message = "Invalid Evaluation." ) {
		parent::isRequired( $content, $message );
		if ( ! in_array( $content, EVALUATION, true ) ) {
			throw new Exception( $message, UNPROCESSABLE_ENTITY_ERROR );
		}
	}

	public function isUserEmail( $content, $message = "Invalid User Email." ) {
		parent::isEmail( $content, $message );
	}

	public function isReport($content, $message = "Invalid User Report.") {
		parent::isRequired( $content, $message );
	}
}