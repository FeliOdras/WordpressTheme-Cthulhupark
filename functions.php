<?php 

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

#Remove "Archive" and "Tag" from catrgory title 

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } 
    return $title;
});
?>