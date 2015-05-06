<?php

/**
 * PODCASTERS REGISTRATION HANDLER
 *
 * This page hangles all podcaster registrant requests that are to be passed
 * through the site and registered with the site. This will throw errors for
 * users and handle their information accordingly
 */


/**
 * IMPORTANT PRE-REQUESITES!
 *
 * Only run the following functions IFF there is a post waiting to be registered.
 * If there is no form filled out ready to be parsed and passed to the database, 
 * there there is no need to run the following functionality.
 */
if($_POST != null) {

	/**
	 * PRE-REQUESITE FORM HANDLERS
	 *
	 * These handlers determine if the form has been expired, not-completely
	 * filled out, and other errors like that. This is our data-validation and
	 * error handling section of this handler.
	 */
	/* If the registration window has passed (REGISTRATION_DEADLINE) */

	/* Conditional form statements (form validation) */
	// First name required.
	if (!isset($_POST['podcaster-form-fname']) || $_POST['podcaster-form-fname'] == "") {
		generateFormError("You need to provide your first name");
		exit();
	}
	// Last name required.
	if (!isset($_POST['podcaster-form-lname']) || $_POST['podcaster-form-lname'] == "") {
		generateFormError("You need to provide your last name");
		exit();
	}
	// E-mail required.
	if (!isset($_POST['podcaster-form-email']) || $_POST['podcaster-form-email'] == "") {
		generateFormError("You need to provide your email");
		exit();
	}
	// Valid email filter.
	// Gets url extension from email input
	$email = explode('@', $_POST['podcaster-form-email']);
	if (!filter_var($_POST['podcaster-form-email'], FILTER_VALIDATE_EMAIL) || $email[1] != 'knights.ucf.edu') {
		generateFormError("This even is for current UCF students only. Please provide a valid knights email address");
		exit();
	}
	// Phone number required.
	if (!isset($_POST['podcaster-form-major']) || $_POST['podcaster-form-major'] == "") {
		generateFormError("You need to provide your major");
		exit();
	}
	// Shirt size number required.
	if (!isset($_POST['podcaster-form-year']) || $_POST['podcaster-form-year'] == "") {
		generateFormError("You need to provide your estimated year");
		exit();
	}
	// Emergency contact name required.
	if (!isset($_POST['podcaster-form-gpa']) || $_POST['podcaster-form-gpa'] == "") {
		generateFormError("You need to provide your GPA");
		exit();
	}
	// Emergency phone number required.
	if (!isset($_POST['podcaster-form-num-podcasts']) || $_POST['podcaster-form-num-podcasts'] == "") {
		generateFormError("You need to provide how many podcasts you think you'll make");
		exit();
	}
	// Emergency contact relation required.
	if (!isset($_POST['podcaster-form-ec-relation']) || $_POST['podcaster-form-ec-relation'] == "") {
		generateFormError("You need to provide your emergency contact's relation to you");
		exit();
	}
	// Emergency contact relation required.
	if (!isset($_POST['podcaster-form-frequency']) || $_POST['podcaster-form-frequency'] == "") {
		generateFormError("You need to provide how often you think you'll be uploading podcasts");
		exit();
	}
	// Emergency contact relation required.
	if (!isset($_POST['podcaster-form-podcast-length']) || $_POST['podcaster-form-podcast-length'] == "") {
		generateFormError("You need to provide how long your podcasts will be");
		exit();
	}
	// Emergency contact relation required.
	if (!isset($_POST['podcaster-form-podcast-description']) || $_POST['podcaster-form-podcast-description'] == "") {
		generateFormError("You need to provide what topic you'll be covering in your podcasts");
		exit();
	}


	/**
	 * DATABASE CONNECTION AND FORM DATA PREPERATION
	 * 
	 * This section litigates how information form the form is handled and 
	 * palced on the database. Firstly, the connection is established, and
	 * the data parsed. Once all form data has been successfully validated,
	 * the information is placed into the appropriate for on the local
	 * database where it can be later accessed at...
	 * http://sdesosiweb1.sdes.osi.ucf.edu/phpymadmin
	 */

	/**
	 * This connects to the cab-ltk5k table in the local database (localhost) 
	 * with the user/pass creds (osi-admin/Design&Dev). 
	 */

	// Connect to database.
	$conn = mysql_connect($servername, "osi-admin", "Design&Dev");
	// Connect to database using MySqli protocol.
	$conn = mysqli_connect($servername, "osi-admin", "Design&Dev");
	if (!$conn){
		generateFormError("Connection failed: " . mysqli_connect_error());
		exit();
	}

	// Create new Registrant object (placeholder for runner/volunteer)
	$registrant = new Registrant;

	/**
	 *  Assign registrant's characteristics from form. Because this information
	 *  is being passed to a database, it needs to be parsed for any special
	 *  characters that are not allowed in a MySql database. For this, we use
	 *  mysql_real_escape_string() to remove any non-standard special characters.
	 */
	$reg->first_name 			= mysql_real_escape_string($_POST['podcaster-form-fname']);
	$reg->last_name 			= mysql_real_escape_string($_POST['podcaster-form-lname']);
	$reg->email 				= mysql_real_escape_string($_POST['podcaster-form-email']);
	$reg->phone 				= mysql_real_escape_string($_POST['podcaster-form-phone']);
	$reg->role 					= mysql_real_escape_string($_POST['podcaster-form-role']);
	$reg->emergency_name		= mysql_real_escape_string($_POST['podcaster-form-ec-name']);
	$reg->emergency_phone		= mysql_real_escape_string($_POST['podcaster-form-ec-phone']);
	$reg->emergency_relation	= mysql_real_escape_string($_POST['podcaster-form-ec-relation']);
	$reg->shirt_size			= mysql_real_escape_string($_POST['podcaster-form-shirt-size']);

	/**
	 * Create a database table if one does not exist.
	 *
	 * Instead of going into phpmyadmin and manually entering data values to create
	 * a new database table, here's quick script that will create a database table
	 * if one does not already exist. This can be used in other places to quickly 
	 * create more tables if necessary.
	 */
	
	// If the registrant is a runner
	if($reg->role == 'runner'){

		// Switch role to Runners in preperation for placing in the appropriate
		// database table.
		$tableName = "Runners";

		// Check to make sure the database table exists.
		if(table_exists($tableName, $database)){
			// do nothing if a value is returned (means table exists).
		}
		// If this is reached, it indicates that a table does not exist.
		else {

			// Create new connection to database
			$conn = new mysqli($servername, 'osi-admin', 'Design&Dev', $database);

			/**
			 * Create a new database table 'Runners' that will hold all information
			 * pertaining to registered runners.
			 *
			 * @var int auto-incrementing counter
			 * @var varchar first name				
			 * @var varchar last name
			 * @var varchar email
			 * @var int phone number
			 * @var varchar shirt size
			 * @var varchar emergency contact name
			 * @var int emergency contact phone number
			 * @var varchar emergency contact relation	
			 */
			$sql = "CREATE TABLE Runners (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(60) NOT NULL,
				email VARCHAR(100) NOT NULL,
				phone VARCHAR(10) NOT NULL,
				shirt_size VARCHAR(2) NOT NULL,
				emergency_name VARCHAR(60) NOT NULL,
				emergency_phone VARCHAR(10) NOT NULL,
				emergency_relation VARCHAR(20) NOT NULL,
				registration_date VARCHAR(20) NOT NULL
			)";
		
			// Check if the database table is created successfully.
			if ($conn->query($sql) === TRUE){}
			    // echo "Table ". $tableName ." created successfully";
			else{}
				// If there was an error...
			    // echo "Error creating table: " . $conn->error;

		// Close the connection to the database and break from the switch.
		$conn->close();
		break;
		}	
	}
	// If the registrant is a volunteer.
	else {

		// This is the same code as the code above, but instead, it creates a table
		// called Volunteers rather than Runners with the same information.
		
		$tableName = "Volunteers";
		
		if(table_exists($tablename, $database)){
			echo "volunteers break"; break;
		}
		else {
			$conn = new mysqli($servername, 'osi-admin', 'Design&Dev', $database);
			$sql = "CREATE TABLE Volunteers (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(60) NOT NULL,
				email VARCHAR(100) NOT NULL,
				phone VARCHAR(10) NOT NULL,
				shirt_size VARCHAR(2) NOT NULL,
				emergency_name VARCHAR(60) NOT NULL,
				emergency_phone VARCHAR(10) NOT NULL,
				emergency_relation VARCHAR(20) NOT NULL,
				registration_date VARCHAR(20) NOT NULL
			)";

			if ($conn->query($sql) === TRUE){}
			    // echo "Table ". $tableName ." created successfully";
			else{}
			    // echo "Error creating table: " . $conn->error;
		}
	}


	// Query the Runners table for all elements with the same email as the one being registered. 
	// Return the result as a boolean value. 
	$emailcheck = mysqli_query($conn,"SELECT * FROM Runners WHERE email='".$reg->email."'");

	// If no objects are returned, also check the Volunteers table. 
	if (!(mysqli_num_rows($emailcheck) > 0 ))
		$emailcheck = mysqli_query($conn,"SELECT * FROM Volunteers WHERE email='".$reg->email."'");


	// If the e-mail has already been used, return email already used error.
	if(mysqli_num_rows($emailcheck) > 0 ){
		header("HTTP/1.1 406 Unaccepatable");
		generateFormError("This email address has already been used. Please email cabevent@ucf.edu to change your information.");
		exit();
	}

	/**
	 * Switch statement to check if either registration grouping is filled up.
	 */
	if ($reg->role == 'runner') {

		// If the runner count is greater than or equal to the max number
		// of possible runners, then return registration full error.
		if ($count['runners'] >= NUM_RUNNERS) {
			header("HTTP/1.1 406 Unaccepatable");
			generateFormError("Sorry, all of the runner spots are taken.");
			exit();
		}
	}
	else {

		// Continue with statement.
		if ($count['volunteers'] >= NUM_VOLUNTEERS) {
			header("HTTP/1.1 406 Unacceptable");
			generateFormError("Sorry, all of the volunteer spots are taken.");
			exit();
		}
	}



	/**
	 * DATABASE HANDLING FUNCTIONALITY
	 *
	 * At this point, if the script execution has made it this far, the data is
	 * approrpiate and can be placed in the database. This script will handle 
	 * passing the form information from the site to the database. This also 
	 * handles errors with the form and other data parsing errors associated with 
	 * sending the information to the database.
	 */

	/**
	 * There are two tables, Runners and Volunteers. This script takes the
	 * registrant's information and palces it in the appropriate tables according
	 * to role. 
	 *
	 * INSERT INTO will request the desired table to which we pass the registrant's
	 * role ($reg->role).
	 *
	 * From there, the rest of the informamtion is placed in the aprropriate table
	 * accordingly. These table values fall in the VALUES() function.
	 * 
	 * *NOTE* You'll notice the first parameter is NULL. This is to leave a space
	 * for the table key, which is essential to parse the table. This space must be
	 * left open for a numerical key value to be automatically placed in it.
	 */
	$conn = new mysqli($servername, 'osi-admin', 'Design&Dev', $database);
	$sql = "INSERT INTO " . $tableName . 
		"(firstname, lastname, email, phone, shirt_size, emergency_name, emergency_phone, emergency_relation, registration_date)" .
		" VALUES ('" . $reg->first_name .
		"', '" . $reg->last_name .
		"', '" . $reg->email . 
		"', '" . $reg->phone . 
		"', '" . $reg->shirt_size .
		"', '" . $reg->emergency_name .
		"', '" . $reg->emergency_phone .
		"', '" . $reg->emergency_relation .
		"', '" . date("Y-m-d H:i:s") . "')";  // Registrers date when record was created.

	// Check to make sure registration was completed successfully.
	if ($conn->query($sql) === TRUE) {
	    // echo "New record created successfully";
	} else {
	    // echo "Error: " . $sql . "<br>" . $conn->error;
	}

	// Close connection to database.
	$conn->close();

	/**
	 * If this area has been reached, then the participant was successfully
	 * registered and can continue onto the confirmation page.
	 */
	confirmRegistration();
	exit();
}
?>













































