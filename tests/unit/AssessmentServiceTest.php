<?php


declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once(dirname(__FILE__)."/../../src/constant/constant.php");

final class AssessmentServiceTest extends TestCase
{

    public function testAssessmentShouldThrowBadRequestErrorWithEmptyRequest():void {

        $this->expectException(Exception::class);
        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having an empty component
     * @return void
     */
    public function testAssessmentShouldThrowUnprocessableEntityErrorWithEmptyComponent(): void {
        $errMessage = "Invalid Component.";
        $this->expectExceptionMessage($errMessage);

        $_POST['component'] = "";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "5";
        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having an invalid component option
     * @return void
     */
    public function testAssessmentShouldThrowUnprocessableEntityErrorWithEnumNotPresent(): void {
        $errMessage = "Invalid Component.";
        $this->expectExceptionMessage($errMessage);

        $_POST['component'] = "should not pass";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "5";
        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having invalid hasNA
     * @return void
     */
    public function testAssessmentShouldThrowUnprocessableEntityErrorWithInvalidHasNA(): void {
        $errMessage = "Invalid HasNA.";
//        $this->expectExceptionMessage($errMessage);
        $this->assertEquals(UNPROCESSABLE_ENTITY_ERROR, http_response_code());
        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = "false";
        $_POST['scoring'] = "5";
        AssessmentService::createAssessmentQuestion($_POST);
    }

    public function testAssessmentShouldThrowUnprocessableEntityErrorWithEmptyScoring(): void {
        $errMessage = "Invalid Scoring.";
        $this->expectExceptionMessage($errMessage);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = "";
        $_POST['scoring'] = "";
        AssessmentService::createAssessmentQuestion($_POST);
    }

    public function testAssessmentShouldThrowUnprocessableEntityErrorWithInvalidScoringType(): void {
        $errMessage = "Invalid Scoring.";
        $this->expectExceptionMessage($errMessage);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "text";
        AssessmentService::createAssessmentQuestion($_POST);
    }

    public function testAssessmentShouldThrowUnprocessableEntityErrorWithNegativeScoring(): void {
        $errMessage = "Invalid Scoring.";
        $this->expectExceptionMessage($errMessage);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "-1";
        AssessmentService::createAssessmentQuestion($_POST);
    }
}