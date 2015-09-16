<?php

/* Template Name: Podcasts */

get_header();?>

<div class="content-area">
	<!-- Podcast Posts -->
	<div class="column">
		<div class="main">
			<section>
				<h2>Podcasts</h2>
<?php

				/* Queries the database for `podcast` post instances */
				$podcasts_query = new WP_QUERY(array('post_type' => 'podcast', 'posts_per_page' => 5, 'orderby' => 'date', 'order' => 'DESC'));

				/* Loops through $podcasts_query for every instance of a podcast post type. */
				while ($podcasts_query->have_posts()) :
					$podcasts_query->the_post();

					/* Print out single podcast */
					get_template_part( 'partials/single', 'podcast' );

				endwhile; // End of searching for podcast posts
?>
			</section>
		</div>
	</div>
	<!-- Sidebar -->
	<aside>
		<article class="about">
			<h2> About </h2>
			<p> Interested in starting your own podcast? OSI offers all students the opportunity to create, produce, and host podcasts with professional, studio quality equipment! If you are interested in becoming a podcast star, click the apply button below to fill out the application. For more information, please contact David Oglethorpe (davido@ucf.edu).</p>
			<a id="apply" class="applicationbtn" href="<?php echo get_site_url() ?>/podcaster-application/"> Apply </a>
		</article>
		<article class="podcasters">
			<h2> Podcasters </h2>
			<!-- Tentative styling. We can have a dropdown for podcasters or use just a basic list of them. Or have a link to a separate page for podcasters. -->
			<!-- In podcasters-wrapper, it contains a collection of the podcasters that are contributing to the website. On click of the single item in the collection, the page of podcasters will be filtered to display content only from that podcaster. -->
			<!-- A single podcaster item will contain their profile image and name (maybe a small podcast description) -->
			<div class="podcasters-wrapper">
				<!-- Test -->
				<figure class="single-wrapper">
					<div class="podcaster-thumb-wrapper">
						<?php echo get_the_post_thumbnail($post->ID, 'post-thumbnail'); ?>
					</div>
					<div class="description">
						<h4><?php the_author(); ?></h4>
						<p> Supporting podcasters on UCF Campus.</p>
					</div>
				</figure>
			</div>
		</article>
	</aside>
</div>

<?php get_footer(); ?>