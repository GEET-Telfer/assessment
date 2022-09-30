<?php
require_once( ABSPATH . 'wp-content/plugins/assessment/src/interface/Builder.php' );

use Builder\BaseBuilder;
use Builder\UserResponseBuilder as Builder;

class UserResponseBuilder implements Builder {
	private UserResponse $userResponse;

	private function __construct() {
		$this->userResponse = new UserResponse();
	}

	public static function init(): BaseBuilder {
		return new UserResponseBuilder();
	}

	public function build(): UserResponse {
		return $this->userResponse;
	}


	public function answer( $answer ): Builder {
		$this->userResponse->setAnswer( $answer );

		return $this;
	}

	public function userEmail( $userEmail ): Builder {
		$this->userResponse->setUserEmail( $userEmail );

		return $this;
	}

	public function score( $score ): Builder {
		$this->userResponse->setScore( $score );

		return $this;
	}
}

class UserResponse {
	private ?string $answer = null;
	private ?string $userEmail = null;
	private ?string $score = null;

	/**
	 * @param string $answer
	 */
	public function setAnswer( string $answer ): void {
		$this->answer = $answer;
	}

	/**
	 * @param string $userEmail
	 */
	public function setUserEmail( string $userEmail ): void {
		$this->userEmail = $userEmail;
	}

	/**
	 * @param string $score
	 */
	public function setScore( string $score ): void {
		$this->score = $score;
	}

	public function __construct() {
	}

	public function __destruct() {
	}

	public function toArray(): array {
		return [
			'user_email' => $this->userEmail,
			'responses'  => $this->answer,
			'score'      => $this->score
		];
	}
}