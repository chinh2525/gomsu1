<?php
/**
 * The main template file.
 *
 * @since Easy Websites Maker
 */

get_header(); ?>

<div class="main-wrap ewm-reset">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div id="main" class="main-content ewm-left">
					<?php if ( have_posts() ) :

						while ( have_posts() ) : the_post();
							
							get_template_part( 'content' );

						endwhile;

						the_posts_pagination();

					else :
						get_template_part( 'tpl/notfound' );

					endif; ?>
				</div><!-- /#main -->
			</div>
			<div class="col-md-3">
				<div id="sidebar" class="ewm-right">
					<?php get_sidebar(); ?>
				</div><!-- /#sidebar -->
			</div>
		</div>
	</div>
</div><!-- /.main-wrap -->
	
<?php get_footer(); ?>
