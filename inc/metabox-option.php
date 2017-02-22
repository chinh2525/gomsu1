<?php
// Meta Box and Get post meta from Meta Box class 
function ewm_metabox( $key, $args = array(), $post_id = null ) {
   if ( ! function_exists( 'rwmb_meta' ) )
        return false;
   return rwmb_meta( $key, $args, $post_id );
}

/**
 * Registering meta boxes
 * Using Meta Box plugin: http://metabox.io
 */
function ewm_register_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Tin nổi bật', 'tnxp' ),
		'pages'  => array( 'post' ), // For pages
		'fields' => array(
			array(
				'name' => esc_html__( 'Chọn bài viết?', 'tnxp' ),
				'id'   => 'tnbat',
				'type' => 'checkbox',
			),
		)
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'ewm_register_meta_boxes' );

?>