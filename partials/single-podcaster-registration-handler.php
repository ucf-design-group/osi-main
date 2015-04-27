<?php

/**
 * SINGLE-PODCASTER-APPLICATION-HANDLER
 *
 * This template describes the functionality and parameters of which information from the 
 * podcasters application page will be processed and stored. This page takes information 
 * input from the user, verifys it as an official wordpress post, and appends it to the
 * database
 */

if(isset($_POST['new_post']) == '1') {
    $post_title = 'Podcaster Application: ';
    $post_category = $_POST['cat'];
    $post_content = $_POST['post_content'];

    $new_post = array(
          'ID' => '',
          'post_author' => $user->ID, 
          'post_category' => array($post_category),
          'post_content' => $post_content, 
          'post_title' => $post_title,
          'post_status' => 'publish'
        );

    $post_id = wp_insert_post($new_post);

    // This will redirect you to the newly created post
    $post = get_post($post_id);
    wp_redirect($post->guid);
}      
?>