<?php
declare( strict_types=1 );

require_once( __DIR__ . "/../interface/impl/UserResponseBuilder.php" );
require_once( __DIR__ . "/../validator/UserResponseValidator.php" );

class UserResponseService {
	private static string $tableName = "user_response";

	/**
	 * Insert user response into wp_user_response if valid. Otherwise, throws exception.
	 *
	 * @param $request
	 * @return bool|int|mysqli_result|resource|null
	 * @throws Exception
	 */
	public static function createUserResponse( $request ) {
		$obj = self::parseRequest( $request );
		global $wpdb;

		$data = $obj->toArray();

		return $wpdb->insert(
			$wpdb->prefix . self::$tableName,
			$data,
			['%s', '%s','%s','%s']
		);
	}

	/**
	 * Parse http request and validate request parameters.
	 *
	 * @param $request
	 * @return UserResponse|null
	 * @throws Exception
	 */
	private static function parseRequest( $request ): ?UserResponse {
		if ( ! self::isSubset( $request, USER_RESPONSE_PARAMS ) ) {
			throw new Exception( "Invalid Request Parameters", BAD_REQUEST_ERROR );
		}

		// Parameters for user response model
		$answer     = stripslashes( $request['user_response'] );
		$email      = $request['user_email'];
		$evaluation = $request['score'];
		$report     = stripslashes( $request['report'] );

		// Parameter value validation
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
}