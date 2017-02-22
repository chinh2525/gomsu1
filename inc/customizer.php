<?php
/**
 * EWM Theme Customizer
 *
 * @package ewm
 */

function ewm_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_control( 'header_textcolor' );
    $wp_customize->remove_control( 'display_header_text' );
    $wp_customize->get_section( 'header_image' )->panel = 'ewm_header_panel';
    $wp_customize->get_section( 'header_image' )->priority = '13';
    $wp_customize->get_section( 'background_image' )->panel = 'ewm_general_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '9';
    $wp_customize->get_section( 'title_tagline' )->title = esc_html__('Logo', 'flip');

    //Divider
    class EWM_Divider extends WP_Customize_Control {
         public function ewm_render_content() {
            echo '<hr style="margin: 15px 0;border-top: 1px dashed #919191;" />';
         }
    }
    //Titles
    class EWM_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;padding:6px;color:#fff;background:#011D27;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }     
    //Titles
    class EWM_Theme_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function ewm_render_content() {
        ?>
            <h3><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
}
add_action( 'customize_register', 'ewm_customize_register' );

/**
 * Sanitize
 */

//Text
function ewm_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Background size
function ewm_sanitize_bg_size( $input ) {
    $valid = array(
        'cover'     => esc_html__('Cover', 'flip'),
        'contain'   => esc_html__('Contain', 'flip'),
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Footer widget areas
function ewm_sanitize_fw( $input ) {
    $valid = array(
        '1' => esc_html__('One', 'flip'),
        '2' => esc_html__('Two', 'flip'),
        '3' => esc_html__('Three', 'flip'),
        '4' => esc_html__('Four', 'flip')
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Blog Layout
function ewm_sanitize_blog( $input ) {
    $valid = array(
        'sidebar-right' => esc_html__( 'Sidebar right', 'flip' ),
        'sidebar-left'  => esc_html__( 'Sidebar left', 'flip' ),
        'fullwidth'     => esc_html__( 'Full width (no sidebar)', 'flip' )
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//Header style
function ewm_sanitize_header_style( $input ) {
    $valid = array(
        'dark' => 'Dark',
        'light'=> 'Light'
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//Slider text style
function ewm_sanitize_text_align_style( $input ) {
    $valid = array(
        'left' => 'Left',
        'right'=> 'Right'
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//Checkboxes
function ewm_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ewm_customize_preview_js() {
	wp_enqueue_script( 'ewm_customizer', THEME_URL . 'js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'ewm_customize_preview_js' );

