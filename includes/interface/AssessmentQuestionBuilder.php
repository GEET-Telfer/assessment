<?php

namespace AssessmentQuestion;

use AssessmentQuestion;

/**
 * A template builder for AssessmentQuestion Class that enable flexible AssessmentQuestion instantiation.
 */
interface Builder {
	public static function init() : Builder;

	public function id( $id ): Builder;

	public function component( $component ): Builder;

	public function componentAbbrev( $componentAbbrev ): Builder;

	public function description( $description ): Builder;

	public function scoring( $scoring ): Builder;

	public function build(): AssessmentQuestion;
}