<?php

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


/**
 * Add RESTful endpoint for POSTing user response @/wp-json/user-response/v1/add
 */
add_action( 'rest_api_init', function () {
	register_rest_route(
		"user-response/v1",
		"find-all",
		[
			'methods'             => \WP_REST_Server::READABLE,
			'permission_callback' => '__return_true',
			'callback'            => 'findAllUserResponse'
		]
	);
} );