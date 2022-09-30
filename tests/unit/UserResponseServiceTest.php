<?php


declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(dirname(__FILE__) . "/../../src/constant/constant.php");

final class UserResponseServiceTest extends TestCase
{

    /**
     *Empty Request
     */
    public function testUserResponseServiceShouldThrowBadRequestErrorWithEmptyRequest(): void
    {
        $this->expectExceptionCode(BAD_REQUEST_ERROR);
        UserResponseService::createUserResponse($_POST);
    }

    /**
     * Empty User Response
     * @return void
     * @throws Exception
     */
    public function testUserResponseServiceShouldThrowUnprocessableEntityErrorWithEmptyUserResponse(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['user_response'] = "";
        $_POST['user_email'] = "abc@gmail.com";
        $_POST['score'] = "low";

        UserResponseService::createUserResponse($_POST);
    }

    /**
     * Invalid Format of User Response
     * @return void
     * @throws Exception
     */
    public function testUserResponseServiceShouldThrowUnprocessableEntityErrorWithInvalidUserResponseType(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['user_response'] = "should not pass";
        $_POST['user_email'] = "abc@gmail.com";
        $_POST['score'] = "low";

        UserResponseService::createUserResponse($_POST);
    }

    /**
     * Empty Email
     * @return void
     * @throws Exception
     */
    public function testUserResponseServiceShouldThrowUnprocessableEntityErrorWithEmptyUserEmail(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['user_response'] = "[{}]";
        $_POST['user_email'] = "";
        $_POST['score'] = "low";

        UserResponseService::createUserResponse($_POST);
    }

    /**
     * Not Email
     * @return void
     * @throws Exception
     */
    public function testUserResponseServiceShouldThrowUnprocessableEntityErrorWithInvalidUserEmailFormat(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['user_response'] = "[{}]";
        $_POST['user_email'] = "123456";
        $_POST['score'] = "low";

        UserResponseService::createUserResponse($_POST);
    }

    /**
     * Empty Score
     * @return void
     * @throws Exception
     */
    public function testUserResponseServiceShouldThrowUnprocessableEntityErrorWithEmptyScore(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['user_response'] = "[{}]";
        $_POST['user_email'] = "abc@gmail.com";
        $_POST['score'] = "";

        UserResponseService::createUserResponse($_POST);
    }

    /**
     * Unexpected score value
     * @return void
     * @throws Exception
     */
    public function testUserResponseServiceShouldThrowUnprocessableEntityErrorWithScoreEnumNotPresent(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['user_response'] = "[{}]";
        $_POST['user_email'] = "abc@gmail.com";
        $_POST['score'] = "something else";

        UserResponseService::createUserResponse($_POST);
    }

}