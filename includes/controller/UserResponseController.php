<?php

declare( strict_types=1 );
ini_set( 'display_errors', '1' );
ini_set( 'display_startup_errors', '1' );
error_reporting( E_ALL );
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/service/UserResponseService.php' );

/**
 * @return void
 */
function createUserResponse(): void {
	if ( isset( $_POST ) ) {
		global $wpdb;
		// begin transaction
		try {
			$wpdb->query( 'START TRANSACTION' );
			$result = UserResponseService::createUserResponse( $_POST );

			// send wp_mail
			$to      = "wzlpuck@gmail.com";
			$subject = "test";
			$message = [
				"user-response" => json_decode( $_POST['user_response'] ),
				"evaluation"    => $_POST['score']
			];

			$sent = wp_mail( $to, $subject, print_r( $message ) );
			if ( $sent ) {
				$wpdb->query( 'COMMIT' );
			} else {
				$wpdb->query( 'ROLLBACK' );
				wp_send_json_error("Something wrong with the server.", 500);
			}
		} catch ( Exception $e ) {
			echo "Caught exception: " . $e->getMessage() . "\n";
			wp_send_json_error($e->getMessage(), 422);
		}
	}
	die();
}