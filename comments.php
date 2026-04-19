<?php
/**
 * Comments template
 *
 * @package Bloom
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$bloom_comment_count = get_comments_number();
			printf(
				/* translators: 1: number of comments */
				esc_html( _nx( '%1$s thought', '%1$s thoughts', $bloom_comment_count, 'comments title', 'bloom' ) ),
				esc_html( number_format_i18n( $bloom_comment_count ) )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments( [
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 48,
				'callback'    => 'bloom_comment',
			] );
			?>
		</ol>

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bloom' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form( [
		'title_reply'          => esc_html__( 'Leave a comment', 'bloom' ),
		'title_reply_to'       => esc_html__( 'Leave a reply to %s', 'bloom' ),
		'cancel_reply_link'    => esc_html__( 'Cancel reply', 'bloom' ),
		'label_submit'         => esc_html__( 'Post Comment', 'bloom' ),
		'class_submit'         => 'submit btn btn--primary',
		'comment_notes_before' => '',
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'bloom' ) . '</label><textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required="required"></textarea></p>',
	] );
	?>

</div><!-- #comments -->
