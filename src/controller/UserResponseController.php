<?php

declare( strict_types=1 );
ini_set( 'display_errors', '1' );
ini_set( 'display_startup_errors', '1' );
error_reporting( E_ALL );

require_once( dirname( __FILE__ ) . "/../service/UserResponseService.php" );
require_once( dirname( __FILE__ ) . "/../constant/constant.php" );
/**
 * @return void
 */
function createUserResponse(): void {
	if ( isset( $_POST ) ) {
		global $wpdb;
		// begin transaction
		try {
			$wpdb->query( 'START TRANSACTION' );
			$_POST = json_decode(file_get_contents("php://input"),true);
			$result = UserResponseService::createUserResponse( $_POST );
			// send wp_mail
			$to      = $_POST['user_email'];
			$subject = "GEET+ Assessment Report";
			$message = stripslashes( $_POST['report'] );

			// enable html content on email message
			function set_html_content_type() {
				return "text/html";
			}
			add_filter( "wp_mail_content_type", "set_html_content_type" );
			$sent = wp_mail( $to, $subject, compileEmailMessage( $message ) );
			remove_filter( "wp_mail_content_type", "set_html_content_type" );

			if ( $sent ) {
				$wpdb->query( 'COMMIT' );
				wp_send_json($result);
			} else {
				$wpdb->query( 'ROLLBACK' ); // failed to send email due to internal problems
				throw new Exception( "Something wrong with the server.", INTERNAL_SERVER_ERROR );
			}
		} catch ( Exception $e ) {
			$wpdb->query( 'ROLLBACK' ); // rollback before sending email.
			wp_send_json_error( $e->getMessage(), $e->getCode() );
		}
	}
	die();
}

/**
 * Display summaries with html tags
 * @param $message
 * @return bool|string
 */
function compileEmailMessage( $message ) {

	$reportObj = json_decode( $message, true );

	$reportMessage = "";
	foreach ( $reportObj as $key => $value ) {
		$reportMessage = $reportMessage . "<div>${key}: <span class=${value}>${value}</span></div><br>";
	}

	return "
	<!DOCTYPE html>
	<html lang=en>
		<head>
			<style>
				span {
				  display: inline; /* the default for span */
				  width: 100px;
				  height: 100px;
				  padding: 5px;
				}
				span.PASS {
				  background-color: lightblue; 
				}
				span.OK {
				  background-color: green; 
				}
				span.WARNING {
				  background-color: orangered; 
				}
			</style>
			<title>GEET+ Assessment Report</title>
		</head>
		<body>
			<h1>Report:</h1>
			${reportMessage}
		</body>
	</html>
";
}