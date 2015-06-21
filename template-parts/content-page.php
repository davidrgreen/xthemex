<?php
/**
 * The template used for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
			// If the post/page is broken into multiple pages.
			wp_link_pages( array(
				'before' => '<div class="page-links">Pages:',
				'after'  => '</div>',
			) );
		?>
	</div>

	<?php /*
	<footer class="entry-footer">
	</footer>
	*/ ?>
</article>
