<?php


declare( strict_types=1 );

use PHPUnit\Framework\TestCase;

require_once( dirname( __FILE__ ) . "/../../src/validator/CourseValidator.php" );
require_once( dirname( __FILE__ ) . "/../../src/constant/constant.php" );

final class CourseValidatorTest extends TestCase {
	static $validator = false;

	function setUp(): void {
		parent::setUp();

		if ( ! self::$validator ) {
			self::$validator = new CourseValidator();
		}
	}

    public function test_courseValidator_on_empty_title() {

        $this->expectErrorMessage("Missing Parameter: Title");

        $content = null;
        self::$validator->isTitle($content);

    }

    public function test_courseValidator_should_pass_on_title() {
        $this->assertTrue(true);

        $content = "this is a title";
        self::$validator->isTitle($content);
    }

    public function test_courseValidator_on_empty_videoLink() {
        $this->expectErrorMessage("Missing Parameter: Video Link");

        $content = null;
        self::$validator->isVideoLink($content);
    }

    public function test_courseValidator_on_numeric_videoLink() {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $content = "12345";
        self::$validator->isVideoLink($content);
    }

    public function test_courseValidator_should_pass_on_videoLink() {
        $this->assertTrue(true);

        $content = "https://youtube.ca";
        self::$validator->isVideoLink($content);
    }

    public function test_courseValidator_on_empty_content() {
        $this->expectErrorMessage("Missing Parameter: Content");

        $content = null;
        self::$validator->isContent($content);
    }

    public function test_courseValidator_should_pass_on_content() {
        $this->assertTrue(true);

        $content = "content placeholder";
        self::$validator->isContent($content);
    }

    public function test_courseValidator_on_empty_uuid() {
        $this->expectErrorMessage("Missing Parameter: UUID");

        $content = "";
        self::$validator->isUUID($content);
    }


    public function test_courseValidator_should_pass_on_uuid() {
        $this->assertTrue(true);

        $content = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        self::$validator->isUUID($content);
    }

    public function test_courseValidator_on_empty_status() {
        $this->expectErrorMessage("Missing Parameter: Status");

        $content = "";
        self::$validator->isCourseStatus($content);
    }

    public function test_courseValidator_on_invalid_status() {
        $this->expectErrorMessage("Status Value Not Found");

        $content = "not in the list";
        self::$validator->isCourseStatus($content);
    }

    public function test_courseValidator_should_pass_on_courseStatus() {
        $this->assertTrue(true);

        $arr = ["draft", "under_review", "publish"];

        foreach($arr as $content) {
            self::$validator->isCourseStatus($content);
        }
    }

}