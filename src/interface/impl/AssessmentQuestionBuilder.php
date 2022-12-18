<?php

require_once( __DIR__ . "/../Builder.php" );
require_once( __DIR__ . "/../../entity/AssessmentQuestion.php" );

use Builder\AssessmentBuilder as Builder;

/**
 * Builder class for AssessmentQuestion with cascade design pattern.
 */
class AssessmentQuestionBuilder implements Builder {
	private AssessmentQuestion $assessmentQuestion;

	private function __construct() {
		$this->assessmentQuestion = new AssessmentQuestion();
	}

	/**
	 * Initiation of AssessmentQuestion Object.
	 */
	public static function init(): AssessmentQuestionBuilder {
		return new AssessmentQuestionBuilder();
	}

	public function uuid( $uuid ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setUUID($uuid);

		return $this;
	}

	public function questionStatus( $status ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setQuestionStatus( $status );

		return $this;
	}

	/**
	 * setId
	 */
	public function id( $id ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setId( $id );

		return $this;
	}

	/**
	 * setComponent
	 */
	public function component( $component ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setComponent( $component );

		return $this;
	}

	/**
	 * setComponentAbbrev
	 */
	public function componentAbbrev( $componentAbbrev ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setComponentAbbrev( $componentAbbrev );

		return $this;
	}

	/**
	 * setDescription
	 */
	public function description( $description ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setDescription( $description );

		return $this;
	}

	/**
	 * setHasNA
	 */
	public function hasNA( $hasNA ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setHasNA( $hasNA );

		return $this;
	}

	/**
	 * setScoring
	 */
	public function scoring( $scoring ): AssessmentQuestionBuilder {
		$this->assessmentQuestion->setScoring( $scoring );

		return $this;
	}

	/**
	 * Completion of building process.
	 */
	public function build(): AssessmentQuestion {
		return $this->assessmentQuestion;
	}
}