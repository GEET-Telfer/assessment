<?php
// HTTP STATUS CODE
define( "BAD_REQUEST_ERROR", 400 );
define( "UNPROCESSABLE_ENTITY_ERROR", 422 );
define( "INTERNAL_SERVER_ERROR", 500 );
define("METHOD_NOT_ALLOWED", 405);
define("MISSING_PARAMETER_ERROR", 490);
// ENTITY ENUMS
define( "COMPONENT_LIST", [
	"Commitment to Equity, Diversity and Inclusion",
	"Gender Expertise",
	"Access to Resources",
	"Program Design",
	"Program Development",
	"Program Delivery",
	"Program Evaluation"
] );
define( "COMPONENT_ABBREV_LIST", [
	"Commitment",
	"Expertise",
	"Resources",
	"Design",
	"Development",
	"Delivery",
	"Evaluation"
] );

define( "ASSESSMENT_QUESTION_PARAMS", [ 'component', 'description', 'hasNA', 'scoring' ] );
define( "USER_RESPONSE_PARAMS", [ 'user_response', 'user_email', 'score' ] );
define( "COURSE_PARAMS", ["title", "video_link", "content"]);
define( "EVALUATION", [ "WARNING", "OK", "PASS"] );
define( "NA_LIST", [ "", "0", "1", true, false ] );
define( "STATUS_LIST", ["draft", "under_review", "publish"]);
// ANYTHING ELSE