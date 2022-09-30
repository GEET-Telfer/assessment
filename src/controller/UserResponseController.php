<?php

declare( strict_types=1 );
ini_set( 'display_errors', '1' );
ini_set( 'display_startup_errors', '1' );
error_reporting( E_ALL );
require_once( ABSPATH . 'wp-content/plugins/assessment/src/service/UserResponseService.php' );
require_once( ABSPATH . 'wp-content/plugins/assessment/src/constant/constant.php' );

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
				"user_response" => stripslashes( $_POST['user_response'] ),
				"evaluation"    => $_POST['score']
			];

			$sent = wp_mail( $to, $subject, compileEmailMessage( $message ) );
			if ( $sent ) {
				$wpdb->query( 'COMMIT' );
			} else {
				$wpdb->query( 'ROLLBACK' ); // failed to send email due to internal problems
				wp_send_json_error( "Something wrong with the server.", INTERNAL_SERVER_ERROR );
			}
		} catch ( Exception $e ) {
			$wpdb->query( 'ROLLBACK' ); // rollback before sending email.
			wp_send_json_error( $e->getMessage(), $e->getCode() );
		} finally {
			$wpdb->close();
		}
	}
	die();
}

/**
 * TODO: display summaries with html tags
 *
 * @param $message
 *
 * @return bool|string
 */
function compileEmailMessage( $message ) {
	return print_r( $message, true );
}