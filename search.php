<?php
/**
 * The template for displaying search results pages.
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( 'Search Results for: %s', '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				get_template_part( 'template-parts/content', 'search' );
				?>

			<?php endwhile; ?>

			<?php xthemex_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main>
	</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
