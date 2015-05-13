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
			<div class="podcasters-wrapper">
				<!-- Test -->
				<!-- A single podcaster item will contain their profile image and name (maybe a small podcast description) -->
				<p> Please insert podcasters here! :D </p>
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