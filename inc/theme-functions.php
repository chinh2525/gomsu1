<?php
if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function ewm_wp_title( $title, $sep ) {
	if ( is_feed() )
		return $title;

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title .= " $sep " . sprintf( esc_html__( 'Pagde %s', 'flip' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'ewm_wp_title', 10, 2 );

/**
 * Title shim for sites older than WordPress 4.1.
 *
 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
 * @todo Remove this function when WordPress 4.3 is released.
 */
function ewm_render_title() {
	?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
}
add_action( 'wp_head', 'ewm_render_title' );
endif;

/**
 * Show feature media for post format: images, video, gallery, etc.
 */
function ewm_entry_media() {
	$html = '';
	switch ( get_post_format() ) {
		case 'image':
			$size = 'big-post-thumbs';
			$image = array_values( ewm_metabox( 'image', "type=image&size=$size" ) );

			if ( empty( $image ) )
				break;

			$html = sprintf(
				'<a class="post-thumb" href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s"></a>',
				get_permalink(),
				the_title_attribute( 'echo=0' ),
				$image[0]['url']
			);
			break;
		case 'gallery':
			$size = 'big-post-thumbs';
			$images = ewm_metabox( 'images', "type=image&size=$size" );

			if ( empty( $images ) )
				break;

			$html .= '<div class="flexslider">';
			$html .= '<ul class="slides">';
			foreach ( $images as $image ) {
				$html .= sprintf(
					'<li><a href="%s"><img src="%s" alt="%s"></a></li>',
					$image['full_url'],
					$image['url'],
					the_title_attribute( 'echo=0' )
				);
			}
			$html .= '</ul>';
			$html .= '</div>';
			break;
		case 'video':
			$video = ewm_metabox( 'video' );
			if ( !$video )
				break;

			// If URL: show oEmbed HTML
			if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
				if ( $oembed = @wp_oembed_get( $video ) )
					$html .= $oembed;
			} else { // If embed code: just display 
				$html .= $video;
			}
			break;
		default:
			$size = 'big-post-thumbs';
			$image = get_the_post_thumbnail( get_the_ID(), $size );

			if ( empty( $image ) )
				return;

			$html .= '<a class="post-thumb" href="' . get_permalink() . '">';
			$html .= get_the_post_thumbnail( get_the_ID(), $size );
			$html .= '</a>';
	}

	if ( $html )
		echo "<div class='post-media'>$html</div>";
}

/**
 * Show feature media for post portfolio format: images, video, gallery, etc.
 */
function portfolio_entry_media() {
	$html = '';
	switch ( get_post_format() ) {
		case 'image':
			$size = '770x405';
			$image = array_values( ewm_metabox( 'image', "type=image&size=$size" ) );

			if ( empty( $image ) )
				break;

			$html = sprintf(
				'<a class="post-thumb" href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s"></a>',
				get_permalink(),
				the_title_attribute( 'echo=0' ),
				$image[0]['url']
			);
			break;
		case 'gallery':
			$size = '770x405';
			$images = ewm_metabox( 'images', "type=image&size=$size" );

			if ( empty( $images ) )
				break;

			$html .= '<div class="flexslider">';
			$html .= '<ul class="slides">';
			foreach ( $images as $image ) {
				$html .= sprintf(
					'<li><a href="%s"><img src="%s" alt="%s"></a></li>',
					$image['full_url'],
					$image['url'],
					the_title_attribute( 'echo=0' )
				);
			}
			$html .= '</ul>';
			$html .= '</div>';
			break;
		case 'video':
			$video = ewm_metabox( 'video' );
			if ( !$video )
				break;

			// If URL: show oEmbed HTML
			if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
				if ( $oembed = @wp_oembed_get( $video ) )
					$html .= $oembed;
			} else { // If embed code: just display 
				$html .= $video;
			}
			break;
		default:
			$size = 'big-post-thumbs';
			$image = get_the_post_thumbnail( get_the_ID(), $size );

			if ( empty( $image ) )
				return;

			$html .= '<a class="post-thumb" href="' . get_permalink() . '">';
			$html .= get_the_post_thumbnail( get_the_ID(), $size );
			$html .= '</a>';
	}

	if ( $html )
		echo "<div class='post-media'>$html</div>";
}

