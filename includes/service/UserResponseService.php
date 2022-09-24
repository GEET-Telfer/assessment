<?php
declare( strict_types=1 );
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/entity/UserResponse.php' );

class UserResponseService {
	private static string $tableName = "user_response";

	public static function createUserResponse( $request ) {
		$obj = self::parseRequest( $request );
		global $wpdb;

		$success = $wpdb->insert(
			$wpdb->prefix . self::$tableName,
			$obj->toArray()
		);

		return $success;
	}

	private static function parseRequest( $request ): UserResponse {
		//TODO: verify $request
		$obj = UserResponseBuilder::init()
		                          ->answer( $request['user_response'])
		                          ->userEmail( $request['user_email'] )
		                          ->score( ( $request['score'] ) );
		print_r($obj);

		return $obj->build();
	}
}