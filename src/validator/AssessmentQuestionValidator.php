<?php
require_once( __DIR__ . "/../validator/BaseValidator.php" );

class AssessmentQuestionValidator extends BaseValidator {

	/**
	 * Rule for component: not empty and is in COMPONENT_LIST
	 * @throws Exception
	 */
	public function isComponent( $content ) {
		parent::isRequired( $content, "Missing Parameter: Component" );
		if ( ! in_array( $content, COMPONENT_LIST ) ) {
			throw new Exception( "Component Value Not Found.", UNPROCESSABLE_ENTITY_ERROR );
		}
	}

	/**
	 * Rule for description: not empty
	 * @throws Exception
	 */
	public function isDescription( $content ) {
		parent::isRequired( $content, "Missing Parameter: Description." );
	}

	/**
	 * Rule for hasNA: not empty and is in NA_LIST
	 * @throws Exception
	 */
	public function isHasNA( $content ) {
		if ( ! in_array( $content, NA_LIST ) ) {
			throw new Exception( "HasNA Value Not Found", UNPROCESSABLE_ENTITY_ERROR );
		}
	}

	/**
	 * Rule for scoring: not empty and is positive digit
	 * @throws Exception
	 */
	public function isScoring( $content ) {
		parent::isRequired( $content, "Missing Parameter: Scoring" );
		if ( ! is_numeric( $content ) || $content <= 0 ) {
			throw new Exception( "Invalid Value For Scoring", UNPROCESSABLE_ENTITY_ERROR );
		}
	}

	/**
	 * Rule for componentAbbrev: not empty and is in COMPONENT_ABBREV_LIST
	 * @throws Exception
	 */
	public function isComponentAbbrev( $content ) {
		if ( !is_int($content) || ! array_key_exists( $content, COMPONENT_ABBREV_LIST )) {
			throw new Exception( "Invalid Value For Component Abbreviation", UNPROCESSABLE_ENTITY_ERROR );
		}
	}
}