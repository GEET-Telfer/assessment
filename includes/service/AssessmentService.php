<?php
declare( strict_types=1 );
require_once( ABSPATH . 'wp-content/plugins/assessment/includes//entity/AssessmentQuestion.php' );

class AssessmentService {
	private static string $tableName = 'assessment';

	public static function createAssessmentQuestion( $request ) {
		//TODO: verify $request

		$aq = new AssessmentQuestion(
			$request['component'],
			$request['componentAbbrev'],
			$request['description'],
			$request['scoring']
		);

		global $wpdb;
		// TODO: encapsulate data array with AssessmentQuestion class
		$success = $wpdb->insert(
			$wpdb->prefix . self::$tableName,
			[
				'component'        => $request['component'],
				'component_abbrev' => $request['componentAbbrev'],
				'description'      => $request['description'],
				'scoring'          => json_encode( $request['scoring'] )
			]
		);

		print_r( $request );

		print_r( $aq->toArray() );

		return $success;
	}
}