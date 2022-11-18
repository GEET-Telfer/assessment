<?php

require_once( __DIR__ . "/../Builder.php" );
require_once( __DIR__ . "/../../entity/UserResponse.php" );

use Builder\UserResponseBuilder as Builder;

/**
 * Builder class for UserResponse with cascade design pattern.
 */
class UserResponseBuilder implements Builder {
	private UserResponse $userResponse;

	private function __construct() {
		$this->userResponse = new UserResponse();
	}

	/**
	 * Initiation of UserResponse Object.
	 */
	public static function init(): Builder {
		return new UserResponseBuilder();
	}

	/**
	 * Completion of building process.
	 */
	public function build(): UserResponse {
		return $this->userResponse;
	}

	/**
	 * setAnswer
	 * @param $answer
	 * @return Builder
	 */
	public function answer( $answer ): Builder {
		$this->userResponse->setAnswer( $answer );

		return $this;
	}

	/**
	 * setUserEmail
	 * @param $userEmail
	 * @return Builder
	 */
	public function userEmail( $userEmail ): Builder {
		$this->userResponse->setUserEmail( $userEmail );

		return $this;
	}

	/**
	 * setScore
	 * @param $score
	 * @return Builder
	 */
	public function score( $score ): Builder {
		$this->userResponse->setScore( $score );

		return $this;
	}

	/**
	 * setReport
	 * @param $report
	 * @return Builder
	 */
	public function report( $report ): Builder {
		$this->userResponse->setReport( $report );

		return $this;
	}
}