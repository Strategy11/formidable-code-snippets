<?php
/**
 * If you would like your created posts to have a parent,
 * you can set it with this code
 */
add_filter( 'frm_new_post', 'change_my_post_parent', 10, 2 );
function change_my_post_parent( $post, $args ) {
	if ( $args['form']->id == 25 ) { //change 25 to the ID of your form
		$post['post_parent'] = 30; //change 30 to the ID of your WP parent page
	}
	return $post;
}