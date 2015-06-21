<?php
/**
 * Custom template tags for this theme.
 */

/**
 * Display navigation to next/previous set of posts when applicable.
 */
function xthemex_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	$older_link_text = 'Older Posts';
	$newer_link_text = 'Newer Posts';
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text">Posts navigation</h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( $older_link_text ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( $newer_link_text ); ?></div>
			<?php endif; ?>

		</div>
	</nav>
	<?php
}


/**
 * Display navigation to next/previous post when applicable.
 */
function xthemex_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	$prev_link_text = 'Previous';
	$next_link_text = 'Next';
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text">Post navigation</h2>
		<div class="nav-links">
			<?php
			// Use %title as the link text if you want to display the post title
			previous_post_link( '<div class="nav-previous">%link</div>', $prev_link_text );
			next_post_link( '<div class="nav-next">%link</div>', $next_link_text );
			?>
		</div>
	</nav>
	<?php
}


/**
 * Prints HTML with meta information for the current post-date/time and author.
 * NOTE: Possibly add an argument to this to allow for formatting the date differently for
 * 	different calls to it.
 */
function xthemex_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="' .
		esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="' .
			esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) .
			'</time><time class="updated" datetime="' .
			esc_attr( get_the_modified_date( 'c' ) ) . '">' .
			esc_html( get_the_modified_date() ) . '</time>';
		}

	?>
	<span class="posted-on">
		Posted on <?php echo $time_string; ?>
	</span>
	<span class="byline">
		<span class="author vcard">by <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span>
	</span>

	<?php

}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function xthemex_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list ) {
			echo '<span class="cat-links">Posted in ' . $categories_list . '</span>';
		}

		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) {
			echo '<span class="tags-links">Tagged ' . $tags_list . '</span>';
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( 'Leave a comment' , '1 Comment', '% Comments' );
		echo '</span>';
	}
}


/**
 * Display the archive title based on the queried object.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function xthemex_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html( 'Category: %s' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html( 'Tag: %s' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html( 'Author: %s' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html( 'Year: %s' ), get_the_date( 'Y', 'yearly archives date format' ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html( 'Month: %s' ), get_the_date( 'F Y', 'monthly archives date format' ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html( 'Day: %s' ), get_the_date( 'F j, Y', 'daily archives date format' ) );
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html( 'Archives: %s' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html( '%1$s: %2$s' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = 'Archives';
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK
	}
}


/**
 * Display category, tag, or term description.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function xthemex_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		echo $before . $description . $after;
	}
}