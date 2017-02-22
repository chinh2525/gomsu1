<?php 
    $title = esc_html__( 'Archives', 'flip' );
    if( is_page_template( 'tpl/home_page.php' ) )
        return;
    elseif ( is_home() ) {
        $title = esc_html__( 'Blog', 'flip' );       
    } elseif ( is_singular() ) {
        // if ( ewm_metabox('hide_page_title') ) return;
        if ( ! $title = esc_html( ewm_metabox('custom_title') ) ) $title = get_the_title();
    } elseif ( is_search() ) {
        $title = sprintf( esc_html__( 'Search results for &quot;%s&quot;', 'flip' ), get_search_query() );
    } elseif ( is_404() ) {
        $title = esc_html__( 'Not Found', 'flip' );
    } elseif ( is_author() ) {
        the_post();
        $title = sprintf( esc_html__( 'Author Archives: %s', 'flip' ), get_the_author() );
        rewind_posts();
    } elseif ( is_day() ) {
        $title = sprintf( esc_html__( 'Daily Archives: %s', 'flip' ), get_the_date() );
    } elseif ( is_month() ) {
        $title = sprintf( esc_html__( 'Monthly Archives: %s', 'flip' ), get_the_date( 'F Y' ) );
    } elseif ( is_year() ) {
        $title = sprintf( esc_html__( 'Yearly Archives: %s', 'flip' ), get_the_date( 'Y' ) );
    } elseif ( is_tax() || is_category() || is_tag() ) {
        $title = single_term_title( '', false );
    }
?>

<div class="page-title">
    <div class="pt-heading">
        <div class="container">
            <h3><?php echo $title; ?></h3>
        </div><!-- /.container -->
    </div><!-- /.pt-heading -->
    <div class="pt-crumbs">
        <div class="container">
            <?php woo_breadcrumbs(); ?>
        </div><!-- /.container -->
    </div><!-- /.pt-crumbs -->
</div><!-- /.page-title -->