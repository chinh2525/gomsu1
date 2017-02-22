<?php
//add_filter('show_admin_bar', '__return_false');

// Defines
define( 'THEME_DIR', trailingslashit( get_template_directory() ) ) ;
define( 'THEME_URL', trailingslashit( get_template_directory_uri() ) );

if ( ! function_exists( 'ewm_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since ewm 1.0
 */
function ewm_setup() {
	// Set the content width based on the theme's design and stylesheet.
	if ( ! isset( $content_width ) ) $content_width = 1170;

	// Make theme available for translation.
	load_theme_textdomain( 'flip', THEME_DIR . 'lang' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Set up the WordPress core custom background feature.
    $args = array(
        'default-color' => 'ffffff',
    );
    
    add_theme_support( 'custom-background', $args );

    add_theme_support( "custom-header" );

	// Feature of WP 4.1
	add_theme_support( 'title-tag' );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'thumb-small-news', 700, 750, true );
	add_image_size( 'thumb-big-news', 820, 1067, true );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	// Enable to use of shortcodes in text widgets.
	add_filter('widget_text', 'do_shortcode');

	// Custom stylesheet to the TinyMCE visual editor
    function ewm_add_editor_styles() {
        add_editor_style( 'css/editor-style.css' );
    }
    add_action( 'admin_init', 'ewm_add_editor_styles' );
}
endif;
add_action( 'after_setup_theme', 'ewm_setup' );

/**
 * Register menu
 *
 * @since ewm 1.0
 */
function ewm_register_menu() {
	register_nav_menus( array(
        'primary-menu'    	 => esc_html__( 'Primary Menu', 'flip' ),
    ) );
	function ewm_menu_fallback() {
		$admin_url = esc_url( admin_url('nav-menus.php') );
		echo '<div class="no-menu">';
		echo wp_kses( __( "<a href='$admin_url'>Create a Menu</a>", 'flip'), array( 'a' => array( 'href' => array() ) ) );
		echo '</div>';
	}
}
add_action( 'init', 'ewm_register_menu' );

/**
 * Register widget area
 *
 * @since ewm 1.0
 */
function ewm_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Logo', 'flip' ),
		'id'            => 'sidebar-logo',
		'description'   => esc_html__( 'Thêm chức năng hiển thị.', 'flip' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Banner hiển thị', 'flip' ),
		'id'            => 'sidebar-banner',
		'description'   => esc_html__( 'Thêm chức năng hiển thị.', 'flip' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'flip' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Thêm chức năng hiển thị.', 'flip' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Page', 'flip' ),
		'id'            => 'siderbar-page',
		'description'   => esc_html__( 'Thêm chức năng hiển thị.', 'flip' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    require THEME_DIR . "widgets/ewm_recent_post.php";

    register_widget( 'EWM_Recent_Post' );
}
add_action( 'widgets_init', 'ewm_widgets_init' );


// Theme functions
require THEME_DIR . 'inc/theme-functions.php';

// Theme scripts
require THEME_DIR . 'inc/theme-scripts.php';

// Customizer
require THEME_DIR . 'inc/customizer.php';

// Metabox options
require THEME_DIR . 'inc/metabox-option.php';

// Breadcrumbs
require THEME_DIR . 'inc/breadcrumbs.php';