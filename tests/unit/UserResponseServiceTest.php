<?php


declare( strict_types=1 );

use PHPUnit\Framework\TestCase;

require_once( dirname( __FILE__ ) . "/../../src/constant/constant.php" );

final class UserResponseServiceTest extends TestCase {

	/**
	 * With empty request body, UserResponseService should throw BAD_REQUEST_ERROR
	 */
	public function test_UserResponseService_should_throw_BadRequestError_with_EmptyRequest(): void {
		$this->expectExceptionCode( BAD_REQUEST_ERROR );
		UserResponseService::createUserResponse( $_POST );
	}

	/**
	 * With empty user response, UserResponseService should throw UNPROCESSABLE_ENTITY_ERROR
	 * @return void
	 * @throws Exception
	 */
	public function test_UserResponseService_should_throw_UnprocessableEntityError_with_EmptyUserResponse(): void {
		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );

		$_POST['user_response'] = "";
		$_POST['user_email']    = "abc@gmail.com";
		$_POST['score']         = 1.0;
		$_POST['report']        = "[{}]";

		UserResponseService::createUserResponse( $_POST );
	}

	/**
	 * With non-JSON array user response, UserResponseService should throw UNPROCESSABLE_ENTITY_ERROR
	 * @return void
	 * @throws Exception
	 */
	public function test_UserResponseService_should_throw_UnprocessableEntityError_with_InvalidUserResponseType(): void {
		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );

		$_POST['user_response'] = "should not pass";
		$_POST['user_email']    = "abc@gmail.com";
		$_POST['score']         = 1.0;
		$_POST['report']        = "[{}]";

		UserResponseService::createUserResponse( $_POST );
	}

	/**
	 * With empty user email, UserResponseService should throw UNPROCESSABLE_ENTITY_ERROR
	 * @return void
	 * @throws Exception
	 */
	public function test_UserResponseService_should_throw_UnprocessableEntityError_with_EmptyUserEmail(): void {
		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );

		$_POST['user_response'] = "[{}]";
		$_POST['user_email']    = "";
		$_POST['score']         = 1.0;
		$_POST['report']        = "[{}]";

		UserResponseService::createUserResponse( $_POST );
	}

	/**
	 * With an invalid email format, UserResponseService should throw UNPROCESSABLE_ENTITY_ERROR
	 * @return void
	 * @throws Exception
	 */
	public function test_UserResponseService_should_throw_UnprocessableEntityError_with_InvalidUserEmailFormat(): void {
		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );

		$_POST['user_response'] = "[{}]";
		$_POST['user_email']    = "123456";
		$_POST['score']         = 1.0;
		$_POST['report']        = "[{}]";

		UserResponseService::createUserResponse( $_POST );
	}

	/**
	 * With empty score, UserResponseService should throw UNPROCESSABLE_ENTITY_ERROR
	 * @return void
	 * @throws Exception
	 */
	public function test_UserResponseService_should_throw_UnprocessableEntityError_with_EmptyScore(): void {
		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );

		$_POST['user_response'] = "[{}]";
		$_POST['user_email']    = "abc@gmail.com";
		$_POST['score']         = "";
		$_POST['report']        = "[{}]";

		UserResponseService::createUserResponse( $_POST );
	}

//	/**
//	 * With not-enum type score, UserResponseService should throw UNPROCESSABLE_ENTITY_ERROR
//	 * @return void
//	 * @throws Exception
//	 */
//	public function test_UserResponseService_should_throw_UnprocessableEntityError_with_ScoreEnumNotPresent(): void {
//		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );
//
//		$_POST['user_response'] = "[{}]";
//		$_POST['user_email']    = "abc@gmail.com";
//		$_POST['score']         = "something else";
//		$_POST['report']        = "[{}]";
//
//		UserResponseService::createUserResponse( $_POST );
//	}


	/**
	 * With empty report, UserResponseService should throw UNPROCESSABLE_ENTITY_ERROR
	 */
	public function test_UserResponseService_should_throw_UnprocessableEntityError_with_EmptyReport(): void {
		$this->expectExceptionCode( UNPROCESSABLE_ENTITY_ERROR );

		$_POST['user_response'] = "[{}]";
		$_POST['user_email']    = "abc@gmail.com";
		$_POST['score']         = 1.0;
		$_POST['report']        = "";

		UserResponseService::createUserResponse( $_POST );
	}
}