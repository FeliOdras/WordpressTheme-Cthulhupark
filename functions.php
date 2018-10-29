<?php 
$args = array(
    'width'         => 1000,
    'flex-width'    => true,
    'height'        => 150,
    'flex-height'   => true,
	'default-image' => get_template_directory_uri() . '/images/default-header.png',
);
add_theme_support( 'custom-header', $args );
?>