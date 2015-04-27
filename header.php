<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="X-UA-Compatible" content="chrome=1" />
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
		<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/ie.css">
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<!-- <script type="text/javascript" src="//use.typekit.net/dcr2ikj.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script> -->
		<link href='http://fonts.googleapis.com/css?family=EB+Garamond|Slabo+13px' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	</head>
<?php
	global $post;
	if ($post->post_type == "page")
		$body_class = 'class="page-' . $post->post_name . '"';
	else if ($post->post_type != "")
		$body_class = ($post->post_type != 'post') ? 'class="post-' . $post->post_type . '"' : 'class="post-default"';
	else
		$body_class = "";
?>
	<body <?php echo $body_class; ?>>
		<div class="page">
			<header>
				<div id="featured-info">
					<script>
						headers = [
<?php
					$headerQuery = new WP_QUERY(array('post_type' => 'headers', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC'));
					$counter = 0;

					while ($headerQuery->have_posts()) {

						$headerQuery->the_post();
						$title = get_the_title();
						$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
						$shade = get_post_meta($post->ID, 'header-form-shade', true);
						$link = get_post_meta($post->ID, 'header-form-url', true);
?>
						<?php if ($counter) echo ","; ?>

							{
								title: "<?php echo $title; ?>",
								src: "<?php echo $src[0]; ?>",
								shade: "<?php echo $shade; ?>",
								link: "<?php echo $link; ?>"
							}
<?php
						$counter++;
					}
?>
						];
					</script>
					
					<a href="http://osi.ucf.edu" class="featured-event" href="<?php echo $link; ?>" style="background-image: url(<?php echo $src[0] ?>)" target="_blank"></a>
					<div class="logo logo-<?php echo $shade; ?>"></div>
				</div>

				<nav class="main-menu full">
					<div class="screen-reader-text skip-link"><a href="#UPDATE ME" title="Skip to content">Skip to content</a></div>
					<div class="compact-menu"><a href="#" class="menu-toggle">Menu</a></div>
					<ul>
<?php
							$current_ID = $post->ID;

							$navQuery = array('post_type' => 'page', 'post_status' => 'publish', 'posts_per_page' => -1, 'meta_key' => 'page-form-order', 'orderby' => 'meta_value', 'order' => 'ASC');
							$navLoop = new WP_Query($navQuery);

							while ($navLoop->have_posts()) {

								$navLoop->the_post();

								$name = get_the_title();
								$link = get_permalink();
								$nav_li_class = (get_the_ID() == $current_ID) ? ' class="current" ' : '';

								if (get_post_meta($post->ID, 'page-form-visible', true) == 'show') {
							
?>
						<li<?php echo $nav_li_class; ?>><a href="<?php echo $link; ?>"><?php echo $name; ?></a></li>
<?php 							}
							} ?>
						<li>
							<form method="get" id="searchform" class="searchform" action="<?php bloginfo('home'); ?>/" role="search">
								<input type="search" class="field" name="s" value="" id="s" placeholder="Search &#133;" />
							</form>
						</li>
					</ul>
				</nav>

				<div class="agencies">
					<a target="_blank" href="http://osi.ucf.edu/cab/">CAB</a>
					<a target="_blank" href="http://osi.ucf.edu/homecoming/">Homecoming</a>
					<a target="_blank" href="http://osi.ucf.edu/knight-camp/">Knight Camp</a>
					<a target="_blank" href="http://osi.ucf.edu/knight-thon/">Knight Thon</a>
					<a target="_blank" href="http://osi.ucf.edu/kort/">KoRT</a>
					<a target="_blank" href="http://osi.ucf.edu/late-knights/">Late Knights</a>
					<a target="_blank" href="http://osi.ucf.edu/sos/">SOS</a>
					<a target="_blank" href="http://osi.ucf.edu/vucf/">Volunteer UCF</a>
					<a target="_blank" href="http://osi.ucf.edu/rosenlife/">Rosen Life</a>
					<a target="_blank" href="http://osi.ucf.edu/creativeservices/">Design Group</a>
				</div>
			</header>
<!-- HEADER END -->
