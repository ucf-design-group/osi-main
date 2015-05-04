<?php

/**
 * SINGLE-PODCASTER-APPLICATION-HANDLER
 *
 * This template describes the functionality and parameters of which information from the 
 * podcasters application page will be processed and stored. This page takes information 
 * input from the user, verifys it as an official wordpress post, and appends it to the
 * database
 */

// Get the form and check if information has been filled out
global $post;
$post_id = $post->ID;
$errorString = "";
$errors = array();

if($_POST != null) {
	
	
	// First Name	
	if($_POST['podcaster-application-form-fname'] == '' || $_POST['podcaster-application-form-fname'] == NULL)
	    array_push($errors, 'first name');  
	// Last Name
	if($_POST['podcaster-application-form-lname'] == '' || $_POST['podcaster-application-form-lname'] == NULL)
		redirectError("last name");
	
	// Major
	if($_POST['podcaster-application-form-major'] == '' || $_POST['podcaster-application-form-major'] == NULL)
		array_push($errors, "major");
	
	// Year
	if($_POST['podcaster-application-form-year'] == '' || $_POST['podcaster-application-form-year'] == NULL)
		array_push($errors, "year");
	
	// GPA
	if($_POST['podcaster-application-form-gpa'] == '' || $_POST['podcaster-application-form-gpa'] == NULL)
		array_push($errors, "gpa");
	
	// Number of Podcasts
	if($_POST['podcaster-application-form-num-podcasts'] == '' || $_POST['podcaster-application-form-num-podcasts'] == NULL)
		array_push($errors, "number of podcasts");
	
	// Freq. of Podcasts
	if($_POST['podcaster-application-form-frequency'] == '' || $_POST['podcaster-application-form-frequency'] == NULL)
		array_push($errors, "frequency");
	
	// Length of Podcasts 
	if($_POST['podcaster-application-form-podcast-length'] == '' || $_POST['podcaster-application-form-podcast-length'] == NULL)
		array_push($errors, "podcasts length");
	
	// Podcasts Description
	if($_POST['podcaster-application-form-podcast-description'] == '' || $_POST['podcaster-application-form-podcast-description'] == NULL)
		array_push($errors, "description");
	
	// Variables
	$app_author = $_POST['podcaster-application-form-fname'] . ' ' . $_POST['podcaster-application-form-lname']; // Contatenates first and last name as post author
    $post_title = 'Podcaster Application: ' . $app_author;

    if(!(sizeof($errors) > 0)) {
	    /**
	     * This post is the parent reference point for the podcaster's application.
	     * What this allows for is a place where applications can be pulled from the
	     * database by some associated variable, and from there the parents post (this
	     * post) ID can be used to retrieve the meta inforation assocaited with the post
	     * that contains all of the applications fields that the user inputs in the 
	     * original application. It is easier to do it this way instead of making a 
	     * custom data table for this post type because WordPress already comes with
	     * functionality to create posts like this.
	     */
		$parent_post= array(
		  'post_title'    => $post_title,
		  // 'post_content'  => '',
		  'post_status'   => 'publish',
		  'post_author'   => 1/* User ID */,
		  'post_type'	  => 'podcaster_application',
		  // 'post_category' => array(8,39)
		);
	
		/* Insert the post into the database and return parent ID for meta information handling */
		$parent_id = wp_insert_post( $parent_post );
	
	 	$input = array();
		$input['fname']			= $_POST['podcaster-application-form-fname']; //
		$input['lname']			= $_POST['podcaster-application-form-lname'];
		$input['major']			= $_POST['podcaster-application-form-major'];
		$input['year']			= $_POST['podcaster-application-form-year'];
		$input['gpa']			= $_POST['podcaster-application-form-gpa'];
		$input['number']		= $_POST['podcaster-application-form-num-podcasts'];
		$input['frequency']		= $_POST['podcaster-application-form-frequency'];
		$input['length']		= $_POST['podcaster-application-form-podcast-length'];
		$input['description']	= $_POST['podcaster-application-form-podcast-description']; //
	
		foreach ($input as $field => $value) {
	
			$old = get_post_meta($post_id, 'podcaster-application-form-' . $field, true);
	
			if ($value && '' == $old)
				add_post_meta($post_id, 'podcaster-application-form-' . $field, $value, true );
			else if ($value && $value != $old)
				update_post_meta($post_id, 'podcaster-application-form-' . $field, $value);
			else if ('' == $value && $old)
				delete_post_meta($post_id, 'podcaster-application-form-' . $field, $old);
		}
				
		$errorString = "Thank you for signing up!";
		wp_redirect( "http://sdesosiwebdev1.sdes.ucf.edu/osi/podcaster-registration-complete/");
	}
	// Generate error string with missing fields appended to the end of the string.
	else {
		$errorString = "All fields are required. You are missing the following: ";
	
	    $count = 0;
        foreach ($errors as $error) {
			$count++;
			if($count == sizeof($errors) )
			    $errorString .= $error;
			else
			    $errorString .= $error . ', ';
		}	
	}
}
else
    // Debug code here - this area will be reached if the form does not have any post data.  
?>