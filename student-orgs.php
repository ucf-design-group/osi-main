<?php

/* Template Name: Student Orgs */

 get_header(); ?>

			<div class="content-area">
				<div class="column">
					<div class="main"> 
						<?php
						while (have_posts()) {
							the_post();
							get_template_part( 'content', 'page' );
						} ?>
					</div>
				</div>
				<aside>
					<h3>RSO Manual</h3>
					<ul>
						<li><a href="http://osi.ucf.edu/forms/2014-rso-manual.pdf">Official RSO Manual</a></li>
						<li><a href="http://osi.ucf.edu/forms/2013-2014_rso_presentation.pdf">RSO Orientation Presentation</a></li>
					</ul>
					<h3>Resource Topics</h3>
					<ul>
						<?php
							$infoQuery = new WP_QUERY(array('post_type' => 'rso-info', 'posts_per_page' => -1, 'orderby' => 'name', 'order' => 'ASC', 'post_parent' => 0, 'post__not_in' => array(223, 233, 238)));
							while ($infoQuery->have_posts()) {
								$infoQuery->the_post();
								$title = get_the_title();
								$link = get_permalink();
						?>
						<li><a href="<?php echo $link; ?>"><?php echo $title; ?></a></li>
					<?php } ?>
					</ul>
				</aside>
			</div>


		
<?php get_footer(); ?>