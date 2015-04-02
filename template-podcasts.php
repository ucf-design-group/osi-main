<?php

/* Template Name: Podcasts */

get_header(); ?>

			<div class="content-area">
				<div class="column">
					<div class="main"> 
						<?php
						while (have_posts()) {
							the_post();
							get_template_part( 'content', 'home' );
						} ?>
					</div>

					<section>
						<h2>News</h2>
<?php
						$newsQuery = new WP_QUERY(array('post_type' => 'podcast', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC'));
						$counter = 0;

						while ($newsQuery->have_posts()) {

							$newsQuery->the_post();
							$counter++;
							$post_id->$post->ID;



							/* The html markup */ ?>

							<div><?php echo $post_id; ?>
								<?php echo get_the_post_thumbnail( $post_id, $size, $attr ); ?> 

							<?php  
						}

						if ($counter == 0) {
?>
							<p>There is currently no news.</p>
<?php
						} 
?>
					</section>
				</div>
			</div>

<?php get_footer(); ?>