<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if (post_password_required()) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if (have_comments()): ?>
		<div class="reply-title"><?php esc_html_e('Comments', 'pinacop'); ?></div>
		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'pinacop'); ?></h1>
				<div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'pinacop')); ?></div>
				<div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'pinacop')); ?></div>
			</nav>
		<?php endif; // check for comment navigation ?>
		<ul class="comment-list">
			<?php
			wp_list_comments(array(
				'style' => 'ul',
				'short_ping' => true,
				'avatar_size' => 70
			));
			?>
		</ul>
		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'pinacop'); ?></h1>
				<div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'pinacop')); ?></div>
				<div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'pinacop')); ?></div>
			</nav>
		<?php endif; // check for comment navigation ?>
	<?php endif; // have_comments() ?>

	<?php if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) && ! is_page() ) : ?>
		<h5 class="no-comments"><?php esc_html_e('Comments are closed.', 'pinacop'); ?></h5>
	<?php endif; ?>

	<?php
	$pinacop_commenter     = wp_get_current_commenter();
	$pinacop_args          = array(
		'id_form' => 'commentform',
		'id_submit' => 'submit',
		'title_reply' => esc_html__('Leave a comment', 'pinacop'),
		'title_reply_to' => esc_html__('Leave a Reply to %s', 'pinacop'),
		'cancel_reply_link' => esc_html__(' - Cancel Reply', 'pinacop'),
		'label_submit' => esc_html__('Post a Comment', 'pinacop'),
		'comment_field' => '<p class="comment-form-comment"><textarea placeholder="'.esc_html__('Comment', 'pinacop').'" id="comment" name="comment" cols="45" rows="8" aria-required="true">' . '</textarea></p>',
		'comment_notes_after' => '',
		'fields' => apply_filters('comment_form_default_fields', array(
			'author' => '<p class="comment-form-author"><input placeholder="'.esc_html__('Name', 'pinacop').'" id="author" name="author" type="text" value="' . esc_attr($pinacop_commenter['comment_author']) . '" size="30" /></p>',
			'email' => '<p class="comment-form-email"><input placeholder="'.esc_html__('Email', 'pinacop').'" id="email" name="email" type="text" value="' . esc_attr($pinacop_commenter['comment_author_email']) . '" size="30" /></p>'
		))
	);
	comment_form($pinacop_args, get_the_ID());
	?>
</div>