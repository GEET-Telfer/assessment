<?php

/**
 * Add RESTful endpoint for GETting published courses @/wp-json/course/v1/find-all
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

/**
 * Add RESTful endpoint for GETting a published course @/wp-json/course/v1/get
 */
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

########################################### For Admin ###########################################

/**
 * Add RESTful endpoint for POSTing course @/wp-json/course/v1/add
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
 * Add RESTful endpoint for Deleting course @/wp-json/course/v1/delete
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

/**
 * Add RESTful endpoint for retrieving all course @/wp-json/course/v1/update
 */
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

/**
 * Add RESTful endpoint for retrieving all courses @/wp-json/admin/course/v1/find-all
 */
add_action( 'rest_api_init', function () {
	register_rest_route(
		"admin/course/v1",
		"find-all",
		[
			'methods'             => \WP_REST_Server::READABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'findAllCourse4Admin'
		]
	);
} );

/**
 * Add RESTful endpoint for retrieving a course @/wp-json/admin/course/v1/get
 */
add_action( 'rest_api_init', function () {
	register_rest_route(
		"admin/course/v1",
		"get",
		[
			'methods'             => \WP_REST_Server::READABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'findCourseById4Admin'
		]
	);
} );