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
			<p>Lorem ipsum dolor sit amet, nec pulvinar integer voluptas metus etiam et, quisque nulla conubia donec sollicitudin, mollis wisi eu vehicula risus eget, sollicitudin fermentum tincidunt sed a nam. Luctus nunc ut odio rutrum, erat dictumst pede, gravida aliquet erat vestibulum. Erat dictumst pede, gravida aliquet erat vestibulum.</p>
			<a id="apply" class="applicationbtn" href="http://osi.ucf.edu/podcasters-application/"> Apply </a>
		</article>
		<article class="podcasters">
			<h2> Podcasters </h2>
			<!-- Tentative styling. We can have a dropdown for podcasters or use just a basic list of them. Or have a link to a separate page for podcasters. -->
			<!-- In podcasters-wrapper, it contains a collection of the podcasters that are contributing to the website. On click of the single item in the collection, the page of podcasters will be filtered to display content only from that podcaster. -->
			<div class="podcasters-wrapper">
				<!-- Test -->
				<!-- A single podcaster item will contain their profile image and name (maybe a small podcast description) -->
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

<script type="text/javascript">

	var count = 2;
	var total = <?php echo $wp_query->max_num_pages; ?>;

	$(window).scroll(function(){
		if ($(window).scrollTop() == $(document).height() - $(window).height()) {
			if (count > total) {
				return false;
			} else {
				loadArticle(count);
				count++;
			}
		}
	});

	function loadArticle(pageNumber) {
		$.ajax({
			url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
			type:'POST',
			data:"action=inifinite_scroll&page_no=" + pageNumber + '&loop_file=loop',
			success: function(html) {
				$(".main").append(html);
			}
		});
		return false;
	}

</script>

<?php get_footer(); ?>