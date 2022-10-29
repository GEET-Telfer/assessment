<?php
require_once(__DIR__."/../validator/BaseValidator.php");

class UserResponseValidator extends BaseValidator {

	/**
	 * Rule for responses: not empty and in JSON format
	 * @throws Exception
	 */
	public function isUserResponse( $content) {
		parent::isRequired( $content, "Missing Parameter: User Response" );
		if ( !is_string($content) || ! is_array( json_decode( $content, true ) )) {
			throw new Exception( "Invalid Format of User Response", UNPROCESSABLE_ENTITY_ERROR );
		}
	}

	/**
	 * Rule for score: not empty and is in EVALUATION enum
	 * @throws Exception
	 */
	public function isScore( $content ) {
		parent::isRequired( $content, "Missing Parameter: Score" );
		if ( ! in_array( $content, EVALUATION, true ) ) {
			throw new Exception( "Score Value Not Found", UNPROCESSABLE_ENTITY_ERROR );
		}
	}

	/**
	 * Rule for Email: not empty and in format of abc@abc.com
	 * @throws Exception
	 */
	public function isUserEmail( $content, $message = "Invalid User Email." ) {
		parent::isEmail( $content, $message );
	}

	/**
	 * Rule for report: not empty and in JSON format
	 * @throws Exception
	 */
	public function isReport($content) {
		parent::isRequired( $content, "Missing Parameter: Report"  );
		if ( !is_string($content) || ! is_array( json_decode( $content, true ) )) {
			throw new Exception( "Invalid Format of Report", UNPROCESSABLE_ENTITY_ERROR );
		}
	}
}