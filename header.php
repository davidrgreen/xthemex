<?php
/**
 * Displays all of the <head> section and everything up till <div id="content">
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon.ico" />

<?php wp_head(); ?>
<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body <?php body_class(); ?>>
<header id="masthead" class="site-header clearfix" role="banner">
	<div class="wrap">
		<div class="site-logo">
			<?php /* <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> */ ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png" alt="<?php bloginfo( 'name' ); ?> logo - Return to Home"></a>
		</div>
		<button class="mobile-menu-toggle-button mobile-menu-toggle" role="button" aria-pressed="false">Menu</button>
	</div>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<div class="wrap">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'fallback_cb' => '__return_false' ) ); ?>
		</div>
	</nav>
</header>
<div id="page" class="site-container">

	<div id="content" class="content-sidebar-wrap clearfix">
