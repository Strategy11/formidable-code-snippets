<?php
/**
 * Use your forms to create downloads in Easy Digital Downloads.
 */
add_filter('frm_new_post', 'edd_setup_files', 10, 2);
function edd_setup_files($post, $args) {
	if ( $args['form']->id != 5 ) { //change 5 to the ID of your form
		return;
	}

	global $frm_vars;
	// don't continue if no files were uploaded
	if( ! isset( $frm_vars['media_id'] ) || empty( $frm_vars['media_id'] ) ) {
		return;
	}

	$edd_files = array();
	foreach ( (array) $frm_vars['media_id'] as $media_id ) {
		foreach ( (array) $media_id as $id ) {
			$attachment = get_post( $media_id );
			$edd_files[] = array(
				'file'      => wp_get_attachment_url( $id ),
				'condition' => '',

				// change this line to get the name you want
				'name'      => basename( $attachment->guid ),
			);
		}
	}

	$post['post_custom']['edd_download_files'] = $edd_files;
	return $post;
}
