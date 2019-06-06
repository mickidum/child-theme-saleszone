<?php
/**
 * Child-theme-saleszone Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package child-theme-saleszone
 */

add_action( 'after_setup_theme', 'my_child_theme_setup' );
function my_child_theme_setup(){
	load_child_theme_textdomain( 'saleszone', get_stylesheet_directory() . '/languages' );
}


add_action( 'wp_enqueue_scripts', 'saleszone_parent_theme_enqueue_styles' );


function saleszone_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'child-theme-saleszone-bootstrap',
		get_stylesheet_directory_uri() . '/css/btstr.css',
		array( 'saleszone-styles' )
	);
	wp_enqueue_style( 'child-theme-saleszone-style-all-rtl',
		get_stylesheet_directory_uri() . '/css/all-rtl.css',
		array( 'child-theme-saleszone-bootstrap' )
	);
	wp_enqueue_style( 'child-theme-saleszone-style-addcss',
		get_stylesheet_directory_uri() . '/css/addcss.css',
		array( 'child-theme-saleszone-style-all-rtl' )
	);
	// wp_enqueue_style( 'child-theme-saleszone-style-rtl1',
	// 	get_stylesheet_directory_uri() . '/css/rtl-last.css',
	// 	array( 'child-theme-saleszone-bootstrap' )
	// );
	// wp_enqueue_style( 'child-theme-saleszone-style-rtl2',
	// 	get_stylesheet_directory_uri() . '/css/right.css',
	// 	array( 'child-theme-saleszone-bootstrap' )
	// );
	// wp_enqueue_style( 'child-theme-saleszone-style-variations',
	// 	get_stylesheet_directory_uri() . '/css/variations.css',
	// 	array( 'child-theme-saleszone-bootstrap' )
	// );
}

/**
 * Register the /wp-json/acf/v3/posts endpoint so it will be cached.
 */
function public_woo_cache_endpoint( $allowed_endpoints ) {
    if ( ! isset( $allowed_endpoints[ 'public-woo/v1' ] ) || ! in_array( 'products', $allowed_endpoints[ 'public-woo/v1' ] ) ) {
        $allowed_endpoints[ 'public-woo/v1' ][] = 'products';
    }
    return $allowed_endpoints;
}
add_filter( 'wp_rest_cache/allowed_endpoints', 'public_woo_cache_endpoint', 10, 1);