<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

/**
 * Enqueue the comment reply JavaScript
 */
if ( comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply', '', '', '', true );
}



/**
 * Template for individual comments and pingbacks.
 *
 * Used as a callback by wp_list_comments()
 */
function xthemex_comment_html( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( '(Edit)' ); ?></p>
    <?php
            break;
        default :
    ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	<article itemprop="comment" itemscope="itemscope" itemtype="http://schema.org/UserComments">
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
		<?php endif; ?>
		<header class="comment-header">
			<div class="comment-author" itemprop="creator" itemscope="itemscope" itemtype="http://schema.org/Person">
				<?php echo get_avatar( $comment, 40 ); ?>
				<span itemprop="name"><?php echo get_comment_author(); ?></span>
			</div>

			<div class="comment-meta">
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-time-link" itemprop="url">
					<time pubdate datetime="<?php comment_time( 'c' ); ?>" itemprop="commentTime">
						<?php echo get_comment_date(); ?>
						at <?php echo get_comment_time(); ?>
					</time>
				</a>
				<?php edit_comment_link( '(Edit)' ); ?>
			</div>
		</header>

		<div class="comment-content clearfix"  itemprop="commentText">
			<?php comment_text(); ?>
		</div>

		<div class="reply">
		<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	</article>

    <?php
            break;
    endswitch;
}



?>

<div id="comments" class="comments">

	<?php comment_form( array(
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'id_form'           => 'commentform',
		'class_submit'      => 'comment-submit',
		'name_submit'       => 'submit',
		'title_reply'       => 'Leave a Comment',
		'title_reply_to'    => 'Leave a Comment to %s',
		'cancel_reply_link' => 'Cancel Comment',
		'label_submit'      => 'Post Comment',
		'comment_field' => '<p class="comment-form-comment"><label for="comment">Comment</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="*Add a comment..."></textarea></p>',
		'fields' => apply_filters(
		'comment_form_default_fields', array(
			'author' =>
			    '<p class="comment-form-author"><label for="author">Name</label> ' .
			    ( $req ? '<span class="required">*</span>' : '' ) .
			    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			    '" size="30" aria-required="true"></p>',

			  'email' =>
			    '<p class="comment-form-email"><label for="email">Email</label> ' .
			    ( $req ? '<span class="required">*</span>' : '' ) .
			    '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			    '" size="30" aria-required="true"></p>',

			  /*'url' =>
			    '<p class="comment-form-url"><label for="url">Website</label>' .
			    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			    '" size="30"></p>',*/
		)
	),
	)); ?>

	<?php if ( have_comments() ) : ?>
	<div class="comments-container">
		<h2 class="comments-title">
			Comments
			<?php /* comments_number( 'no comments', 'one comment', '% comments' ); */ ?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text">Comment Navigation</h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( 'Older Comments' ); ?></div>
				<div class="nav-next"><?php next_comments_link( 'Newer Comments' ); ?></div>

			</div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'             => 'li',
					'callback'          => 'xthemex_comment_html',
					'end-callback'      => null,
					'type'              => 'comment',
					'reply_text'        => 'Reply',
					'reverse_children'  => '',
					'format'            => 'html5',
				) );
			?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text">Comment Navigation</h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( 'Older Comments' ); ?></div>
				<div class="nav-next"><?php next_comments_link( 'Newer Comments' ); ?></div>

			</div>
		</nav>
		<?php endif; // check for comment navigation ?>
	</div>
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed...
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments">Comments are closed.</p>
	<?php endif; ?>

</div>
