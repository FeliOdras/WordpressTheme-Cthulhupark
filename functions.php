<?php 
function cthulhupark_theme_styles() {
    wp_enqueue_style( 'cthulhupark', get_template_directory_uri().'/style.css', array(), 1.0, 'screen' );
}
add_action( 'wp_enqueue_scripts', 'cthulhupark_theme_styles' );

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

# Register sidebars

function sidebar_left() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar left', 'cthulhupark' ),
            'id' => 'sidebar-left',
            'description' => __( 'Left sidebar', 'cthulhupark' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'sidebar_left' );

function sidebar_right() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar right', 'cthulhupark' ),
            'id' => 'sidebar-right',
            'description' => __( 'Left sidebar', 'cthulhupark' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'sidebar_right' );

#Add post thumbnail support
add_theme_support( 'post-thumbnails' );

#Make translation ready
load_theme_textdomain( 'cthulhupark', '~/Documents/ari/projects/wordpress/hq.cthulhupark/wp-content/themes/cthulhupark' );
?>