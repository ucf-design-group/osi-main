<?php

/**
 * SINGLE-PODCAST
 *
 * This template describes the frame, style, and information that will be displayed per
 * individual podcast on the /podcasts page. This template should also be used across all
 * pages that require displaying a podcast as to keep the website consistant and uniform.
 */


	// Gets the GUID (Location of saved file) from the `posts` table where the parent ID of the attachment is the ID of the podcast post.
	$audio_file = $GLOBALS['wpdb']->get_var("SELECT guid FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment'");
	$audio_type = $GLOBALS['wpdb']->get_var("SELECT post_mime_type FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment'");


	/* Ignore this commented code (it's safety net code for later) */
	// $attachment_ids = $GLOBALS['wpdb']->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment'");
	// $audio_attachments = array();
	// for($x = 0; $x < sizeof($attachment_ids); $x++) :
	// 	array_push($audio_attachments, $attachment_ids[$x]);  
	// endfor;

	// for($x = 0; $x != sizeof($audio_attachments); $x++) :
	// 	echo $x . ":";
	// 	echo $audio_attachments[$x]->ID;
	// endfor;


	$filename = basename( get_attached_file( $attachment_id ) ); // Just the file name

?>

<article class="podcast-wrapper">
	<div class="podcast-thumb-wrapper">
		<?php echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' /* Can add attributes here*/ ); ?>			
	</div>
	<div class="podcast-content-wrapper">
		<div class="podcast-header-wrapper">
			<!-- <div class="podcast-play-button-wrapper">
				<div class="play-button-circle">
					<i class="fa fa-play"></i>
				</div>
			</div> -->
			<div class="podcast-title-info">
				<h5><?php echo get_the_author(); ?></h3>
				<h4><?php echo get_the_title(); ?></h3>
			</div>
		</div>
		<div class="podcast-description-wrapper">
			<p><?php echo get_the_excerpt() ?></p>
		</div>
		<div class="podcast-media-wrapper"> 
			<audio controls>
				<source src="<?php echo $audio_file ?>" type="<?php echo $audio_type ?>">
				Your browser does not support out media player
			</audio>
		</div>
	</div>
</article>