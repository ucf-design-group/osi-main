<?php

function podcast_meta_setup() {

	add_action('add_meta_boxes','podcast_meta_add');
	add_action('save_post','podcast_meta_save');
}
add_action('load-post.php','podcast_meta_setup');
add_action('load-post-new.php','podcast_meta_setup');


/**
 * Add meta boxes `podcast_meta()` and `podcast_preview()` to admin post page
 * @return void 
 */
function podcast_meta_add() {
 
	add_meta_box (
	'podcast_meta',
	'Upload your podcast here',
	'podcast_meta',
	'podcast',
	'normal',
	'default');

	// add_meta_box (
	// 'podcast_preview',
	// 'Podcast Preview',
	// 'podcast_preview',
	// 'podcast',
	// 'normal',
	// 'default');
}


/**
 * Even though we are not storing any custom variables that the user needs to input,
 * we still need to reference the post and create the form to allow for meta information
 * to be saved later in `podcast_meta_save()`
 * @return void
 */
function podcast_meta() {
	global $post;
	wp_nonce_field(basename( __FILE__ ), 'file-upload-form-nonce' );

	global $wpdb;
	$attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_mime_type IS NOT NULL AND post_parent = '$post->ID' AND post_status = 'inherit'");
<<<<<<< HEAD
	$filename='';
	if($attachment_id != NULL) {
		$audio_attachment = get_post($attachment_id);
		$filename = basename( get_attached_file( $attachment_id ) ); // Just the file name
    	$guid = $audio_attachment->guid;
		$attachment_status_message = '<p><i>' . $filename . '</i></p>'; //Choose a different audio file
	}
	else {
		$audio_attachment = -1;
		$attachment_id = -1;
    	$attachment_status_message = '<p><i>Select an audio file</i></p>';
    	$guid = "http://";
	}

	$upload = 
	'<label for="upload-podcast">
	    <input id="podcast-attachment" type="text" name="file-upload-podcast-attachment" value="' . $guid . '" /> 
	    <input id="upload-podcast-button" class="button" type="button" name="podcast-button" value="Upload Podcast" />
	    <br />' . $attachment_status_message . '
=======
	
	$audio_attachment = get_post($attachment_id);
	// echo  $post->ID . " " . $attachment_id . " ";
	$filename = basename( get_attached_file( $attachment_id ) ); // Just the file name


    if($attachment_id == NULL)
    	$attachment_status_message = '<p><i>Select an audio file</i></p>';
    else
    	$attachment_status_message = '<p><i>Choose a different audio file</i></p>';

    if($audio_attachment->guid == NULL)
    	$guid = "http://";
    else
    	$guid = $audio_attachment->guid;

	$upload = '<label for="upload_podcast">
	    <input id="upload_podcast" type="text" size="36" name="ad_image" value="' . $guid . '" /> 
	    <input id="upload_podcast_button" class="button" type="button" value="Upload Podcast" />
	    <br /> ' . $attachment_id . $attachment_status_message . '
>>>>>>> 5e8fa4629aaf03dacf465ce40b827551f32a085b
	</label>';
	echo $upload;
	
	/* Print out single podcast */
	// get_template_part( 'partials/single', 'podcast-preview' );
<<<<<<< HEAD
=======


>>>>>>> 5e8fa4629aaf03dacf465ce40b827551f32a085b
}


/**
 * Displays a preview of the podcast for the user
 * @return void
 */
function podcast_preview() {
	get_template_part( 'partials/single', 'podcast-preview' );
}


/**
 * Here, we save the user's information so we can parse for later use on the front-end when
 * sorting and using Isotope. We store the mata information alongside the post here.
 * @return void
 */
function podcast_meta_save() {

	/* Variables */
	global $post;
	$post_id = $post->ID;
	$date = new DateTime();

	if (!isset($_POST['file-upload-form-nonce']) || !wp_verify_nonce($_POST['file-upload-form-nonce'], basename( __FILE__ ))) {
		return $post->ID;
	}

<<<<<<< HEAD
	// Set filename address
	if(isset($_POST['upload-podcast']) && $_POST['upload-podcast'] != '')
		$filename = $_POST['upload-podcast'];
	else
		$filename = 'there was an error retrieving the filename';
=======
	// $post_type = get_post_type_object($post->post_type);

	// if (!current_user_can($post_type->cap->edit_post, $post_id)) {
	// 	return $post->ID;
	// }
>>>>>>> 5e8fa4629aaf03dacf465ce40b827551f32a085b

	$input = array();
	$input['userID'] 	= wp_get_current_user()->ID; 
	$input['username'] = wp_get_current_user()->display_name;
	$input['timestamp'] = $date->format('U = Y-m-d H:i:s') . "\n";
	$input['num-plays'] = 0;
	$input['num-views'] = 0;

	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'file-upload-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'file-upload-form-' . $field, $value, true );
		else if ($value && $value != $old)
			update_post_meta($post_id, 'file-upload-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'file-upload-form-' . $field, $old);
	}

	// $filename should be the path to a file in the upload directory.
<<<<<<< HEAD
	$filename = $_POST['file-upload-podcast-attachment'];
=======
	// $filename = $_POST['post_media'];

	// $based_filename = 

	// If the file address does not exist...
	// if(!(strlen($filename) > 0) || $filename == NULL)
	$filename = $_POST['upload_podcast'];
>>>>>>> 5e8fa4629aaf03dacf465ce40b827551f32a085b

	// The ID of the post this attachment is for.
	$parent_post_id = $post_id;

	// Check the type of file. We'll use this as the 'post_mime_type'.
	$filetype = wp_check_filetype( basename( $filename ), null );

	// Get the path to the upload directory.
	$wp_upload_dir = wp_upload_dir();

	// Prepare an array of post data for the attachment.
	$attachment = array(
		'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
		'post_mime_type' => $filetype['type'],
		'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
		'post_content'   => '',
		'post_status'    => 'inherit'
	);

	// Insert the attachment.
	$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

	// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	// Generate the metadata for the attachment, and update the database record.
	$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	wp_update_attachment_metadata( $attach_id, $attach_data );
}

?>