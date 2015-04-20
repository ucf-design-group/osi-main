<?php

if (!isset($_POST['assist-form-eventname']) || $_POST['assist-form-eventname'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide the event name.");
}

if (!isset($_POST['assist-form-location']) || $_POST['assist-form-location'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide the event location.");
}

if (!isset($_POST['assist-form-attendees']) || $_POST['assist-form-attendees'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide the number of atteendees.");
}

if (!isset($_POST['assist-form-startdate']) || $_POST['assist-form-startdate'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide the event start date.");
}

if (!isset($_POST['assist-form-enddate']) || $_POST['assist-form-enddate'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide the event end date.");
}

if (!isset($_POST['assist-form-eventhost']) || $_POST['assist-form-eventhost'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide the event host.");
}

if (!isset($_POST['assist-form-contactname']) || $_POST['assist-form-contactname'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide the event contact name.");
}

if (!isset($_POST['assist-form-contactphone']) || $_POST['assist-form-contactphone'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide the event contact phone number.");
}

if (!isset($_POST['assist-form-contactemail']) || $_POST['assist-form-contactemail'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide the event contact e-mail.");
}

if (!filter_var($_POST['assist-form-contactemail'], FILTER_VALIDATE_EMAIL)) {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide a valid contact e-mail address.");
}

if (!isset($_POST['assist-form-submitteremail']) || $_POST['assist-form-submitteremail'] == "") {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide your e-mail.");
}

if (!filter_var($_POST['assist-form-submitteremail'], FILTER_VALIDATE_EMAIL)) {
	header("HTTP/1.1 406 Not Acceptable");
	die("Please provide a valid e-mail address.");
}


include($_SERVER['DOCUMENT_ROOT'] . "/resources/secrets.php");
$db = new mysqli("localhost", "osi-admin", $secrets['mysql'], "osi-web");
ini_set("SMTP", "ucfsmtp1.mail.ucf.edu");

$eventname = $db->real_escape_string($_POST['assist-form-eventname']);
$location = $db->real_escape_string($_POST['assist-form-location']);
$attendees = intval($db->real_escape_string($_POST['assist-form-attendees']));
$start = strtotime((isset($_POST['assist-form-startdate']) ? $_POST['assist-form-startdate'] : '') . 
	' ' . (isset($_POST['assist-form-starttime']) ? $_POST['assist-form-starttime'] : '') . 
	' ' . (isset($_POST['assist-form-startampm']) ? $_POST['assist-form-startampm'] : '') . " America/New_York");
$end = strtotime((isset($_POST['assist-form-enddate']) ? $_POST['assist-form-enddate'] : '') . 
	' ' . (isset($_POST['assist-form-endtime']) ? $_POST['assist-form-endtime'] : '') . 
	' ' . (isset($_POST['assist-form-endampm']) ? $_POST['assist-form-endampm'] : '') . " America/New_York");
$eventhost = $db->real_escape_string($_POST['assist-form-eventhost']);
$contactname = $db->real_escape_string($_POST['assist-form-contactname']);
$contactphone = $db->real_escape_string($_POST['assist-form-contactphone']);
$contactemail = $db->real_escape_string($_POST['assist-form-contactemail']);
$comments = $db->real_escape_string($_POST['assist-form-comments']);
$submitteremail = $db->real_escape_string($_POST['assist-form-submitteremail']);

if (!$db->query("INSERT INTO `assist-form` (eventname, location, attendees, start, end,
				eventhost, contactname, contactphone, contactemail, comments, submitteremail)
				VALUES ('" . $eventname . "', '" . $location . "', " . $attendees . ", " .
				"'" . $start . "', '" . $end . "', '" . $eventhost . "', '" . 
				$contactname . "', '" . $contactphone . "', '" . $contactemail . "', '" .
				$comments . "', '" . $submitteremail . "')")) {

	header("HTTP/1.1 406 Not Acceptable");
	die("Error: Could not save information.");
}


$recipient = "osiassist@ucf.edu";
$header = "From: OSI Assist Form <" . $submitteremail . ">";
$subject = "OSI Assist Submission: " . $eventname . " " .  date('M j, Y, g:ia', $start);

$message = "The following information was submitted using the OSI Assist web form on http://osi.ucf.edu:\r\n\r\n";

$message .= "Event: " . $eventname . "\r\n";
$message .= "Host: " . $eventhost . "\r\n";
$message .= "Start: " . date('M j, Y, g:ia', $start) . "\r\n";
$message .= "End: " . date('M j, Y, g:ia', $end) . "\r\n";
$message .= "Location: " . $location . "\r\n";
$message .= "Number of Attendees: " . $attendees . "\r\n\r\n";

$message .= "Contact: " . $contactname . "\r\n";
$message .= "Phone: " . $contactphone . "\r\n";
$message .= "Email: " . $contactemail . "\r\n\r\n";

$message .= "Comments: " . $comments . "\r\n";
$message .= "Submitter Email: " . $submitteremail . "\r\n\r\n";

$message .= "[This e-mail was automatically generated by the OSI Website in response to a form submission. Please contact osiweb@ucf.edu if you have any trouble with these e-mails.]";

if (!mail($recipient, $subject, $message, $header)) {

	header("HTTP/1.1 406 Not Acceptable");
	die("Error: Could not send information.");
}

echo "Thank you!  Your request has been sent.";

?>