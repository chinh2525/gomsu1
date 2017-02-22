<?php
/**
 * @package Easy Websites Maker
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="title-post"><?php the_title(); ?></h1>
		
		<?php $my_date = the_date('F j, Y g:i a', '<span class="date">', '</span>', FALSE); echo $my_date; ?>

	</header><!-- .entry-header -->

	<div class="entry-content ewm-reset">

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flip' ),
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>

	</div><!-- .entry-content -->
</article><!-- #post-## -->
