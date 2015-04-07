<?php 

/**
 * Creates user role 'Creative' with specific capabilities
 *
 * For more unformation on user roles/capabilities, view http://codex.wordpress.org/Function_Reference/add_role
 */

$result = add_role(
	'podcaster', 
	__( 'Podcaster' )
);
register_activation_hook( __FILE__, 'add_roles' );

/**
 *
 */
function add_creative_capabilities() {

	/* Gets the WordPress roles global variable */
	GLOBAL $wp_roles;

    /* Add global role capabilities */
    $wp_roles->add_cap( 'podcaster', 'read');
    // $wp_roles->remove_cap( 'podcaster', 'create_posts');
    $wp_roles->add_cap( 'podcaster', 'cr_read');
    $wp_roles->add_cap( 'podcaster', 'cr_create_posts');
    $wp_roles->add_cap( 'podcaster', 'publish_posts');
    $wp_roles->add_cap( 'podcaster', 'cr_publish_posts');
    $wp_roles->add_cap( 'podcaster', 'delete_published_posts');
    $wp_roles->add_cap( 'podcaster', 'upload_files');

    /* Add post-related role capabilities */
    $wp_roles->add_cap( 'podcaster', 'cr_read');
    $wp_roles->add_cap( 'podcaster', 'cr_create_posts');
    $wp_roles->add_cap( 'podcaster', 'cr_edit_posts');
    $wp_roles->add_cap( 'podcaster', 'cr_publish_posts');
    $wp_roles->add_cap( 'podcaster', 'cr_edit_published_posts');
    $wp_roles->add_cap( 'podcaster', 'cr_delete_published_posts');
    $wp_roles->add_cap( 'podcaster', 'cr_delete_posts');
}
add_action( 'admin_init', 'add_creative_capabilities');

?>
