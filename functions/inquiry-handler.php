<?php

include($_SERVER['DOCUMENT_ROOT'] . "/resources/secrets.php");
include($_SERVER['DOCUMENT_ROOT'] . "/resources/recaptcha/recaptchalib.php");

if (!isset($_POST['inquiries-form-name']) || $_POST['inquiries-form-name'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide your name.");
}

if (!isset($_POST['inquiries-form-email']) || $_POST['inquiries-form-email'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide your e-mail.");
}

if (!filter_var($_POST['inquiries-form-email'], FILTER_VALIDATE_EMAIL)) {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide a valid e-mail address.");
}

if (!isset($_POST['inquiries-form-desc']) || $_POST['inquiries-form-desc'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide your inquiry.");
}

$resp = recaptcha_check_answer($secrets['recaptcha_private'], "http://osi.ucf.edu/", $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

if (!($resp->is_valid)) {
	header("HTTP/1.1 406 Not Acceptable");
	die("Error: Invalid Captcha");
}


$db = new mysqli("localhost", "osi-admin", $secrets['mysql'], "osi-web");
ini_set("SMTP", "ucfsmtp1.mail.ucf.edu");

$name = $db->real_escape_string($_POST['inquiries-form-name']);
$phone = $db->real_escape_string($_POST['inquiries-form-phone']);
$email = $db->real_escape_string($_POST['inquiries-form-email']);
$description = $db->real_escape_string($_POST['inquiries-form-desc']);

if (!$db->query("INSERT INTO `inquiries-form` (name, phone, email, description)
				VALUES ('" . $name . "', '" . $phone . "', '" . $email . "', '" .
				$description . "')")) {

	header("HTTP/1.1 406 Not Acceptable");
	die("Error: Could not save information.");
}


$recipient = "osi@ucf.edu";
$header = "From: OSI Inquiries Form <" . $email . ">";
$subject = "OSI Inquiry Submission: " . $name;

$message = "The following information was submitted using the OSI General Inquiries web form on http://osi.ucf.edu:\r\n\r\n";

$message .= "Name: " . $name . "\r\n";
$message .= "Email: " . $email . "\r\n";
$message .= "Phone: " . $phone . "\r\n\r\n";

$message .= "Inquiry: " . $description . "\r\n\r\n";

$message .= "[This e-mail was automatically generated by the OSI Website in response to a form submission. Please contact osiweb@ucf.edu if you have any trouble with these e-mails.]";

if (!mail($recipient, $subject, $message, $header)) {

	header("HTTP/1.1 406 Not Acceptable");
	die("Error: Could not send information.");
}

echo "Thank you!  Your request has been sent.";

?>