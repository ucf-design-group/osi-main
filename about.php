<?php

/* Template Name: About */

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
						$leaders = array(
							"director" => array(),
							"assoc_directors" => array(),
							"asst_directors" => array(),
							"coordinators" => array(),
							"office_staff" => array(),
							"grad_assts" => array());

						$leaderQuery = new WP_QUERY(array('post_type' => 'leadership', 'posts_per_page' => -1, 'meta_key' => 'leader-form-order', 'orderby' => 'meta_value', 'order' => 'ASC'));
						
						while ($leaderQuery->have_posts()) {

							$leaderQuery->the_post();
							$leader = array();

							$leader["title"] = get_the_title();
							$leader["position"] = get_post_meta($post->ID, 'leader-form-position', true);
							$leader["content"] = get_the_content();
							$leader["email"] = get_post_meta($post->ID, 'leader-form-email', true);
							$leader["image"] = get_the_post_thumbnail($post->ID, 'medium');
							$leader["slug"] = $post->post_name;
							$category = get_the_category();
							$leader["category"] = $category[0]->cat_name;

							switch ($leader["category"]) {
								case "Director":
									array_push($leaders["director"], $leader);
									break;
								case "Associate Directors":
									array_push($leaders["assoc_directors"], $leader);
									break;
								case "Assistant Directors":
									array_push($leaders["asst_directors"], $leader);
									break;
								case "Coordinators":
									array_push($leaders["coordinators"], $leader);
									break;
								case "Office Staff":
									array_push($leaders["office_staff"], $leader);
									break;
								case "Graduate Assistants":
									array_push($leaders["grad_assts"], $leader);
									break;
							}
						}
?>
					<h2 class="title">Director</h2>
<?php
						foreach ($leaders["director"] as $director) {
?>

					<article id="<?php echo $slug; ?>" class="leader">

						<div><?php echo $director["image"]; ?></div>
						<h3><strong><?php echo $director["title"]; ?></strong></h3>
						<p><a href="mailto:<?php echo $director['email']; ?>"><?php echo $director['email']; ?></a></p>
						<p><?php echo $director["content"]; ?></p>
					</article>
<?php
						}
?>

					<h2 class="title">Associate Directors</h2>
<?php
						foreach ($leaders["assoc_directors"] as $associate) {
?>

					<article id="<?php echo $slug; ?>" class="leader">

						<div><?php echo $associate["image"]; ?></div>
						<h3><strong><?php echo $associate["title"]; ?></strong> - <?php echo $associate['position']; ?></h3>
						<p><a href="mailto:<?php echo $associate['email']; ?>"><?php echo $associate['email']; ?></a></p>
						<p><?php echo $associate["content"]; ?></p>
					</article>
<?php
						}
?>

					<h2 class="title">Assistant Directors</h2>
<?php
						foreach ($leaders["asst_directors"] as $assistant) {
?>

					<article id="<?php echo $slug; ?>" class="leader">

						<div><?php echo $assistant["image"]; ?></div>
						<h3><strong><?php echo $assistant["title"]; ?></strong> - <?php echo $assistant['position']; ?></h3>
						<p><a href="mailto:<?php echo $assistant['email']; ?>"><?php echo $assistant['email']; ?></a></p>
						<p><?php echo $assistant["content"]; ?></p>
					</article>
<?php
						}
?>

					<h2>Coordinators</h2>
<?php
						foreach ($leaders["coordinators"] as $coordinator) {
?>

					<article id="<?php echo $slug; ?>" class="leader">

						<div><?php echo $coordinator["image"]; ?></div>
						<h3><strong><?php echo $coordinator["title"]; ?></strong> - <?php echo $coordinator['position']; ?></h3>
						<p><a href="mailto:<?php echo $coordinator['email']; ?>"><?php echo $coordinator['email']; ?></a></p>
						<p><?php echo $coordinator["content"]; ?></p>
					</article>
<?php
						}
?>

					<h2>Office Staff</h2>
<?php
						foreach ($leaders["office_staff"] as $staff) {
?>

					<article id="<?php echo $slug; ?>" class="leader">

						<div><?php echo $staff["image"]; ?></div>
						<h3><strong><?php echo $staff["title"]; ?></strong> - <?php echo $staff['position']; ?></h3>
						<p><a href="mailto:<?php echo $staff['email']; ?>"><?php echo $staff['email']; ?></a></p>
						<p><?php echo $staff["content"]; ?></p>
					</article>
<?php
						}
?>

					<h2>Graduate Assistants</h2>
<?php
						foreach ($leaders["grad_assts"] as $grad) {
?>

					<article id="<?php echo $slug; ?>" class="leader">

						<div><?php echo $grad["image"]; ?></div>
						<h3><strong><?php echo $grad["title"]; ?></strong> - <?php echo $grad['position']; ?></h3>
						<p><a href="mailto:<?php echo $grad['email']; ?>"><?php echo $grad['email']; ?></a></p>
						<p><?php echo $grad["content"]; ?></p>
					</article>
<?php
						}
?>

			</div>

<?php get_footer(); ?>