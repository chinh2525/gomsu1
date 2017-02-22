<?php
/**
 * The sidebar containing the main widget area.
 *
 * @since Easy Websites Maker
 */
?>

<div class="widget-area">

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
			if($jscomposer_template->post_title == 'widget_pages'){
				echo do_shortcode($jscomposer_template->post_content) . get_visual_composer_style($jscomposer_template->ID);
			}
		}
	}
	?>
	
</div><!-- /.widget-area -->
