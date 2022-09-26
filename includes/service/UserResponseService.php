<?php
declare( strict_types=1 );
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/entity/UserResponse.php' );
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/validator/UserResponseValidator.php' );

class UserResponseService {
	private static string $tableName = "user_response";

	/**
	 * Insert user response into wp_user_response if valid. Otherwise, throws exception.
	 *
	 * @param $request
	 *
	 * @return bool|int|mysqli_result|resource|null
	 * @throws Exception
	 */
	public static function createUserResponse( $request ) {
		$obj = self::parseRequest( $request );
		global $wpdb;

		$data = $obj->toArray();

		return $wpdb->insert(
			$wpdb->prefix . self::$tableName,
			$data
		);
	}

	/**
	 * Parse http request and validate request parameters.
	 *
	 * @param $request
	 *
	 * @return UserResponse|null
	 * @throws Exception
	 */
	private static function parseRequest( $request ): ?UserResponse {
		if ( ! self::isSubset( $request, [ 'user_response', 'user_email', 'score' ] ) ) {
			throw new Exception( "Invalid Request Parameters" );
		}
		$answer     = $request['user_response'];
		$email      = $request['user_email'];
		$evaluation = $request['score'];

		$validator = new UserResponseValidator();
		$validator->isUserResponse( $answer );
		$validator->isUserEmail( $email );
		$validator->isScore( $evaluation );

		$obj = UserResponseBuilder::init()
		                          ->answer( $answer )
		                          ->userEmail( $email )
		                          ->score( $evaluation );

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