<?php



/* Allow Post Thumbnails to be used */

function setup_thumbnails() {

	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(150, 150);
}
add_action('after_setup_theme', 'setup_thumbnails');


/* Remove menus from the admin dashboard
 *
 * In order to use this function, uncomment "add_action(...)" at the end.
 *
 * All of the administration pages are listed here (in order of appearance in the dashboard)
 * so that you may choose which are removed.  If you remove a main page, you do not also
 * need to remove its subpages.
 *
 * Use this for cleaning up the dashboard only (example: you wish to remove the Posts link
 * because you use only custom post types).  Do not use it for security (example: to keep
 * another user from editing theme files, etc).  Roles (Editor versus Admin) and
 * Capabilities (which can be added and removed for specific roles and users) are best
 * suited for such a purpose.
 */

function remove_menus() {

	/* Pages removed for all users, including administrators. */

	remove_menu_page('edit.php');
		remove_submenu_page('edit.php', 'post-new.php');
		remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
		remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
	remove_menu_page('upload.php');
		remove_submenu_page('upload.php', 'media-new.php');
	remove_menu_page('link-manager.php');
		remove_submenu_page('link-manager.php', 'link-add.php');
		remove_submenu_page('link-manager.php', 'edit-tags.php?taxonomy=link_category');
	remove_menu_page('edit-comments.php');

	$user = wp_get_current_user();
	if (!in_array('administrator', $user->roles)) {

			remove_submenu_page('index.php', 'update-core.php');
		//remove_menu_page('edit.php?post_type=page');
			//remove_submenu_page('edit.php', 'post-new.php?post_type=page');
		remove_menu_page('themes.php');
			remove_submenu_page('themes.php', 'widgets.php');
			remove_submenu_page('themes.php', 'nav-menus.php');
			remove_submenu_page('themes.php', 'theme-editor.php');
		remove_menu_page('plugins.php');
			remove_submenu_page('plugins.php', 'plugin-install.php');
			remove_submenu_page('plugins.php', 'plugin-editor.php');
		//remove_menu_page('users.php');
			remove_submenu_page('users.php', 'user-new.php');
			//remove_submenu_page('users.php', 'profile.php');
		remove_menu_page('tools.php');
			remove_submenu_page('tools.php', 'import.php');
			remove_submenu_page('tools.php', 'export.php');
		remove_menu_page('options-general.php');
			remove_submenu_page( 'options-general.php', 'options-writing.php' );
			remove_submenu_page( 'options-general.php', 'options-reading.php' );
			remove_submenu_page( 'options-general.php', 'options-discussion.php' );
			remove_submenu_page( 'options-general.php', 'options-media.php' );
			remove_submenu_page( 'options-general.php', 'options-permalink.php' );
	}
}
add_action('admin_menu', 'remove_menus');


/* Custom Post Types */

function custom_post_types() {

	register_post_type('connections',
		array(
			'labels' => array(
				'name' => __( 'Connections' ),
				'singular_name' => __( 'Connection' )
			),
			'public' => true,
			'rewrite' => array('slug' => 'connections'),
			'supports' => array('title', 'editor', 'thumbnail'),
			'taxonomies' => array('category')
		)
	);

	register_post_type('headers',
		array(
			'labels' => array(
				'name' => __( 'Header Images' ),
				'singular_name' => __( 'Header Image' )
			),
			'public' => true,
			'rewrite' => array('slug' => 'headers'),
			'supports' => array('title', 'thumbnail')
		)
	);

	register_post_type('leadership',
		array(
			'labels' => array(
				'name' => __( 'Leadership' ),
				'singular_name' => __( 'Leader' )
			),
			'public' => true,
			'rewrite' => array('slug' => 'leadership'),
			'supports' => array('title', 'editor', 'thumbnail'),
			'taxonomies' => array('category')
		)
	);

	register_post_type('news',
		array(
			'labels' => array(
				'name' => __( 'News' ),
				'singular_name' => __( 'News Post' )
			),
			'public' => true,
			'rewrite' => array('slug' => 'news'),
			'supports' => array('title', 'editor', 'thumbnail', 'author', 'excerpt'),
			'taxonomies' => array('category')
		)
	);

	register_post_type('rso-info',
		array(
			'labels' => array(
				'name' => __( 'RSO Info Pages' ),
				'singular_name' => __( 'RSO Info Page' )
			),
			'public' => true,
			'rewrite' => array('slug' => 'rso-info'),
			'supports' => array('title', 'editor', 'page-attributes'),
			'taxonomies' => array('category'),
			'hierarchical' => true
		)
	);

	register_post_type('sidebar',
		array(
			'labels' => array(
				'name' => __( 'Sidebar Items' ),
				'singular_name' => __( 'Sidebar Item' )
			),
			'public' => true,
			'rewrite' => array('slug' => 'sidebar'),
			'supports' => array('title', 'editor')
		)
	);

	register_post_type('monthly',
		array(
			'labels' => array(
				'name' => __( 'Monthly Calendars' ),
				'singular_name' => __( 'Monthly Calendar' )
			),
			'public' => true,
			'rewrite' => array('slug' => 'monthly'),
			'supports' => array('title', 'editor', 'thumbnail'),
			'taxonomies' => array('category')
		)
	);

	register_post_type('podcast', array(
	'labels' 			=> array(
		'name' 				=> 'Podcasts',
		'singular_name' 	=> 'Podcast'),
	'public' 			=> true,
	'hierarchical' 		=> false,
	'supports' 			=> array('title', 'thumbnail', 'excerpt', 'comments'),
	'capability_type' => 'post',
	'capabilities' => array(

		/**
		 * These are capabilities that will be litigated to creative users. This section
		 * does not grant them these permissions, but instead ports the capabilities
		 * from the the post type `post` so that it will act the same way as a regular
		 * post type and permissions can be distributed to different users. 
		 */

		/* Capabilities that will be granted to creative users */
        'read'					=> 'pod_read',
		'read_posts' 			=> 'pod_read_posts',
		'create_post'			=> 'pod_create_posts',	
		'edit_post' 			=> 'pod_edit_posts',	
		'publish_posts' 		=> 'pod_publish_posts',
	 	'edit_published_post'	=> 'pod_edit_published_posts',
 		'delete_published_post'	=> 'pod_delete_published_posts',
		'delete_posts' 			=> 'pod_delete_posts',

		/* Capabilities that will be explicitly removed for creative users */
		'read_private_posts'	=> 'pod_read_private_posts',
		'edit_others_posts'	 	=> 'pod_edit_others_posts',
		'delete_private_posts'  => 'pod_delete_private_posts',
		'delete_others_posts'   => 'pod_delete_others_posts',
		'edit_private_posts'    => 'pod_edit_private_posts',
		'moderate_comments'		=> 'pod_moderate_comments',
		),

	'taxonomies' => array('category'),
	'has_archive' => false
	));

	register_post_type('podcast-registration',
		array(
			'labels' => array(
				'name' => __( 'Podcast Registrations' ),
				'singular_name' => __( 'Podcast Registration' )
			),
			'public' => false,
			'rewrite' => array('slug' => 'podcast-registration'),
			'supports' => array('title', 'editor')
		)
	);
	
}
add_action('init', 'custom_post_types');


