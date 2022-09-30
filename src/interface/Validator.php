<?php

namespace Validator;

interface Validator {

	public function isRequired( $content, $message ): void;

	public function minLength( $content, $length, $message ): void;

	public function isEmail( $content, $message ): void;
}