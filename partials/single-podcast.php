<?php

/**
 * SINGLE-PODCAST
 *
 * This template describes the frame, style, and information that will be displayed per
 * individual podcast on the /podcasts page. This template should also be used across all
 * pages that require displaying a podcast as to keep the website consistant and uniform.
 */



	$audio_attachments = new WP_QUERY(array('post_type' => 'attachment', 'orderby' => 'date', 'order' => 'DESC', 'post_parent' => $post_id ));


	echo sizeof($audio_attachments);
	echo wp_get_attachment_url($post->ID);

	$audio_file = "http://osi.ucf.edu/wp-content/uploads/2015/04/";

?>

<article class="podcast-wrapper">
	<div class="podcast-thumb-wrapper">
		<?php echo get_the_post_thumbnail( $post_id, 'post-thumbnail' /* Can add attributes here*/ ); ?>			
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
				<source src="<?php $audio_file ?>" type="audio/ogg">
			 	<source src="<?php $audio_file ?>" type="audio/mpeg">
				Your browser does not support out media player
			</audio>
		</div>
	</div>
</article>