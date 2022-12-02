<?php

/**
 * Add RESTful endpoint for POSTing assessment question @/wp-json/course/v1/add
 */
add_action( 'rest_api_init', function () {
	register_rest_route(
		"course/v1",
		"add",
		[
			'methods'             => \WP_REST_Server::CREATABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'createCourse'
		]
	);
} );

/**
 * Add RESTful endpoint for GETting assessment questions @/wp-json/assessment/v1/find-all
 */
add_action( 'rest_api_init', function () {
	register_rest_route(
		"course/v1",
		"find-all",
		[
			'methods'             => \WP_REST_Server::READABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'findAllCourse'
		]
	);
} );

add_action( 'rest_api_init', function () {
	register_rest_route(
		"course/v1",
		"get",
		[
			'methods'             => \WP_REST_Server::READABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'findCourseById'
		]
	);
} );

/**
 * Add RESTful endpoint for Deleting assessment questions @/wp-json/assessment/v1/find-all
 */
add_action( 'rest_api_init', function () {
	register_rest_route(
		"course/v1",
		"delete",
		[
			'methods'             => \WP_REST_Server::EDITABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'deleteCourse'
		]
	);
} );

add_action( 'rest_api_init', function () {
	register_rest_route(
		"course/v1",
		"update",
		[
			'methods'             => \WP_REST_Server::EDITABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'updateCourse'
		]
	);
} );