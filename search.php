<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Easy Websites Maker
 */

get_header(); 

?>

<div class="main-wrap search">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<label class="ewm-title-heading"><span>Tìm kiếm từ khóa: <?php echo get_search_query(); ?></span></label>

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
				</div><!-- /.col-md-9 -->
				<div class="col-md-3">
					<div id="sidebar" class="ewm-right">
						<?php get_sidebar(); ?>
					</div><!-- /#sidebar -->
				</div>
			</div>
		</div>
	</div><!-- /.main-wrap -->
	
<?php get_footer(); ?>
