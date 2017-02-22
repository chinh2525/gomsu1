<?php
/**
 * The main template file.
 *
 * @since Easy Websites Maker
 */

get_header(); ?>

<div class="container ewm-archive">
	<div class="row">
		<div class="col-md-9">
			<label class="ewm-title-heading"><span><?php echo single_cat_title(); ?></span></label>

			<div id="primary" class="content-area">
				<main id="main" class="post-wrap" role="main">

				<?php 
				if ( have_posts() ) : 

				 	/* Start the Loop */ 
					while ( have_posts() ) : the_post(); 
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
				 	endwhile; 

					the_posts_pagination();
					wp_reset_query();
				else :
					get_template_part( 'content', 'none' ); 
				endif; 
				?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- /.col-md-9 -->
		<div class="col-md-3">
			<div id="sidebar" class="ewm-right">
				<?php get_sidebar(); ?>
			</div><!-- /#sidebar -->
		</div>
	</div>
</div>

<?php get_footer(); ?>