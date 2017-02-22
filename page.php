<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @since Easy Websites Maker
 */

get_header(); ?>

	<div class="main-wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div id="main" class="main-content">
						<?php if ( have_posts() ) :

							while ( have_posts() ) : the_post();
								
								the_content();

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
