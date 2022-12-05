<?php


declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(dirname(__FILE__) . "/../../src/constant/constant.php");

final class AssessmentServiceTest extends TestCase
{

    /**
     *Throw BAD REQUEST ERROR when having empty data
     */
    public function test_createAssessmentService_should_throw_BadRequestError_withEmptyRequest(): void
    {

        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);
        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having an empty component
     * @return void
     */
    public function test_createAssessmentService_should_throw_UnprocessableEntityError_withEmptyComponent(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "5";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["question_status"] = "draft";

        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having an invalid component option
     * @return void
     */
    public function test_createAssessmentService_should_throw_UnprocessableEntityError_withEnumNotPresent(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "should not pass";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "5";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["question_status"] = "draft";

        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having an empty description
     * @return void
     */
    public function test_createAssessmentService_should_throw_UnprocessableEntityError_withEmptyDescription(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "5";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["question_status"] = "draft";

        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having empty scoring
     * @return void
     */
    public function test_createAssessmentService_should_throw_UnprocessableEntityError_withEmptyScoring(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = "";
        $_POST['scoring'] = "";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["question_status"] = "draft";

        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having invalid scoring
     * @return void
     */
    public function test_createAssessmentService_should_throw_UnprocessableEntityError_withInvalidScoringType(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "text";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["question_status"] = "draft";

        AssessmentService::createAssessmentQuestion($_POST);
    }

    /**
     * Throw UNPROCESSABLE_ENTITY_ERROR when having negative scoring(logical error)
     * @return void
     */
    public function test_createAssessmentService_should_throw_UnprocessableEntityError_withNegativeScoring(): void
    {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $_POST['component'] = "Gender Expertise";
        $_POST['description'] = "placeholder";
        $_POST['hasNA'] = 0;
        $_POST['scoring'] = "-1";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["question_status"] = "draft";

        AssessmentService::createAssessmentQuestion($_POST);
    }

	/**
	 * Throw UNPROCESSABLE_ENTITY_ERROR if there is no question id passed.
	 * @return void
	 * @throws Exception
	 */
	public function test_deleteAssessmentService_should_throw_UnprocessableEntityError_withMissingQuestionId(): void {
		$this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);
		AssessmentService::deleteAssessmentQuestion($_POST);
	}

	/**
	 * Throw MISSING_QUESTION_ID if trying to update a question without providing its id
	 * @return void
	 * @throws Exception
	 */
	public function test_updateAssessmentService_should_throw_UnprocessableEntityError_withMissingQuestionId() : void {
		$this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

		$_POST['component'] = "Gender Expertise";
		$_POST['description'] = "placeholder";
		$_POST['hasNA'] = 0;
		$_POST['scoring'] = "-1";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["question_status"] = "draft";

		AssessmentService::updateAssessmentQuestion($_POST);
	}

	/**
	 * Throw UNPROCESSABLE_ENTITY_ERROR if trying to update a question with no content.
	 * @return void
	 */
	public function test_updateAssessmentService_should_throw_UnprocessableEntityError_withEmptyRequestBody() : void {
		$this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);
		$_POST['id'] = 1;

		AssessmentService::updateAssessmentQuestion($_POST);
	}

	/**
	 * Throw UNPROCESSABLE_ENTITY_ERROR if trying to update a question with invalid parameter content.
	 * @return void
	 * @throws Exception
	 */
	public function test_updateAssessmentService_should_throw_UnprocessableEntityError_withInvalidRequestBody() : void {
		$this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

		$_POST['id'] = 1;
		$_POST['component'] = "Gender Expertise";
		$_POST['description'] = "placeholder";
		$_POST['hasNA'] = 0;
		$_POST['scoring'] = "-1";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["question_status"] = "draft";

		AssessmentService::updateAssessmentQuestion($_POST);
	}
}