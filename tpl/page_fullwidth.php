<?php
/*
Template Name: Full-width Page
*/
get_header(); ?>

	<div id="primary" class="content-area ewm-reset">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<?php 
						if ( have_posts() ) : 
							while ( have_posts() ) : the_post();
								the_content();
							endwhile; 
						else :
							get_template_part( 'content', 'none' );
						endif;
						?>

					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

