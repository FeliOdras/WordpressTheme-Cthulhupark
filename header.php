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
<body <?php body_class(); ?>>
    <div id="page">
        <header id="main-header" class="main-header">
            <div class="main-header-wrapper">
                <div id="blog-info" class="blog-info">
                    <h1 class="main-title"><a href="<?php echo site_url(); ?>"><?php echo get_bloginfo( 'name' ); ?></a></h1>
                    <h2 class="sub-title"><?php bloginfo( 'description' ); ?></h2>
                </div>
                <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
            </div>
            <nav id="main-navigation" class="main-navigation">
            <input type="checkbox" id="nav" class="hidden"/>
            <label for="nav" class="nav-open"><i></i><i></i><i></i></label>
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
            </nav>
        </header>