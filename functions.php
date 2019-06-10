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
	// wp_enqueue_style( 'child-theme-saleszone-style-addcss',
	// 	get_stylesheet_directory_uri() . '/css/addcss.css',
	// 	array( 'child-theme-saleszone-style-all-rtl' )
	// );
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
if (is_rtl()) {

// define the woocommerce_pagination_args callback 
function filter_woocommerce_pagination_args( $arr ) { 
    $arr['prev_text'] = '&rarr;';
    $arr['next_text'] = '&larr;';

    return $arr; 
}; 
         
// add the filter 
add_filter( 'woocommerce_pagination_args', 'filter_woocommerce_pagination_args', 10, 1 ); 

function saleszone_get_comments_pagination_args()
  {
    return array(
        'prev_text' => '&rarr;',
        'next_text' => '&larr;',
        'type'      => 'array',
        'echo'      => false,
    );
  }

function saleszone_post_pagination( $echo = true )
  {
    global  $wp_query ;
    $total = $wp_query->max_num_pages;
      
    if ( $total > 1 ) {
      $pages = paginate_links( array(
          'current'   => max( 1, get_query_var( 'paged' ) ),
          'total'     => $total,
          'mid_size'  => 3,
          'type'      => 'array',
          'prev_text' => '→',
          'next_text' => '←',
      ) );
      ob_start();
      echo  '<ul class="pagination">' ;
      foreach ( $pages as $page ) {
          echo  '<li class="pagination__item">' . wp_kses( $page, array(
              'a'    => array(
              'class' => true,
              'href'  => true,
          ),
              'span' => array(
              'class' => true,
          ),
          ) ) . '</li>' ;
      }
      echo  '</ul>' ;
      $html = ob_get_clean();
      
      if ( $echo ) {
          echo  wp_kses_post( $html ) ;
      } else {
          return $html;
      }
    }
  }
}