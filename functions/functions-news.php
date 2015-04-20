<?php

/* Add actions for meta box addition and saving */

function news_meta_setup() {

	add_action('add_meta_boxes','news_meta_add');
	add_action('save_post','news_meta_save', 10, 2);
}
add_action('load-post.php','news_meta_setup');
add_action('load-post-new.php','news_meta_setup');

/* Add the meta box to the post editor */

function news_meta_add() {

	add_meta_box (
		'news_meta',
		'News Expiration',
		'news_meta',
		'news',
		'side',
		'default');
}

function news_meta() {
	
	global $post;
	wp_nonce_field(basename( __FILE__ ), 'news-form-nonce' );
	$expiration = get_post_meta($post->ID, 'news-form-expiration', true) ? get_post_meta($post->ID, 'news-form-expiration', true) : 'none';

	// Make special arrangements for possibly disabling the end date/time fields

	$checked = "checked = 'checked'";
	$disabled = "";
	$style = "";
	if ($expiration == 'none') {
		$checked = "";
		$disabled = "disabled='disabled'";
		$style = "style='background-color:#EEEEEE'";
		$expiration = time();
	}

	// Begin outputting the actual box: CSS, Scripts, then two table forms.

	?>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css">
	<style type="text/css">
		#news-form-main {width: 100%;}
		#news-form-check {margin-left: 5px;}
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
	<script type="text/javascript">

		jQuery(function() {
			jQuery( "#news-form-expiration" ).datepicker({ dateFormat: "yy-mm-dd" });
		});

		var dateCheck = new RegExp('^20[0-9]{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$');

		function expirationCheck() {

			var expiration = document.getElementById('news-form-expiration');

			if (!dateCheck.test(expiration.value))
				expiration.style.backgroundColor = '#FF9999';
			else
				expiration.style.backgroundColor = '#FFFFFF';
		}

		function expirationCheckBox() {

			var checkBox = document.getElementById('news-form-check');
			var expiration = document.getElementById('news-form-expiration');

			if (checkBox.checked) {
				expiration.disabled = false;
				expiration.style.backgroundColor = '#FFFFFF';
				expirationCheck();
			}
			else {
				expiration.disabled = true;
				expiration.style.backgroundColor = '#EEEEEE';
			}
		}

	</script>
	<table id="news-form-main">
		<tr>
			<td><input type="text" name="news-form-expiration" id="news-form-expiration" value="<?php echo date('Y-m-d', $expiration);?>" <?php echo $style.' '.$disabled; ?> onchange='expirationCheck()' /></td>
			<td><input type='checkbox' name='news-form-check' id='news-form-check' value='use' <?php echo $checked; ?> onchange='expirationCheckBox()' /><span> Use Expiration</span></td>
		</tr><tr>
			<td colspan="2" id="news-form-datelabel"><em>&nbsp; <?php echo date('Y-m-d', $expiration);?></em></td>
		</tr>
	</table>
	<div id="news-form-clear"></div>
	<?php
}


/* Save the form's information on post-save */

function updates_meta_save($post_id, $post) {

	if ($parent_id = wp_is_post_revision($post_id)) 
		$post_id = $parent_id;

	if (!isset($_POST['news-form-nonce']) || !wp_verify_nonce($_POST['news-form-nonce'], basename( __FILE__ ))) {
		return $post_id;
	}

	$post_type = get_post_type_object($post->post_type);

	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post->ID;
	}

	$input = array();

	if (isset($_POST['news-form-check']) && $_POST['news-form-check'] == 'use')
		$input['expiration']= strtotime((isset($_POST['news-form-expiration']) ? $_POST['news-form-expiration'] : '') . " America/New_York");
	else
		$input['expiration'] = 'none';


	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'news-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'news-form-' . $field, $value, true );
		else if ($value && $value != $old)
			update_post_meta($post_id, 'news-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'news-form-' . $field, $old);
	}
}