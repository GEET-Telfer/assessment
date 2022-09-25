<?php
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/interface/Validator.php' );

use Validator\Validator;

class BaseValidator implements Validator {

	public function isRequired( $content, $message ): void {
		if ( empty( $content ) ) {
			throw new Exception( $message );
		}
	}

	public function isEmail( $content, $message ): void {
		$this->isRequired( $content, $message );
		if ( ! filter_var( $content, FILTER_VALIDATE_EMAIL ) ) {
			throw new Exception( $message );
		}
	}

	public function minLength( $content, $length, $message ): void {
		$this->isRequired( $content, $message );
		if ( $content . $length < $length ) {
			throw new Exception( $message );
		}
	}
}