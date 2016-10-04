<?php
########################################################
### CONFIG ###
########################################################
const YOUR_EMAIL = 'devorah@langsam.org';
//define a math problem as a field in your form to prevent spam;
//or use a word problem with a string as the answer, but be careful since the case and spelling of the user's answer will need to be exact
const ANSWER = 5;
########################################################
########################################################
//ensure that they submitted all the fields and answered the question correctly
if( !isset($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['message'], $_REQUEST['answer']) || ANSWER != $_REQUEST['answer'] ){
	http_response_code(400); //client error
	die();
}
//capture and sanitize their answers
$name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
$message = filter_var($_REQUEST['message'], FILTER_SANITIZE_STRING);
//add their name+email at the end of their message
$message .= '<br><br><b>From: <a href="mailto:'.$email.'">'.$name.' &lt;'.$email.'&gt;</a></b>';
//configure the message
$subject = 'Message from Portfolio Contact Form';
$headers = array(
    'From: '.YOUR_EMAIL,
    'Content-Type:text/html;charset=UTF-8',
    'Reply-To: '.$name.' <'.$email.'>'
);
$headers = implode("\r\n", $headers); //MUST be double quotes
//send the mail
$mailSuccess = mail( YOUR_EMAIL, $subject, $message, $headers );
//NOTE: just because this function succeeds doesn't mean that the message successfully sent
//reasons for not receiving email: their/your email isn't legit; the mailserver is incorrectly configured; server-level spam detection
//return the request as appropriate
if( $mailSuccess ){
	http_response_code(200); //success
} else {
	http_response_code(500); //server error
}
die();