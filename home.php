<?php

/* Template Name: Home */

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
						$newsQuery = new WP_QUERY(array('post_type' => 'news', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC'));
						$counter = 0;

						while ($newsQuery->have_posts()) {

							$newsQuery->the_post();
							$counter++;
							$title = get_the_title();
							$date = get_the_date('F j, Y');
							$content = get_the_excerpt();
							$link = get_permalink();
							$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
?>
						<article class="news" style="background-image:url(<?php echo $image[0]; ?>)">
							<h2><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h1>
							<h3><?php echo $date; ?></h2>
							<p><?php echo $content; ?></p>
						</article>
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
				<aside>
					<article>
						<div class="fb-like" data-href="https://www.facebook.com/ucf.osi" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false"></div>
						<div><a href="https://twitter.com/UCF_OSI" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @OSI</a></div>
					</article>
<?php
					$sidebarQuery = new WP_QUERY(array('post_type' => 'sidebar', 'posts_per_page' => -1, 'orderby' => 'name', 'order' => 'ASC'));
					while ($sidebarQuery->have_posts()) {
						$sidebarQuery->the_post();
						$title = get_the_title();
						$slug = $post->post_name;
						$content = get_the_content();
						$image_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
?>
					<article>
						<h3 class="icon"><div class="<?php echo $slug; ?>"></div><?php echo $title; ?></h3>
						<p><?php echo $content; ?></p>
					</article>
<?php
					}
?>
				</aside>
			</div>

<?php get_footer(); ?>