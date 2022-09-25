<?php
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/validator/BaseValidator.php' );

class AssessmentQuestionValidator extends BaseValidator {

	public function isComponent( $content, $message = "Invalid Component" ) {
		parent::isRequired( $content, $message );
		$componentList = [
			"Commitment to Equity, Diversity & Inclusion",
			"Gender Expertise",
			"Access to Resources",
			"Program Design",
			"Program Development",
			"Program Delivery",
			"Program Evaluation"
		];
		if ( ! in_array( $content, $componentList ) ) {
			throw new Exception( $message );
		}
	}

	public function isDescription( $content, $message = "Invalid Description" ) {
		parent::isRequired( $content, $message );
	}

	public function isHasNA( $content, $message = "Invalid HasNA" ) {
		$possibleValue = [
			"",
			"0",
			"1"
		];
		if ( ! in_array( $content, $possibleValue ) ) {
			throw new Exception( $message );
		}
	}

	public function isScoring( $content, $message = "Invalid Scoring" ) {
		parent::isRequired( $content, $message );
		if ( ! is_numeric( $content ) ) {
			throw new Exception( $message );
		}
	}
}