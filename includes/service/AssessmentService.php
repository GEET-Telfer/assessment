<?php
declare( strict_types=1 );
require_once( ABSPATH . 'wp-content/plugins/assessment/includes//entity/AssessmentQuestion.php' );

class AssessmentService {
	private static string $tableName = 'assessment';

	public static function createAssessmentQuestion( $request ) {
		$aq = self::parseRequest( $request );

		global $wpdb;

		$success = $wpdb->insert(
			$wpdb->prefix . self::$tableName,
			$aq->toArray()
		);

		return $success;
	}

	public static function updateAssessmentQuestion( $request ) {
		// NOTE: expecting hidden input with assessmentId
		if ( ! isset( $request['id'] ) ) {
			return false;
		}
		$aq = self::parseRequest( $request );

		global $wpdb;

		$success = $wpdb->update(
			$wpdb->prefix . self::$tableName,
			$aq->toArray(),
			$request['Id']
		);

		return $success;
	}

	public static function deleteAssessmentQuestion( $request ) {
		// NOTE: expecting hidden input with assessmentId
		if ( ! isset( $request['id'] ) ) {
			return false;
		}
		$aq = self::parseRequest( $request );

		global $wpdb;

		$success = $wpdb->delete(
			$wpdb->prefix . self::$tableName,
			$request['Id']
		);

		return $success;
	}

	private static function parseRequest( $request ): AssessmentQuestion {
		//TODO: verify $request

		$aq = AssessmentQuestionBuilder::init()
		                               ->component( $request['component'] )
		                               ->description( $request['description'] )
		                               ->illustrativeMetric( $request['illustrative_metric'] )
		                               ->scoring( ( $request['scoring'] ) );

		$aq = isset( $request['id'] ) ? $aq->id( $request['id'] ) : $aq;

		return $aq->build();
	}
}