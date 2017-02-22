<?php
/**
 * The template for displaying all single posts.
 *
 * @package Easy Websites Maker
 */

get_header(); ?>

<div class="container ewm-single">
	<div class="row">
		<div class="col-md-9">
			<div id="primary" class="content-area">
				<main id="main" class="post-wrap" role="main">

				<?php 
				while ( have_posts() ) : the_post(); 
					get_template_part( 'content', 'single' );

					the_posts_pagination();
						// the_posts_navigation();
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile; // end of the loop. 
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
