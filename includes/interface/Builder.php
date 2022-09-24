<?php

namespace Builder;

interface BaseBuilder {
	public static function init(): BaseBuilder;

	public function build();

}

/**
 * A template builder for AssessmentQuestion Class that enable flexible AssessmentQuestion instantiation.
 */
interface AssessmentBuilder extends BaseBuilder {
	public function id( $id ): AssessmentBuilder;

	public function component( $component ): AssessmentBuilder;

	public function hasNA( $hasNA ): AssessmentBuilder;

	public function description( $description ): AssessmentBuilder;

	public function scoring( $scoring ): AssessmentBuilder;
}

/**
 *
 */
interface UserResponseBuilder extends BaseBuilder {
	public function userEmail( $userEmail ): UserResponseBuilder;

	public function answer( $answer ): UserResponseBuilder;

	public function score( $score ): UserResponseBuilder;
}