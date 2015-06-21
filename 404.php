<?php
/**
 * The template for displaying 404 pages (not found).
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title">Sorry. That page does not exist.</h1>
				</header>

				<div class="page-content">
					<p>The page you are looking for does not exist. Perhaps you should <a href="<?php echo esc_url( home_url( '/' ) ); ?>">return to the site's homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.</p>

					<?php get_search_form(); ?>

					<?php //the_widget( 'WP_Widget_Recent_Posts' ); ?>

				</div>
			</section>

		</main>
	</div>

<?php get_footer(); ?>
