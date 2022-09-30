<?php
require_once( ABSPATH . 'wp-content/plugins/assessment/src/validator/BaseValidator.php' );

class AssessmentQuestionValidator extends BaseValidator {

	public function isComponent( $content, $message = "Invalid Component." ) {
		parent::isRequired( $content, $message );
		if ( ! in_array( $content, COMPONENT_LIST ) ) {
			throw new Exception( $message , UNPROCESSABLE_ENTITY_ERROR);
		}
	}

	public function isDescription( $content, $message = "Invalid Description." ) {
		parent::isRequired( $content, $message );
	}

	public function isHasNA( $content, $message = "Invalid HasNA." ) {
		if ( ! in_array( $content, NA_LIST ) ) {
			throw new Exception( $message );
		}
	}

	public function isScoring( $content, $message = "Invalid Scoring." ) {
		parent::isRequired( $content, $message );
		if ( ! is_numeric( $content ) ) {
			throw new Exception( $message );
		}
	}
}