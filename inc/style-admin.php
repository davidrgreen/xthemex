<?php
/**
 * Handle styling the admin, login,, etc that make the site feel personalized
 */


/**
 * Hide the admin bar on the front end if still in development
 */
if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
	add_filter( 'show_admin_bar', '__return_false' );
}



/**
 * Style the login page
 */
add_action( 'login_head', 'xthemex_custom_login_style' );
function xthemex_custom_login_style() {
    ?>
    <style type="text/css">
    body {
    	background: #fff !important;
    }
    h1 a {
    	background: url(<?php echo get_template_directory_uri() .'/assets/img/logo.png'; ?>) 50% 50% no-repeat !important;
    	width: 439px !important;
    	background-size: contain !important;
    	max-width: 100%;
    	color: #20386C;
    }
    .login #nav a, .login #backtoblog a {
    	color: #DA2228;
    	font-size: 15px;
    }
    .login #nav a:hover, .login #backtoblog a:hover {
    	color: #8995b1;
    }
    .login label {
    	color: #20386C;
    }
    .wp-core-ui .button-primary {
    	background: #DA2228 !important;
    	border: 0 !important;
    }
	</style>
	<?php
}



/**
 * Customize footer text in the admin
 */
//add_filter( 'admin_footer_text', 'xthemex_admin_footer' );
function xthemex_admin_footer() {
	echo '<i>Site design by <u><a href="http://davidrg.com" target="_blank">David Green</a></u></i>';
}



/**
 * Remove unneccesary Dashboard widgets
 */
add_action( 'wp_dashboard_setup', 'xthemex_remove_dashboard_widgets' );
function xthemex_remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
}



/**
 * Unregister some of the default sidebar widgets
 */
add_action('widgets_init', 'xthemex_remove_default_widgets', 11);
function xthemex_remove_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     // unregister_widget('WP_Widget_Archives');
     // unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
     // unregister_widget('WP_Widget_Search');
     // unregister_widget('WP_Widget_Text');
     // unregister_widget('WP_Widget_Categories');
     // unregister_widget('WP_Widget_Recent_Posts');
     // unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     // unregister_widget('WP_Nav_Menu_Widget');
 }



/**
 * Hide admin screen columns added by Yoast SEO
 */
add_action( 'init', 'xthemex_maybe_disable_yoast_page_analysis' );
/**
 * Helper function to determine if we're on the right edit screen.
 *
 * @global  $pagenow
 * @param   $post_types array() optional post types we want to check.
 * @return  bool
 */
function xthemex_is_edit_screen( $post_types = '' ) {
	if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		return false;
	}
	global $pagenow;
	// Return true if we're on any admin edit screen.
	if ( ! $post_types && 'edit.php' === $pagenow ) {
		return true;
	}
	elseif ( $post_types ) {
		// Grab the current post type from the query string and set 'post' as a fallback.
		$current_type = isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : 'post';
		foreach ( $post_types as $post_type ) {
			// Return true if we're on the edit screen of any user-defined post types.
			if ( 'edit.php' === $pagenow && $post_type === sanitize_key( $current_type ) ) {
				return true;
			}
		}
	}
	return false;
}

/**
 * Conditionally disable the Yoast Page Analysis on admin edit screens.
 *
 * @uses   prefix_is_edit_screen
 * @return NULL if we're not on the right admin screen
 * @author Robert Neu <http://wpbacon.com>
 * @link   http://auditwp.com/wordpress-seo-admin-columns/
 */
function xthemex_maybe_disable_yoast_page_analysis() {
	if ( ! xthemex_is_edit_screen() ) {
		return;
	}
	// Disable Yoast admin columns.
	add_filter( 'wpseo_use_page_analysis', '__return_false' );
}


/**
 * Hide the Customizer links
 */
function xthemex_customize() {
    // Disallow acces to an empty editor
    wp_die( sprintf( __( 'No WordPress Theme Customizer support - If needed check your functions.php' ) ) . sprintf( '<br /><a href="javascript:history.go(-1);">Go back</a>' ) );
}
add_action( 'load-customize.php', 'xthemex_customize' );

// Remove 'Customize' from Admin menu
function xthemex_remove_submenus() {
    global $submenu;
    // Appearance Menu
    unset($submenu['themes.php'][6]); // Customize
}
add_action('admin_menu', 'xthemex_remove_submenus');

// Remove 'Customize' from the Toolbar -front-end
function xthemex_remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('customize');
}
add_action( 'wp_before_admin_bar_render', 'xthemex_remove_admin_bar_links' );

// Add Custom CSS to Back-end head
function xthemex_admin_css() {
    echo '<style type="text/css">.theme-actions .button.customize { display:none; } </style>';
}
add_action('admin_head', 'xthemex_admin_css');