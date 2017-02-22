<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!--[if lt IE 9]>
	   <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				$jscomposer_templates_args = array(
					'orderby'          => 'title',
					'order'            => 'ASC',
					'post_type'        => 'templatera',
					'post_status'      => 'publish',
					'posts_per_page'   => 100,
				);
				$jscomposer_templates = get_posts( $jscomposer_templates_args );

				if(count($jscomposer_templates) > 0) {
					foreach($jscomposer_templates as $jscomposer_template){
						if($jscomposer_template->post_title == 'header_page'){
							echo do_shortcode($jscomposer_template->post_content) . get_visual_composer_style($jscomposer_template->ID);
						}
					}
				}
				?>
			</div>
		</div>
	</div>
</header>