function cpt_icons() {

	?>
	<style type="text/css" media="screen">
		#menu-posts-connections .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/connections.png) no-repeat 6px -17px !important;
		}
		#menu-posts-headers .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/header.png) no-repeat 6px -17px !important;
		}
		#menu-posts-leadership .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/leadership.png) no-repeat 6px -17px !important;
		}
		#menu-posts-news .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/news.png) no-repeat 6px -17px !important;
		}
		#menu-posts-rso-info .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/infopages.png) no-repeat 6px -17px !important;
		}
		#menu-posts-sidebar .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/sidebar.png) no-repeat 6px -17px !important;
		}
		#menu-posts-weekly .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/weekly.png) no-repeat 6px -17px !important;
		}
		#menu-posts-connections:hover .wp-menu-image, #menu-posts-connections.wp-has-current-submenu .wp-menu-image,
		#menu-posts-headers:hover .wp-menu-image, #menu-posts-headers.wp-has-current-submenu .wp-menu-image,
		#menu-posts-leadership:hover .wp-menu-image, #menu-posts-leadership.wp-has-current-submenu .wp-menu-image,
		#menu-posts-news:hover .wp-menu-image, #menu-posts-news.wp-has-current-submenu .wp-menu-image,
		#menu-posts-rso-info:hover .wp-menu-image, #menu-posts-rso-info.wp-has-current-submenu .wp-menu-image,
		#menu-posts-sidebar:hover .wp-menu-image, #menu-posts-sidebar.wp-has-current-submenu .wp-menu-image,
		#menu-posts-weekly:hover .wp-menu-image, #menu-posts-weekly.wp-has-current-submenu .wp-menu-image {
			background-position: 6px 7px!important;
		}
	</style>
	<?php
}
add_action('admin_head', 'cpt_icons');


function filter_search($query) {

	if ($query->is_search)
		$query->set('post_type', array('page', 'connections', 'leadership', 'news', 'rso-info', 'monthly'));

	return $query;
}
add_filter('pre_get_posts', 'filter_search');


// Loads upload-podcast.js script on podcasts upload page
function admin_scripts_loader($hook){
    if(in_array($hook,array("post-new.php","post.php","edit.php"))) {
        //specifically load this javascript in post editor pages
        wp_enqueue_script( 'podcast-script', get_template_directory_uri() . '/js/upload-podcast.js', array('jquery'), '1.0.0', true );
    }
}
add_action("admin_enqueue_scripts","admin_scripts_loader");



// function vnm_restrictMimeTypes($mimes) {
// 	$mimes = array(
// 	   'jpg|jpeg|jpe' => 'image/jpeg',
// 	   'png' => 'image/png',
// 	);
// }
// add_filter('upload_mimes','vnm_restrictMimeTypes');


function restrict_mime_types ( $mime_types ) {
 
 	$mime_types = array(
	   'mp3' => 'audio/mp3',
	   'ogg' => 'audio/ogg',
	);
	return $mime_types;
}
add_filter('upload_mimes', 'restrict_mime_types');

function restrict_mime_types_hint() {
	echo '</br>';
	_e( 'Acceptable podcast file types: .mp3, .ogg');
}
add_action( 'post-upload-ui', 'restrict_mime_types_hint' );


/* To include other collections of functions, include_once() the relevant files here. */

include_once("functions/functions-headers.php");
include_once("functions/functions-leadership.php");
include_once("functions/functions-nav.php");
include_once("functions/functions-news.php");
include_once("functions/functions-podcasts.php");
include_once("functions/functions-user-roles.php");
?>