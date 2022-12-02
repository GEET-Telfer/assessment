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
}
