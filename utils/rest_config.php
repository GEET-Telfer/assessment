<?php
/**
 * WordPress REST API endpoint configuration for Assessment Questions.
 */


/**
 * Add RESTful endpoint for GETting assessment questions @/wp-json/assessment/v1/find-all
 */
add_action( 'rest_api_init', function () {
	register_rest_route(
		"assessment/v1",
		"find-all",
		[
			'methods'             => \WP_REST_Server::READABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'findAllAssessmentQuestion'
		]
	);
} );

/**
 * Add RESTful endpoint for POSTing assessment question @/wp-json/assessment/v1/add
 */
add_action( 'rest_api_init', function () {
	register_rest_route(
		"assessment/v1",
		"add",
		[
			'methods'             => \WP_REST_Server::CREATABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'createAssessmentQuestion'
		]
	);
} );

/**
 * Add RESTful endpoint for POSTing user response @/wp-json/user-response/v1/add
 */
add_action( 'rest_api_init', function () {
	register_rest_route(
		"user-response/v1",
		"add",
		[
			'methods'             => \WP_REST_Server::CREATABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'createUserResponse'
		]
	);
} );