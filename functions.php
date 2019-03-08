<?php 
# Enquueue Scrips and Styles
function cthulhupark_theme_styles() {
    wp_enqueue_style( 'cthulhupark', get_template_directory_uri().'/style.css', array(), 1.0, 'screen' );
    wp_enqueue_script( 'cthulhupark-main', get_template_directory_uri() . '/js/cthulhupark-main.js', array(), 1.0, true);
    wp_enqueue_script( 'wp-api' );
}
add_action( 'wp_enqueue_scripts', 'cthulhupark_theme_styles' );


# Change Excerpt length
function custom_excerpt_length( $length ) {
	return 23;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

#Custom Header Image
$args = array(
    'width'         => 1000,
    'flex-width'    => true,
    'height'        => 150,
    'flex-height'   => true,
	'default-image' => get_template_directory_uri() . '/images/default-header.png',
);
add_theme_support( 'custom-header', $args );

#Custom Menus
function register_my_menu() { 
    register_nav_menu('main-menu',__( 'Main Menu' )); 
} 
add_action( 'init', 'register_my_menu' );

#Remove "Archive" and "Tag" from category title 
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } 
    return $title;
});

#Exclude category dairy and dreamlands from search query
function wcs_exclude_category_search( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
      return;
  
    if ( $query->is_search ) {
      $query->set( 'cat', '-2, -11' );
    }
  
  }
  add_action( 'pre_get_posts', 'wcs_exclude_category_search', 1 );

# Register sidebars

// Left Sidebar
function sidebar_left() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar left', 'cthulhupark' ),
            'id' => 'sidebar-left',
            'description' => __( 'Left sidebar', 'cthulhupark' ),
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'sidebar_left' );

// Right sidebar
function sidebar_right() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar right', 'cthulhupark' ),
            'id' => 'sidebar-right',
            'description' => __( 'Right sidebar', 'cthulhupark' ),
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'sidebar_right' );

// Author sidebar
function sidebar_author() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar author', 'cthulhupark' ),
            'id' => 'sidebar-author',
            'description' => __( 'Author sidebar', 'cthulhupark' ),
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'sidebar_author' );


#Add post thumbnail support
add_theme_support( 'post-thumbnails' );


include 'widgets/tbe.php';
include 'widgets/frontendLogin.php';
// include 'widgets/latestTBE.php';



?>