<?php
class EWM_Recent_Post extends WP_Widget {
    /**
     * Holds widget settings defaults, populated in constructor.
     *
     * @var array
     */
    protected $defaults;

    /**
     * Constructor
     *
     * @return EWM_Recent_Post
     */
    function __construct() {
        $this->defaults = array(
            'title'        => 'Tin tức mới', 
            'count'        => 10, 
            'show_date'    => 0, 
            'show_author'  => 0
        );

        parent::__construct(
            'widget_recent_post',
            esc_html__( 'EWM - Tin mới', 'tnxp' ),
            array(
                'classname'   => 'widget_recent_post',
                'description' => esc_html__( 'Lấy bài viết mới nhất.', 'tnxp' )
            )
        );
    }

    /**
     * Display widget
     */
    function widget( $args, $instance ) {

        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );

        extract( $args );

        $query_args = array(
            'post_type'      => 'post',
            'posts_per_page' => intval( $count ),
            'post_status'    => 'publish', 
            'show_date'      => $show_date
        );

        $query_post = new WP_Query( $query_args );

        echo $before_widget;

        if ( !empty($title) ) { echo  $before_title.'<span>'.$title.'</span>'.$after_title; } ?>

        <?php if ( $query_post->have_posts() ) : ?>

            <ul class="recent-news ewm-reset">

            <?php while ( $query_post->have_posts() ) : $query_post->the_post(); ?>

                <li>

                    <?php if( has_post_thumbnail() ) : ?>

                    <div class="thumb">
                        <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">

                        <?php the_post_thumbnail( 'small-post-thumbs' ); ?>

                        </a>
                    </div>

                    <?php endif; ?>

                    <div class="text">
                        <h6><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a></h6>
                        <p><?php echo get_the_excerpt(); ?></p>
                    </div>
                    <?php if ($show_date) : ?>
                        <span class="date">
                            <time class="time" datetime="<?php echo esc_attr( get_post_time( 'Y-m-d 20:00' ) ); ?>"><?php echo get_post_time( 'd/m/Y' ); ?></time>
                        </span>
                    <?php endif; ?>
                </li>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

            </ul>

        <?php endif; ?>
        <?php echo $after_widget;
    }

    /**
     * Update widget
     */
    function update( $new_instance, $old_instance ) {

        $instance                 = $old_instance;

        $instance['title']        = strip_tags( $new_instance['title'] );
        $instance['count']        = intval( $new_instance['count'] );
        $instance['show_date']    = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        
        return $instance;
    }

    /**
     * Widget setting
     */
    function form( $instance ) {

        $instance    = wp_parse_args( $instance, $this->defaults );
        $show_date   = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Tiêu đề :', 'orches' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $instance['title']; ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php _e( 'Số lượng:', 'orches' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo intval( $instance['count'] ); ?>">
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
            <label><?php _e( 'Xem ngày?', 'orches' ); ?></label>
        </p>

    <?php
    }
}

add_action( 'widgets_init', 'ewm_register_recent_post' );

/**
 * Register widget
 *
 * @return void
 * @since 1.0
 */
function ewm_register_recent_post() {
    register_widget( 'EWM_Recent_Post' );
}
