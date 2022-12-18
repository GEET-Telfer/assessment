<?php


declare( strict_types=1 );

use PHPUnit\Framework\TestCase;

require_once( dirname( __FILE__ ) . "/../../src/constant/constant.php" );
require_once( dirname( __FILE__ ) . "/../../src/service/CourseService.php" );


final class CourseServiceTest extends TestCase {


    public function test_courseService_on_missing_parameters() {
        $this->expectErrorMessage("Invalid Request Parameters");

        $_POST["title"] = "";
        // $_POST["video_link"] = "https://youtube.ca";
        $_POST["content"] = "content placeholder";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["course_status"] = "draft";
        
        CourseService::createCourse($_POST);
    }

    public function test_courseService_on_empty_title() {
        $this->expectErrorMessage("Missing Parameter: Title");

        $_POST["title"] = "";
        $_POST["video_link"] = "https://youtube.ca";
        $_POST["content"] = "content placeholder";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["course_status"] = "draft";

        CourseService::createCourse($_POST);
    }

    public function test_courseService_on_empty_videoLink() {
        $this->expectErrorMessage("Missing Parameter: Video Link");

        $_POST["title"] = "title";
        $_POST["video_link"] = "";
        $_POST["content"] = "content placeholder";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["course_status"] = "draft";

        CourseService::createCourse($_POST);
    }

    public function test_courseService_on_numeric_videoLink() {
        $this->expectErrorMessage("Invalid Type of Video Link.");

        $_POST["title"] = "title";
        $_POST["video_link"] = "12345";
        $_POST["content"] = "content placeholder";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["course_status"] = "draft";

        CourseService::createCourse($_POST);
    }

    public function test_courseService_on_empty_content() {
        $this->expectErrorMessage("Missing Parameter: Content");

        $_POST["title"] = "title";
        $_POST["video_link"] = "http://youtube.ca";
        $_POST["content"] = "";
        $_POST["uuid"] = "45815150-a05f-4cc3-84c6-5d6318eeef3d";
        $_POST["course_status"] = "draft";

        CourseService::createCourse($_POST);
    }
}