<?php
$feature_post = '';
$cat_html = '';
switch ( get_post_format() ) {
	case 'image':
		$size = 'thumb-big-news';
		$images = ewm_metabox( 'image', "type=image&size=$size" );

		if ( empty( $images ) )
			break;

		if ( count($images) == 1 )
			foreach ( $images as $image ) {
				$feature_post = sprintf(
					'<a href="%s"><img src="%s" alt="%s" title="%s"></a>',
					$image['full_url'],
					$image['full_url'],
					esc_html( get_the_title() ),
					esc_html( get_the_title() )
				);
				// $feature_post .= sprintf('<div class="post-overlay center link"><a href="%s"></a></div>', get_permalink());
			}
		else {
   			wp_enqueue_script( 'jquery-flexslider' );

   			$feature_post = '<div class="blog-slider">
						<div class="flexslider">
     						<ul class="slides">';
			foreach ( $images as $image ) {
				$feature_post .= sprintf('<li><img src="%s" alt="%s" title="%s"></li>', $image['full_url'], esc_html( get_the_title() ), esc_html( get_the_title() ));
			}

			$feature_post .= '</ul></div></div>';
		}

		break;
	case 'gallery':
		$size = 'thumb-big-news';
		$images = ewm_metabox( 'images', "type=image&size=$size" );

		if ( empty( $images ) )
			break;

		wp_enqueue_script( 'jquery-flexslider' );

		$gallery_slider = 	'<div class="blog-gallery">
								<div class="slider">
     								<ul class="slides">';
		foreach ( $images as $image ) {
			$gallery_slider .= 
				sprintf('<li><a href="%s" title="%s"><img alt="%s" src="%s" title="%s"></a></li>', get_permalink(), esc_html( get_the_title() ), esc_html( get_the_title() ), $image['full_url'], esc_html( get_the_title() ));
		}

		$feature_post .= $gallery_slider . '</ul></div></div>';

		break;
	case 'video':
		$video = ewm_metabox( 'video' );
		if ( !$video ) 
			break;

		if ( filter_var( $video, FILTER_VALIDATE_URL ) ) { // display oEmbed HTML if a url exists
			if ( $oembed = @wp_oembed_get( $video ) )
				$feature_post .= $oembed;
		} else { // display oEmbed HTML if a embed code exists
			$feature_post = $video;
		}
		break;
	default:
		$size = 'thumb-big-news';

		$thumb = get_the_post_thumbnail( get_the_ID(), $size );
		if ( empty( $thumb ) )
			break;

		$feature_post .= '<a href="' . get_permalink() . '">';
		$feature_post .= get_the_post_thumbnail( get_the_ID(), $size );
		$feature_post .= '</a>';
}

if ( $feature_post )
	echo '<div class="featured-post ewm-img-wrap">' . $feature_post . $cat_html . '</div> <!-- /.featured-post -->';
else  
	echo $cat_html;
?>
