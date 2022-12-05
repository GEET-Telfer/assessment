<?php
require_once(__DIR__ . "/../validator/BaseValidator.php");

class CourseValidator extends BaseValidator
{

    /**
     * Rule for Title: Course Title cannot be empty
     */
    public function isTitle($content)
    {
        parent::isRequired($content, "Missing Parameter: Title");
    }

    /**
     * Rule for VideoLink: Not empty and string only
     */
    public function isVideoLink($content)
    {
        parent::isRequired($content, "Missing Parameter: Video Link");
        if (!is_string($content) || is_numeric($content)) {
            throw new Exception("Invalid Type of Video Link.", UNPROCESSABLE_ENTITY_ERROR);
        }
    }

    /**
     * Rule for content: Not empty
     */
    public function isContent($content)
    {
        parent::isRequired($content, "Missing Parameter: Content");
    }

    /**
     * Rule for uuid: Not empty
     */
    public function isUUID($content)
    {
        parent::isRequired($content, "Missing Parameter: UUID");
    }

    /**
     * Rule for status: value in [draft, under_review, publish]
     */
    public function isCourseStatus($content)
    {
        if( !in_array($content, STATUS_LIST)) {
			throw new Exception( "Status Value Not Found", UNPROCESSABLE_ENTITY_ERROR );
        }
    }
}
