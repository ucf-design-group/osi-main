<?php

/* Template Name: Connections */

 get_header(); ?>

			<div class="content-area">
				<div class="main"> 
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content', 'page' );
					} ?>
				</div>

					<?php
						$newsQuery = new WP_QUERY(array('post_type' => 'connections', 'posts_per_page' => -1, 'orderby' => 'name', 'order' => 'ASC'));
						while ($newsQuery->have_posts()) {
							$newsQuery->the_post();
							$title = get_the_title();
							$date = get_the_date('F j, Y');
							$content = get_the_content();
							$image = get_the_post_thumbnail();
					?>
					<article class="connection">
						<?php echo $image; ?>
						<h2><?php echo $title; ?></h2>
						<p><?php echo $content; ?></p>
					</article>
					<?php
						}
					?>

			</div>

<?php get_footer(); ?>