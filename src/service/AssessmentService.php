<?php
declare( strict_types=1 );
//require_once( ABSPATH . 'wp-content/plugins/assessment/src/entity/AssessmentQuestion.php' );
//require_once( ABSPATH . 'wp-content/plugins/assessment/src/validator/AssessmentQuestionValidator.php' );

require_once(__DIR__."/../entity/AssessmentQuestion.php");
require_once(__DIR__."/../validator/AssessmentQuestionValidator.php");
class AssessmentService {
	private static string $tableName = 'assessment';

	public static function findAllAssessmentQuestion() {
		global $wpdb;

		return $wpdb->get_results(
			"SELECT * FROM " . $wpdb->prefix . self::$tableName . " ORDER BY component"
		);
	}

	public static function createAssessmentQuestion( $request ) {
		$obj = self::parseRequest( $request );

		global $wpdb;

		$data = $obj->toArray();

		return $wpdb->insert(
			$wpdb->prefix . self::$tableName,
			$data
		);
	}

	public static function updateAssessmentQuestion( $request ) {
		// NOTE: expecting hidden input with assessmentId
		if ( ! isset( $request['id'] ) ) {
			return false;
		}
		$obj = self::parseRequest( $request );

		global $wpdb;

		$data = $obj->toArray();

		return $wpdb->update(
			$wpdb->prefix . self::$tableName,
			$data,
			$request['Id']
		);
	}

	public static function deleteAssessmentQuestion( $request ) {
		// NOTE: expecting hidden input with assessmentId
		if ( ! isset( $request['id'] ) ) {
			return false;
		}
		$obj = self::parseRequest( $request );

		global $wpdb;

		return $wpdb->delete(
			$wpdb->prefix . self::$tableName,
			$request['Id']
		);
	}

	private static function parseRequest( $request ): AssessmentQuestion {
		if ( ! self::isSubset( $request, ASSESSMENT_QUESTION_PARAMS ) ) {
			throw new Exception( "Invalid Request Parameters" , BAD_REQUEST_ERROR);
		}

		$component   = $request['component'];
		$description = $request['description'];
		$hasNA       = $request['hasNA'];
		$scoring     = $request['scoring'];

		$validator = new AssessmentQuestionValidator();
		$validator->isComponent( $component );
		$validator->isDescription( $description );
		$validator->isHasNA( $hasNA );
		$validator->isScoring( $scoring );

		$obj = AssessmentQuestionBuilder::init()
		                                ->component( $request['component'] )
		                                ->description( $request['description'] )
		                                ->hasNA( $request['hasNA'] )
		                                ->scoring( ( $request['scoring'] ) );

		$obj = isset( $request['id'] ) ? $obj->id( $request['id'] ) : $obj;

		return $obj->build();
	}

	/**
	 * @param $request
	 * @param $lookup
	 *
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
}