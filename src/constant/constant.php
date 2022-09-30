<?php
// HTTP STATUS CODE
define( "BAD_REQUEST_ERROR", 400 );
define( "UNPROCESSABLE_ENTITY_ERROR", 422 );
define( "INTERNAL_SERVER_ERROR", 500 );
// ENTITY ENUMS
define( "COMPONENT_LIST", [
	"Commitment to Equity, Diversity & Inclusion",
	"Gender Expertise",
	"Access to Resources",
	"Program Design",
	"Program Development",
	"Program Delivery",
	"Program Evaluation"
] );
define( "ASSESSMENT_QUESTION_PARAMS", [ 'component', 'description', 'hasNA', 'scoring' ] );
define( "USER_RESPONSE_PARAMS", [ 'user_response', 'user_email', 'score' ] );
define( "EVALUATION", [ 'low', 'some', 'moderate', 'high' ] );
define( "NA_LIST", [ "", "0", "1" ] );

// ANYTHING ELSE