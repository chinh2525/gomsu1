		</div>
	</div>

	<footer class="ewm-footer">
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
							if($jscomposer_template->post_title == 'footer_page'){
								echo do_shortcode($jscomposer_template->post_content) . get_visual_composer_style($jscomposer_template->ID);
							}
						}
					}
					?>
				</div>
			</div>
		</div>
	</footer>

	<!-- Go Top -->
    <a class="go-top">
        <i class="fa fa-angle-up"></i>
    </a>

	<?php wp_footer();	?>
</body>
</html>
