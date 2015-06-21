<?php
/**
 * The main template file.
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					get_template_part( 'template-parts/content' );
				?>

			<?php endwhile; ?>

			<?php xthemex_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
