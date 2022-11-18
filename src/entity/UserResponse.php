<?php

class UserResponse {
	private ?string $answer = null;
	private ?string $userEmail = null;
	private ?string $score = null;
	private ?string $report = null;

	/**
	 * setter for answer
	 * @param string $answer
	 */
	public function setAnswer( string $answer ): void {
		$this->answer = $answer;
	}

	/**
	 * setter for user_email
	 * @param string $userEmail
	 */
	public function setUserEmail( string $userEmail ): void {
		$this->userEmail = $userEmail;
	}

	/**
	 * setter for score
	 * @param string $score
	 */
	public function setScore( string $score ): void {
		$this->score = $score;
	}

	/**
	 * setter for report
	 * @param string $report
	 * @return void
	 */
	public function setReport( string $report ): void {
		$this->report = $report;
	}

	public function __construct() {
	}

	public function __destruct() {
	}

	/**
	 * return an associative array of the user response object.
	 * @return array
	 */
	public function toArray(): array {
		return [
			'user_email' => $this->userEmail,
			'responses'  => $this->answer,
			'score'      => $this->score,
			'report'     => $this->report
		];
	}
}