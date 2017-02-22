<?php
/**
 * The default template for displaying content
 *
 * @since Easy Websites Maker
 */
$grid = 'col-md-12';
?>
 
<article id="post-<?php the_ID(); ?>" <?php post_class($grid); ?>>

	<?php get_template_part( 'tpl/feature-post');?>

	<h3 class="ewm-title"><a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
	
	<div class="ewm-cat">
	 	<span>Chuyên mục: </span>

		<?php $categories = get_the_category( $post->ID );
		if ( ! empty( $categories ) ) {
			foreach ($categories as $categorie) {
				echo '<a href="' . esc_url( get_category_link( $categorie->term_id ) ) . '" class="ewm-categories" title="' . esc_html( $categorie->name ) . '">' . esc_html( $categorie->name ) . ', </a>';
			}
		} ?>
	</div>

	<p><?php the_excerpt(); ?></p>

</article><!-- /.post-->