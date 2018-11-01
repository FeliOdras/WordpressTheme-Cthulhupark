<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Cthulhupark
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php echo get_bloginfo( 'name' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body>
    <div id="page">
        <header id="main-header">
            <h1 class-"main-title"><?php echo get_bloginfo( 'name' ); ?></h1>
            <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
            <nav id="main-navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
            </nav>
        </header>