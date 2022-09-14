<?php
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/interface/AssessmentQuestionBuilder.php' );

use AssessmentQuestion\Builder as Builder;

class AssessmentQuestionBuilder implements Builder {
	private AssessmentQuestion $assessmentQuestion;

	private function __construct() {
		$this->assessmentQuestion = new AssessmentQuestion();
	}

	public static function init(): AssessmentQuestionBuilder {
		return new AssessmentQuestionBuilder();
	}

	public function id( $id ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setId( $id );

		return $this;
	}

	public function component( $component ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setComponent( $component );

		return $this;
	}

	public function componentAbbrev( $componentAbbrev ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setComponentAbbrev( $componentAbbrev );

		return $this;
	}

	public function description( $description ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setDescription( $description );

		return $this;
	}

	public function scoring( $scoring ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setScoring( $scoring );

		return $this;
	}

	public function build(): AssessmentQuestion {
		return $this->assessmentQuestion;
	}
}

class AssessmentQuestion {
	private ?int $id = null;
	private ?string $component = null;
	private ?string $componentAbbrev = null;
	private ?string $description = null;
	private ?string $scoring = null;

	/**
	 * @param int|null $id
	 */
	function setId( ?int $id ): void {
		$this->id = $id;
	}

	/**
	 * @param string|null $component
	 */
	function setComponent( ?string $component ): void {
		$this->component = $component;
	}

	/**
	 * @param string|null $componentAbbrev
	 */
	function setComponentAbbrev( ?string $componentAbbrev ): void {
		$this->componentAbbrev = $componentAbbrev;
	}

	/**
	 * @param string|null $description
	 */
	function setDescription( ?string $description ): void {
		$this->description = $description;
	}

	/**
	 * @param string|null $scoring
	 */
	function setScoring( ?string $scoring ): void {
		$this->scoring = $scoring;
	}

	public function __construct() {}

	public function __destruct() {}

	public function toArray(): array {
		$arr = [
			'component'        => $this->component,
			'component_abbrev' => $this->componentAbbrev,
			'description'      => $this->description,
			'scoring'          => $this->scoring
		];
		if ( ! is_null( $this->id ) ) {
			$arr['id'] = $this->id;
		}

		return $arr;
	}
}