<?php

function header_meta_setup() {

	add_action('add_meta_boxes','header_meta_add');
	add_action('save_post','header_meta_save');
}
add_action('load-post.php','header_meta_setup');
add_action('load-post-new.php','header_meta_setup');

function header_meta_add() {

	add_meta_box (
	'header_meta',
	'Header Information',
	'header_meta',
	'headers',
	'normal',
	'default');
}

function header_meta() {

	global $post;
	wp_nonce_field(basename( __FILE__ ), 'header-form-nonce' );

	$shade = get_post_meta($post->ID, 'header-form-shade', true) ? get_post_meta($post->ID, 'header-form-shade', true) : 'light';
	$link = get_post_meta($post->ID, 'header-form-url', true) ? get_post_meta($post->ID, 'header-form-url', true) : '';

	$selected = ($shade == 'light') ? 1 : 2;

	?>
	<style type="text/css">#header-form th {width: 200px;} #header-spacer {width: 20px;}</style>
	<table id="header-form">
		<tr>
			<th><label for="header-form-shade">Use Light or Dark OSI Logo?</label></th>
			<td id="header-spacer"></td>
			<td><input type="radio" name="header-form-shade" id="header-form-light" value="light" <?php if ($selected == 1) echo 'checked="checked"'; ?>> Light</td>
			<td id="header-spacer"></td>
			<td><input type="radio" name="header-form-shade" id="header-form-dark" value="dark" <?php if ($selected == 2) echo 'checked="checked"'; ?>> Dark</td>
		</tr>
		<div>
			<label for="header-form-url">Header URL:</label>
			<input type="text" name="header-form-url" id="header-form-url" value="<?php echo $link; ?>" />
		</div>
	</table>
	<?php
}


function header_meta_save() {

	global $post;
	$post_id = $post->ID;

	if (!isset($_POST['header-form-nonce']) || !wp_verify_nonce($_POST['header-form-nonce'], basename( __FILE__ ))) {
		return $post->ID;
	}

	$post_type = get_post_type_object($post->post_type);

	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post->ID;
	}

	$input = array();

	$input['shade'] = (isset($_POST['header-form-shade']) ? $_POST['header-form-shade'] : 'light');
	$input['url'] = (isset($_POST['header-form-url']) ? $_POST['header-form-url'] : '');
	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'header-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'header-form-' . $field, $value, true );
		else if ($value && $value != $old)
			update_post_meta($post_id, 'header-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'header-form-' . $field, $old);
	}
}

?>