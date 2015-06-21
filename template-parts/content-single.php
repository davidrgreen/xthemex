<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php xthemex_posted_on(); ?>
		</div>
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

	<footer class="entry-footer">
		<?php xthemex_entry_footer(); ?>
	</footer>
</article>
