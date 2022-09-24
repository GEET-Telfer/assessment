<?php

declare( strict_types=1 );
ini_set( 'display_errors', '1' );
ini_set( 'display_startup_errors', '1' );
error_reporting( E_ALL );
require_once( ABSPATH . 'wp-content/plugins/assessment/includes/service/UserResponseService.php' );


define( "HTML_EMAIL_HEADERS", array( 'Content-Type: text/html; charset=UTF-8' ) );

// @email - Email address of the reciever
// @subject - Subject of the email
// @heading - Heading to place inside of the woocommerce template
// @message - Body content (can be HTML)

function send_email_woocommerce_style( $email, $subject, $heading, $message ) {

	// Get woocommerce mailer from instance
	$mailer = WC()->mailer();

	// Wrap message using woocommerce html email template
	$wrapped_message = $mailer->wrap_message( $heading, $message );

	// Create new WC_Email instance
	$wc_email = new WC_Email;

	// Style the wrapped message with woocommerce inline styles
	$html_message = $wc_email->style_inline( $wrapped_message );

	// Send the email using wordpress mail function
	$mailer->send( $email, $subject, $html_message, HTML_EMAIL_HEADERS );

}

/**
 * @return void
 */
function createUserResponse(): void {
	if ( isset( $_POST ) ) {
		$result = UserResponseService::createUserResponse( $_POST );
//		print_r($_POST);
//		echo $result;

		// send wp_mail
		$to      = "wzlpuck@gmail.com";
		$subject = "test";
		$heading = "";
		$message = "It works";
		send_email_woocommerce_style( $to, $subject, $heading, $message );
	}
	die();
}