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

				/* Loops through podcasts_query for every instance of a podcast post type. */
				while ($podcasts_query->have_posts()) {
					$podcasts_query->the_post();

					/* Print out single podcast */
					get_template_part( 'partials/single', 'podcast' );
				}
?>
			</section>
		</div>
	</div>
	<!-- Sidebar -->
	<aside>
		<article class="about">
			<h2> About </h2>
			<p>Lorem ipsum dolor sit amet, nec pulvinar integer voluptas metus etiam et, quisque nulla conubia donec sollicitudin, mollis wisi eu vehicula risus eget, sollicitudin fermentum tincidunt sed a nam. Luctus nunc ut odio rutrum, erat dictumst pede, gravida aliquet erat vestibulum.</p>
			<a id="apply" class="button" href="http://osi.ucf.edu/podcasts-registration/"> Apply </a>
		</article>
		<article class="podcasters">
			<h2> Podcasters </h2>
			<!-- Tentative Feature, to be determined whether or not to keep. Keep if filtering option is going to be drop-down. Or have a link to a separate page for podcasters. -->
			<div class="featured-wrapper">
				<!-- Test -->
				<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. HEY HEY HEY WHERE IS DAH OVERFLOW~~~~!!!!"</p>
				<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. HEY HEY HEY WHERE IS DAH OVERFLOW~~~~!!!!"</p>
				<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. HEY HEY HEY WHERE IS DAH OVERFLOW~~~~!!!!"</p>
				<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. HEY HEY HEY WHERE IS DAH OVERFLOW~~~~!!!!"</p>
				<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. HEY HEY HEY WHERE IS DAH OVERFLOW~~~~!!!!"</p>
				<!-- Test -->
			</div>
		</article>
	</aside>
</div>


<?php get_footer(); ?>