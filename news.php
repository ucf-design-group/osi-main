<?php

/* Template Name: News */

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
						$newsQuery = new WP_QUERY(array('post_type' => 'news', 'posts_per_page' => 5, 'orderby' => 'date', 'order' => 'DESC'));
						while ($newsQuery->have_posts()) {
							$newsQuery->the_post();
							$title = get_the_title();
							$date = get_the_date('F j, Y');
							$content = get_the_excerpt();
							$link = get_permalink();
						?>
					<article class="news">
						<h2><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h2>
						<h3><?php echo $date; ?></h3>
						<?php echo $content; ?>
						<a href="<?php echo $link; ?>">Read More...</a>
					</article>
					<?php
						}
					?>

			</div>

<?php get_footer(); ?>