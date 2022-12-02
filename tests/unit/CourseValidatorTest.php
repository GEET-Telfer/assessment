<?php


declare( strict_types=1 );

use PHPUnit\Framework\TestCase;

require_once( dirname( __FILE__ ) . "/../../src/validator/CourseValidator.php" );
require_once( dirname( __FILE__ ) . "/../../src/constant/constant.php" );

final class CourseValidatorTest extends TestCase {


    public function test_courseValidator_on_empty_title() {

        $this->expectErrorMessage("Missing Parameter: Title");

        $content = null;
        $validator = new CourseValidator();
        $validator->isTitle($content);

    }

    public function test_courseValidator_should_pass_on_title() {
        $this->assertTrue(true);

        $content = "this is a title";
        $validator = new CourseValidator();
        $validator->isTitle($content);
    }

    public function test_courseValidator_on_empty_videoLink() {
        $this->expectErrorMessage("Missing Parameter: Video Link");

        $content = null;
        $validator = new CourseValidator();
        $validator->isVideoLink($content);
    }

    public function test_courseValidator_on_numeric_videoLink() {
        $this->expectExceptionCode(UNPROCESSABLE_ENTITY_ERROR);

        $content = "12345";
        $validator = new CourseValidator();
        $validator->isVideoLink($content);
    }

    public function test_courseValidator_should_pass_on_videoLink() {
        $this->assertTrue(true);

        $content = "https://youtube.ca";
        $validator = new CourseValidator();
        $validator->isVideoLink($content);
    }

    public function test_courseValidator_on_empty_content() {
        $this->expectErrorMessage("Missing Parameter: Content");

        $content = null;
        $validator = new CourseValidator();
        $validator->isContent($content);
    }

    public function test_courseValidator_should_pass_on_content() {
        $this->assertTrue(true);

        $content = "content placeholder";
        $validator = new CourseValidator();
        $validator->isContent($content);
    }
}