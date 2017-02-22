<?php

/**
 * Enqueue scripts and styles.
 *
 * @since ewm 1.0
 */
function ewm_scripts() {

	wp_enqueue_style( 'bootstrap', THEME_URL . 'css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', THEME_URL . 'css/font-awesome.css' );
	wp_enqueue_style( 'fonts', THEME_URL . 'css/fonts.css' );
	wp_enqueue_style( 'owl', THEME_URL . 'css/owl.carousel.css' );
	wp_enqueue_style( 'ewm-style', get_stylesheet_uri() );
	wp_enqueue_style( 'main-style', THEME_URL . 'css/main.css' );
	wp_enqueue_style( 'ewm-flexslider', THEME_URL . 'css/flexslider.css' );
	wp_enqueue_style( 'responsive', THEME_URL . 'css/responsive.css' );

	wp_enqueue_script( 'jquery-fitvids', THEME_URL . 'js/jquery.fitvids.js', array( 'jquery' ), NULL, true);
	wp_enqueue_script( 'jquery-owl', THEME_URL . 'js/owl.carousel.min.js', array( 'jquery' ), NULL, true);
	wp_enqueue_script( 'jquery-matchMedia', THEME_URL . 'js/matchMedia.js', array( 'jquery' ), NULL, true);
	wp_enqueue_script( 'jquery-jquery-ui', THEME_URL . 'js/jquery-ui.js', array( 'jquery' ), NULL, true);
	wp_register_script( 'jquery-flexslider', THEME_URL . 'js/jquery.flexslider-min.js', array( 'jquery' ), NULL, true);
	wp_enqueue_script( 'jquery-main', THEME_URL . 'js/main.js', array( 'jquery' ), NULL, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ewm_scripts' );

/**
 * Enqueue google fonts base on Theme Option.
 *
 * @since Easy Websites Maker 1.0
 */

// Enqueue script for handling actions with meta boxes
function ewm_admin_script_meta_box() {
	$screen = get_current_screen();
	if ( ! in_array( $screen->post_type, array( 'post', 'page' ) ) )
		return;
	wp_enqueue_script( 'ewm-meta-box', THEME_URL . 'inc/assets/meta-boxes.js', array( 'jquery' ), '', true );
}
add_action( 'admin_enqueue_scripts', 'ewm_admin_script_meta_box' );
