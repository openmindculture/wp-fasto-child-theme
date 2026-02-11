<?php
    function child_theme_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));
    }

    add_action( 'wp_enqueue_scripts', 'child_theme_styles' );

    function child_theme_scripts() {
        /* depend on jquery because our parent scripts do, that we like to modify */
        wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '', true );
    }

    add_action( 'wp_enqueue_scripts', 'child_theme_scripts' );

	function fasto_child_localization_setup() {
		load_child_theme_textdomain('fasto-child', get_stylesheet_directory() . '/languages');
	}
	add_action('after_setup_theme', 'fasto_child_localization_setup');

    function modified_fasto_developer_credit(){
        $url = 'https://wowlayers.com/';
        echo '<div class="copyright-fasto">'.esc_html__( 'WordPress theme based on fasto by ','fasto' ).'<a href="'. $url .'" target="_blank" rel="nofollow">'.esc_html__( 'WOWLayers.com','fasto' ).'</a></div>';
    }

    function child_remove_parent_function() {
        remove_action( 'wp_footer', 'fasto_developer_credit' );
		remove_action( 'wp_enqueue_scripts','fasto_add_fonts_css' );
		wp_dequeue_style( 'fasto-custom-css' );
    }

    add_action( 'wp_loaded', 'child_remove_parent_function' );
    add_action( 'wp_footer', 'modified_fasto_developer_credit', 200 );

	/* Workaround for ignoring widget language bug in 5.8 widget block editor
	 * Themes may disable the Widgets Block Editor
	 * https://developer.wordpress.org/block-editor/how-to-guides/widgets/opting-out/#using-remove_theme_support
	 */

	function example_theme_support() {
		remove_theme_support( 'widgets-block-editor' );
	}
	add_action( 'after_setup_theme', 'example_theme_support' );

// disable WP Heartbeat API, except for editor views where we need it to trigger auto-saving
global $pagenow;
if (!is_admin() || $pagenow != 'post.php') {
	add_action( 'init', function(){
		wp_deregister_script('heartbeat');
	}, 1 );
}

/* SEO: disable author page archive if most content is by the same author */
function disable_author_archives() {
	if (is_author()) {
		wp_redirect(home_url(), 301);
		exit;
	}
}
add_action('template_redirect', 'disable_author_archives');

/* SEO: remove "Archive" or "Archives" prefix from archive titles */
add_filter( 'get_the_archive_title', function( $title ) {

	// Remove prefix for categories
	if (is_category()) {
		$title = single_cat_title('', false);
	}
});

function custom_nav_menu_item( $items, $args ) {
	if ( $args->theme_location == 'primary' ) {
		include_once (get_stylesheet_directory() . '/inc/functions/fasto_child_reader_mode_trigger.php');
		$items .= '<li class="custom-menu-item fasto-child-mobile-only">'
				. fasto_child_reader_mode_trigger( ' Reader mode' )
				. '</li>';
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'custom_nav_menu_item', 10, 2 );

// override deprecated parent theme HTML5 configuration:
function fasto_child_remove_parent_html5() {
	remove_theme_support( 'html5' );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
add_action( 'after_setup_theme', 'fasto_child_remove_parent_html5', 11 );
