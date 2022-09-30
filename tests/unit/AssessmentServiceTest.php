<?php


declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(dirname(__FILE__) . "/../../src/constant/constant.php");

final class AssessmentServiceTest extends TestCase
{

    /**
     *Throw BAD REQUEST ERROR when having empty data
     */
    public function testAssessmentShouldThrowBadRequestErrorWithEmptyRequest(): void
    {

        $this->expectExceptionCode(BAD_REQUEST_ERROR);
        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having an empty component
     * @return void
     */
    public function testAssessmentShouldThrowUnprocessableEntityErrorWithEmptyComponent(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

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
    public function testAssessmentShouldThrowUnprocessableEntityErrorWithEnumNotPresent(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "should not pass";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "5";
        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having an empty description
     * @return void
     */
    public function testAssessmentShouldThrowUnprocessableEntityErrorWithEmptyDescription(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "5";
        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having invalid hasNA
     * @return void
     */
    public function testAssessmentShouldThrowUnprocessableEntityErrorWithInvalidHasNA(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = "false";
        $_POST['scoring'] = "5";
        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having empty scoring
     * @return void
     */
    public function testAssessmentShouldThrowUnprocessableEntityErrorWithEmptyScoring(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = "";
        $_POST['scoring'] = "";
        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having invalid scoring
     * @return void
     */
    public function testAssessmentShouldThrowUnprocessableEntityErrorWithInvalidScoringType(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "text";
        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having negative scoring(logical error)
     * @return void
     */
    public function testAssessmentShouldThrowUnprocessableEntityErrorWithNegativeScoring(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "-1";
        AssessmentService::createAssessmentQuestion($_POST);
    }
}