<?php

/**
 * Data model for assessment questions
 */
class AssessmentQuestion {
	private ?int $id = null; # Auto-incremented Id assigned from database
	private ?string $component = null; # Category of the assessment question
	private ?string $componentAbbrev = null; # Abbreviation of component
	private ?string $description = null; # Detail description of the question
	private bool $hasNA = false; # does the assessment question have N/A option
	private ?int $scoring = null; # scoring metric e.g. 5: score from 1 to 5.

	public function __construct() {}

	public function __destruct() {}

	/**
	 * setter for id
	 * @param int|null $id
	 */
	function setId( ?int $id ): void {
		$this->id = $id;
	}

	/**
	 * setter for component
	 * @param string|null $component
	 */
	function setComponent( ?string $component ): void {
		$this->component = $component;
	}

	/**
	 * setter for componentAbbrev
	 * @param string|null $componentAbbrev
	 */
	function setComponentAbbrev( ?string $componentAbbrev ): void {
		$this->componentAbbrev = $componentAbbrev;
	}

	/**
	 * setter for description
	 * @param string|null $description
	 */
	function setDescription( ?string $description ): void {
		$this->description = $description;
	}

	/**
	 * setter for hasNA
	 * @param bool|null $hasNA
	 * @return void
	 */
	public function setHasNA( ?bool $hasNA ): void {
		$this->hasNA = $hasNA;
	}

	/**
	 * setter for scoring
	 * @param int|null $scoring
	 */
	function setScoring( ?int $scoring ): void {
		$this->scoring = $scoring;
	}

	/**
	 * return an associative array of the assessment question object.
	 * @return array
	 */
	public function toArray(): array {
		$arr = [
			'component'       => $this->component,
			'component_abbrev' => $this->componentAbbrev,
			'description'     => $this->description,
			'has_NA'           => $this->hasNA,
			'scoring'         => $this->scoring
		];
		if ( ! is_null( $this->id ) ) {
			$arr['id'] = $this->id;
		}

		return $arr;
	}
}