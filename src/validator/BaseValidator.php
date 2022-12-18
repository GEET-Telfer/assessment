<?php

require_once( __DIR__ . "/../interface/Validator.php" );
require_once( __DIR__ . "/../constant/constant.php" );

use Validator\Validator;

class BaseValidator implements Validator {

	/**
	 * content must in the format of abc@abc.com
	 * @throws Exception
	 */
	public function isEmail( $content, $message ): void {
		$this->isRequired( $content, $message );
		if ( ! filter_var( $content, FILTER_VALIDATE_EMAIL ) ) {
			throw new Exception( $message, UNPROCESSABLE_ENTITY_ERROR );
		}
	}

	/**
	 * content must not be empty
	 * @throws Exception
	 */
	public function isRequired( $content, $message, $code = UNPROCESSABLE_ENTITY_ERROR ): void {
		if ( empty( $content ) ) {
			throw new Exception( $message, $code );
		}
	}

	/**
	 * content must have minimum length of $length
	 * @throws Exception
	 */
	public function minLength(  $content, $length, $message ): void {
		$this->isRequired( $content, $message );
		if ( strlen($content) < $length ) {
			throw new Exception( $message, UNPROCESSABLE_ENTITY_ERROR );
		}
	}
}