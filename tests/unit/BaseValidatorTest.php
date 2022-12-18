<?php


declare( strict_types=1 );

//require_once( __DIR__ . "/../../src/validator/BaseValidator.php" );

use PHPUnit\Framework\TestCase;

final class BaseValidatorTest extends TestCase {
	static $validator = false;

	function setUp(): void {
		parent::setUp();

		if ( ! self::$validator ) {
			self::$validator = new BaseValidator();
		}
	}

	/**
	 * Rule for isRequired: not empty
	 * @return void
	 */
	public function test_BaseValidator_should_throw_UnprocessableEntityError_onEmptyValue(): void {
		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );

		$content = "";
		$message = "Testing isRequired on empty string";
		self::$validator->isRequired( $content, $message );
	}

	/**
	 * Rule for isRequired: not empty
	 * @return void
	 * @throws Exception
	 */
	public function test_BaseValidator_should_pass_onNonEmptyValue(): void {
		$this->assertTrue( true );
		$content = "test";
		$message = "Testing isRequired on non-empty string";
		self::$validator->isRequired( $content, $message );
	}

	/**
	 * Rule for isEmail: not empty and in the format of abc@abc.com
	 * @return void
	 * @throws Exception
	 */
	public function test_BaseValidator_should_throw_UnprocessableEntityError_onEmptyEmail() : void {
		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );

		$content = "";
		$message = "Testing isEmail on empty string";
		self::$validator->isEmail( $content, $message );
	}

	/**
	 * Rule for isEmail: not empty and in the format of abc@abc.com
	 * @return void
	 * @throws Exception
	 */
	public function test_BaseValidator_should_throw_UnprocessableEntityError_onInvalidEmail() : void {
		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );

		$content = "123456";
		$message = "Testing isEmail on invalid email format";
		self::$validator->isEmail( $content, $message );
	}

	/**
	 * Rule for isEmail: not empty and in the format of abc@abc.com
	 * @return void
	 * @throws Exception
	 */
	public function test_BaseValidator_should_pass_onValidEmail() : void {
		$this->assertTrue( true );

		$content = "abc@gmail.com";
		$message = "Testing isEmail on valid email format";
		self::$validator->isEmail( $content, $message );
	}

	/**
	 * Rule for minLength: content length no less than given length
	 * @return void
	 * @throws Exception
	 */
	public function test_BaseValidator_should_throw_UnprocessableEntityError_on_lesserLength() : void {
		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );

		$content = "test";
		$message = "Testing minLength on lesser length content";
		self::$validator->minLength( $content, 5, $message );
	}

	/**
	 * Rule for minLength: content length no less than given length
	 * @return void
	 * @throws Exception
	 */
	public function test_BaseValidator_should_pass_onMinLength() : void {
		$this->assertTrue( true );

		$content = "test";
		$message = "Testing minLength on valid length content";
		self::$validator->minLength( $content, 4, $message );
	}
}