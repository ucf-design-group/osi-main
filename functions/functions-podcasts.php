<?php

function podcast_meta_setup() {

	add_action('add_meta_boxes','podcast_meta_add');
	add_action('save_post','podcast_meta_save');
}
add_action('load-post.php','podcast_meta_setup');
add_action('load-post-new.php','podcast_meta_setup');


/**
 * To enable saving meta data alongside the post, we need to create a meta box
 * otherwise WordPress will just ignore `podcast_meta_save()` because there
 * it will think that there is no meta information to save. In a sense, we are 
 * tricking the CMS here (:
 */
function podcast_meta_add() {
 
	add_meta_box (
	'podcast_meta',
	'How to upload your file', 
	'podcast_meta',
	'podcast',
	'normal',
	'default');
}

/**
 * Even though we are not storing any custom variables that the user needs to input,
 * we still need to reference the post and create the form to allow for meta information
 * to be saved later in `podcast_meta_save()`
 */
function podcast_meta() {
	global $post;
	wp_nonce_field(basename( __FILE__ ), 'file-upload-form-nonce' );?> 

	<div><p>Set your post as the featured image and all other information will be taken care of on the back-end</p></div>
	<?php
}


/**
 * Here, we save the user's information so we can parse for later use on the front-end when
 * sorting and using Isotope. We store the mata information alongside the post here.
 */
function podcast_meta_save() {

	/* Variables */
	global $post;
	$post_id = $post->ID;
	$date = new DateTime();

	if (!isset($_POST['file-upload-form-nonce']) || !wp_verify_nonce($_POST['file-upload-form-nonce'], basename( __FILE__ ))) {
		return $post->ID;
	}

	$post_type = get_post_type_object($post->post_type);

	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post->ID;
	}

	$input = array();
	$input['userID'] 	= wp_get_current_user()->ID; 
	$input['username'] = wp_get_current_user()->display_name;
	$input['timestamp'] = $date->format('U = Y-m-d H:i:s') . "\n";

	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'file-upload-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'file-upload-form-' . $field, $value, true );
		else if ($value && $value != $old)
			update_post_meta($post_id, 'file-upload-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'file-upload-form-' . $field, $old);
	}
}

?>