if ( ! function_exists( 'ewm_entry_title' ) ) :
/**
 * Show post title
 *
 * @since ewm 1.0
 */
function ewm_entry_title() {
	if ( ! ( $title = get_the_title() ) )
		return;

	if ( is_single() ) :
		the_title( '<h1 class="title-post">', '</h1>' );
	else :
		the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
	endif;
}
endif;

if ( ! function_exists( 'ewm_entry_content' ) ) :
/**
 * Display entry content or summary
 *
 * @since ewm 1.0
 */
function ewm_entry_content() {
	echo '<div class="entry-content">';
	if ( is_single() ) {
		the_content();
		wp_link_pages( array(
			'before'      => '<p class="pages">' . esc_html__( 'Pages:', 'flip' ),
			'after'       => '</p>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
		echo '</div><!-- /.entry-content -->';
		return;
	}
	// Excerpt
	the_excerpt();
	echo '</div><!-- /.entry-content -->';
}
endif;

if ( ! function_exists( 'ewm_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories and tags.
 *
 * @since ewm 1.0
 */
function ewm_entry_footer() {
	global $smof_data;
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) : ?>
		<span class="categories">

		<?php 
			if ( is_single() ) { 
				if( (bool)$smof_data['single-tags'] ) 
					echo '<span>'. esc_html__( 'Tags: ', 'flip' ) .'</span>'. get_the_tag_list( '', ', ' );
				elseif( (bool)$smof_data['single-categories'] ) {
					esc_html_e( 'Categories: ', 'flip' ); 
					the_category( ', ' );
				}
			}
			else {
				esc_html_e( 'Categories: ', 'flip' ); 
				the_category( ', ' );
			}
		?>
		</span>
	<?php endif;
	edit_post_link( esc_html__( 'Edit', 'flip' ), '<span class="post-edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_ewm_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_ewm_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'flip' ); ?></h2>
		<div class="nav-links clearfix">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts 3', 'flip' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'flip' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


if ( !function_exists('ewm_social_array') ) :
/**
 * Social array
 *
 * @since ewm 1.0
 */
function ewm_social_array(){
	return array(
		'facebook'		=>	esc_html__('Facebook','flip'),
		'twitter'		=>	esc_html__('Twitter','flip'),
		'google-plus'	=>	esc_html__('Google+','flip'),
		'linkedin'	 	=>	esc_html__('LinkedIn','flip'),
		'tumblr'	 	=>	esc_html__('Tumblr','flip'),
		'pinterest'	 	=>	esc_html__('Pinterest','flip'),
		'youtube'	 	=>	esc_html__('YouTube','flip'),
		'skype'	 		=>	esc_html__('Skype','flip'),
		'instagram'	 	=>	esc_html__('Instagram','flip'),
		'delicious'	 	=>	esc_html__('Delicious','flip'),
		'digg'		 	=>	esc_html__('Digg','flip'),
		'reddit'		=>	esc_html__('Reddit','flip'),
		'stumbleupon'	=>	esc_html__('StumbleUpon','flip'),
		'wordpress'	 	=>	esc_html__('Wordpress','flip'),
		'joomla'		=>	esc_html__('Joomla','flip'),
		'blogger'	 	=>	esc_html__('Blogger','flip'),
		'vimeo'	 		=>	esc_html__('Vimeo','flip'),
		'yahoo'	 		=>	esc_html__('Yahoo!','flip'),
		'flickr'	 	=>	esc_html__('Flickr','flip'),
		'picassa'	 	=>	esc_html__('Picasa','flip'),
		'deviantart'	=>	esc_html__('DeviantArt','flip'),
		'github'	 	=>	esc_html__('GitHub','flip'),
		'stackoverflow'	=>	esc_html__('StackOverFlow','flip'),
		'xing'	 		=>	esc_html__('Xing','flip'),
		'flattr'	 	=>	esc_html__('Flattr','flip'),
		'foursquare'	=>	esc_html__('Foursquare','flip'),
		'paypal'	 	=>	esc_html__('Paypal','flip'),
		'yelp'	 		=>	esc_html__('Yelp','flip'),
		'soundcloud'	=>	esc_html__('SoundCloud','flip'),
		'lastfm'	 	=>	esc_html__('Last.fm','flip'),
		'lanyrd'	 	=>	esc_html__('Lanyrd','flip'),
		'dribbble'	 	=>	esc_html__('Dribbble','flip'),
		'forrst'	 	=>	esc_html__('Forrst','flip'),
		'steam'	 		=>	esc_html__('Steam','flip'),
		'behance'		=>	esc_html__('Behance','flip'),
		'mixi'			=>	esc_html__('Mixi','flip'),
		'sina-weibo'	=>	esc_html__('Weibo','flip'),
		'renren'		=>	esc_html__('Renren','flip'),
		'evernote'		=>	esc_html__('Evernote','flip'),
		'dropbox'		=>	esc_html__('Dropbox','flip'),
		'bitbucket'		=>	esc_html__('Bitbucket','flip'),
		'trello'		=>	esc_html__('Trello','flip'),
		'vk'			=>	esc_html__('VKontakte','flip'),
		'home'			=>	esc_html__('Homepage','flip'),
		'envelope-o'	=>	esc_html__('Email','flip'),
		'feed'			=>	esc_html__('RSS','flip'),
	);
}
endif;

if ( ! function_exists( 'ewm_entry_postdate' ) ) :
/**
 * Prints HTML with meta information for the categories and tags.
 *
 * @since ewm 1.0
 */
function ewm_entry_postdate() { 
	// Hide category and tag text for pages.?>

	<span class="date"><?php the_time( get_option( 'date_format' ) ); ?> | </span>
			
<?php 
}
endif;

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
<h3>User Position</h3>
<table class="form-table">
	<tr>
		<th><label for="user-position">Position</label></th>
		<td>
			<input type="text" name="user-position" id="user-position" value="<?php echo esc_attr( get_the_author_meta( 'user-position', $user->ID ) ); ?>" class="regular-text" /><br />
		</td>
	</tr>
</table>

<h3>User Socials</h3>

<table class="form-table">

 <?php 
 foreach ( ewm_social_array() as $s => $c ): ?>
  <tr>
        <th><label for="<?php echo esc_attr($s); ?>"><?php echo esc_html($c); ?></label></th>
        <td>
             <input type="text" name="<?php echo esc_attr($s); ?>" id="<?php echo esc_attr($s); ?>" value="<?php echo esc_attr( get_the_author_meta( $s, $user->ID ) ); ?>" class="regular-text" /><br />
        </td>
     </tr>
 <?php
 endforeach;
 ?>

</table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

update_user_meta( $user_id, 'user-position', $_POST['user-position'] );

foreach ( ewm_social_array() as $s => $c ):
	update_user_meta( $user_id, $s, $_POST[$s] );
	endforeach;
}

/**
 * Move_comment_field_to_bottom
 */
function ewm_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'ewm_move_comment_field_to_bottom' );

ImportData();
function ImportData() {
	$count = 0;
	$args = array( 'numberposts' => -1); 
	$posts= get_posts( $args );
	if ($posts) {
	    foreach ( $posts as $post ) {
	    	$count++;
	    	if( $count >= 10 ) break;
	    }
	}
}

function relatedPost($id) {
	$cats = wp_get_post_categories($id);
	if (!$cats) return;
	$html = '<div class="ewm-related-post ewm-left">
				<h4>'. esc_html__( 'Related Posts', 'flip') . '</h4>
				<ul>';
	$first_tag = $cats[0]->term_id;
	$args=array(
		'cat__in' => array($first_tag),
		'cat__not_in' => array($post->ID),
		'posts_per_page'=> 5,
		'caller_get_posts'=> 1
	);
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) {
		while ($my_query->have_posts()) : $my_query->the_post();
			$html .= '<li><a href="'. get_the_permalink() .'" rel="bookmark" title="'. get_the_title() . '">'. get_the_title() . '</a></li>';
		endwhile;
	}
	wp_reset_query();

	$html = $html . '</ul></div> <!-- /.ewm-related-post -->';

	echo $html;
}

function get_visual_composer_style($id) {
    return '<style>' . get_post_meta( $id, '_wpb_shortcodes_custom_css', true  ) .                 '</style>';
}