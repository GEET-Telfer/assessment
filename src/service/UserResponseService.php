<?php
declare( strict_types=1 );
//require_once( ABSPATH . 'wp-content/plugins/assessment/src/entity/UserResponse.php' );
//require_once( ABSPATH . 'wp-content/plugins/assessment/src/validator/UserResponseValidator.php' );

require_once( __DIR__ . "/../entity/UserResponse.php" );
require_once( __DIR__ . "/../validator/UserResponseValidator.php" );

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
		if ( ! self::isSubset( $request, USER_RESPONSE_PARAMS ) ) {
			throw new Exception( "Invalid Request Parameters", BAD_REQUEST_ERROR );
		}
		$answer     = stripslashes( $request['user_response'] );
		$email      = $request['user_email'];
		$evaluation = $request['score'];
		$report     = stripslashes( $request['report'] );

		$validator = new UserResponseValidator();
		$validator->isUserResponse( $answer );
		$validator->isUserEmail( $email );
		$validator->isScore( $evaluation );
		$validator->isReport( $report );

		$obj = UserResponseBuilder::init()
		                          ->answer( $answer )
		                          ->userEmail( $email )
		                          ->score( $evaluation )
		                          ->report( $report );

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