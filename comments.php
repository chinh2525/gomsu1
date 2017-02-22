<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Easy Websites Maker
 */

/*
 * Render comment list
 */
function ewm_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
    
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment_wrap clearfix">

			<?php if( $avarta = get_avatar($comment,$size='100',$default='http://s.gravatar.com/avatar/e18c83a4de25393a9465e613f15b86e0') ) : ?>
				<div class="gravatar">
					<?php echo $avarta; ?>
	            </div>
            <?php endif; ?>

			<div class='comment_content'>
				<footer class="comment_meta">

					<?php printf( '<cite class="comment_author">%s</cite>', get_comment_author_link()); ?><?php edit_comment_link(esc_html__('(Edit)', 'flip' ),'  ','') ?>
                    <?php
                    $d = 'F j, Y \a\t g:i A';
					$comment_date = get_comment_date( $d );
					?>
					
					<span class="comment_time"><a><?php echo esc_attr( $comment_date ); ?></a></span>
					<span class="comement_reply"><?php 
						wp_enqueue_script( 'comment-reply' );
						comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</span>
				</footer>
				<div class='comment_text'>

					<?php comment_text(); ?>
					<?php if ($comment->comment_approved == '0') : ?>
					<span class="unapproved"><?php esc_html_e('Your comment is awaiting moderation.', 'flip'); ?></span>
					<?php endif; ?>

				</div>
			</div>
		</article>
	</li>
<?php
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h3 class="comment-title"><?php comments_number( esc_html__( 'COMMENTS', 'flip' ), esc_html__( '1 COMMENTS', 'flip' ), esc_html__( '% COMMENTS', 'flip' ) ); ?></h3>

		<ol class="comment-list">
			<?php wp_list_comments( array( 'callback' => 'ewm_comments' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" role="navigation">
				<h5 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'flip' ); ?></h5>

				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'flip' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'flip' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<?php if ( !comments_open() && get_comments_number() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'flip' ); ?></p>
		<?php endif; ?>

	<?php endif; ?><!-- have_comments -->

	<?php
	if ( comments_open() ) {
		$commenter = wp_get_current_commenter();
		$aria_req = get_option( 'require_name_email' ) ? " aria-required='true'" : '';
		$comment_args = array(
			'title_reply'          => '<span>Để lại bình luận</span>',
			'id_submit'            => 'comment-reply',
			'label_submit'         => esc_html__( 'Gửi bình luận', 'flip' ),
			'fields'               => apply_filters( 'comment_form_default_fields', array(
				'author' 		=> 
						'<fieldset class="name-container">
							<label for="author"><span class="text-color">*</span> ' . esc_html__( 'Họ tên:', 'flip' ) . '</label>
							<input type="text" id="author" class="tb-my-input" name="author" tabindex="1" value="' . esc_attr( $commenter['comment_author'] ) . '" size="32"' . $aria_req . '>
						</fieldset>',
									
				'email' 	=>
					'<fieldset class="email-container">
						<label for="email"><span class="text-color">*</span> ' . esc_html__( 'Email:', 'flip' ) . '</label>
						<input type="text" id="email" class="tb-my-input" name="email" tabindex="2" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="32"' . $aria_req . '>
					</fieldset>',

				'url' 		=>
					'<fieldset class="website-container">
						<label for="url">' . esc_html__( 'Website', 'flip' ) . '</label>
						<input id="url" name="url" type="text" tabindex="4" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="32" />
					</fieldset>'
			) ),
			'comment_field' 		=> '<fieldset class="message">
											<label><span class="text-color">*</span> ' . esc_html__( 'Nội dung:', 'flip' ) . '</label>
											<textarea id="comment-message" name="comment" rows="8" tabindex="4"></textarea>
										</fieldset>',
			'comment_notes_after'  	=> '',
			'comment_notes_before' 	=> '',
		);
		comment_form( $comment_args );
	}
	?><!-- comments_open -->

</div><!-- #comments -->
