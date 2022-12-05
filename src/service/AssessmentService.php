<?php
// declare( strict_types=1 );

require_once( __DIR__ . "/../interface/impl/AssessmentQuestionBuilder.php" );
require_once( __DIR__ . "/../validator/AssessmentQuestionValidator.php" );
require_once( __DIR__ . "/../constant/constant.php");
class AssessmentService {
	private static string $tableName = 'assessment';

	/**
	 * Retrieve all the published assessment questions in the order of component_abbrev
	 * @return array|object|stdClass[]|null
	 */
	public static function findAllAssessmentQuestion() {
		global $wpdb;

		return $wpdb->get_results(
			"SELECT * FROM " . $wpdb->prefix . self::$tableName . " WHERE question_status='publish' ORDER BY component_abbrev"
		);
	}

	/**
	 * Retrieve all the assessment questions in the order of component_abbrev
	 * @return array|object|stdClass[]|null
	 */
	public static function findAllAssessmentQuestion4Admin() {
		global $wpdb;

		return $wpdb->get_results(
			"SELECT * FROM " . $wpdb->prefix . self::$tableName . " ORDER BY component_abbrev"
		);
	}


	/**
	 * Insert an assessment question to wp_assessment.
	 * @param $request: Expect a post request
	 * @return mysqli_result|bool|int|null
	 * @throws Exception
	 */
	public static function createAssessmentQuestion( $request ) {
		$obj = self::parseRequest( $request );

		global $wpdb;

		$data = $obj->toArray();

		return $wpdb->insert( $wpdb->prefix . self::$tableName, $data );
	}

	/**
	 * Parse and validate request for assessment question model.
	 * @param $request
	 * @return AssessmentQuestion
	 * @throws Exception
	 */
	private static function parseRequest( $request ): AssessmentQuestion {
		if ( ! self::isSubset( $request, ASSESSMENT_QUESTION_PARAMS ) ) {
			throw new Exception( "Invalid Request Parameters", UNPROCESSABLE_ENTITY_ERROR );
		}
		// Parameters for assessment question model
		$component   = $request['component'];
		$description = $request['description'];
		$hasNA       = $request['hasNA'];
		$scoring     = $request['scoring'];
		$uuid        = $request['uuid'];
		$questionStatus = $request['question_status'];

		// Validate if component exists in the COMPONENT_LIST
		$componentAbbrevIndex = array_search($component, COMPONENT_LIST);

		// Parameter value validation
		$validator = new AssessmentQuestionValidator();
		$validator->isComponent( $component );
		$validator->isDescription( $description );
		$validator->isHasNA( $hasNA );
		$validator->isScoring( $scoring );
		$validator->isComponentAbbrev($componentAbbrevIndex);
		$validator->isUUID( $uuid );
		$validator->isQuestionStatus( $questionStatus );
		// Acquire component abbreviation on COMPONENT_ABBREV_LIST
		$componentAbbrev = COMPONENT_ABBREV_LIST[$componentAbbrevIndex];

		$obj = AssessmentQuestionBuilder::init()
										->uuid($uuid)
										->questionStatus($questionStatus)
		                                ->component( $component )
										->componentAbbrev( $componentAbbrev )
		                                ->description( $description )
		                                ->hasNA( $hasNA )
		                                ->scoring( $scoring );

		// Add assessment question id to the model if it is to update assessment question
		$obj = isset( $request['id'] ) ? $obj->id( $request['id'] ) : $obj;

		return $obj->build();
	}

	/**
	 * Check if request contains all the required parameters.
	 * @param $request
	 * @param $lookup
	 * @return bool
	 */
	private static function isSubset( $request, $lookup ): bool {
		foreach ( $lookup as $key ) {
			if ( ! array_key_exists( $key, $request ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Update assessment question on given id.
	 * @param $request
	 * @return bool|int|mysqli_result|resource|null
	 * @throws Exception
	 */
	public static function updateAssessmentQuestion( $request ) {
		if ( ! isset( $request['id'] ) ) {
			throw new Exception( "Missing question id.", UNPROCESSABLE_ENTITY_ERROR );
		}
		$obj = self::parseRequest( $request );

		global $wpdb;

		$data = $obj->toArray();


		return $wpdb->update( $wpdb->prefix . self::$tableName, $data, array('id' => $request['id']) );
	}

	/**
	 * Hard deletion on assessment question for a given assessment question id.
	 * @param $request
	 * @return mysqli_result|bool|int|null
	 * @throws Exception
	 */
	public static function deleteAssessmentQuestion( $request ) {
		if ( ! isset( $request['id'] ) ) {
			throw new Exception( "Missing question id.", UNPROCESSABLE_ENTITY_ERROR );
		}

		global $wpdb;

		return $wpdb->delete( $wpdb->prefix . self::$tableName, array( 'id' => $request['id'] ) );
	}
}