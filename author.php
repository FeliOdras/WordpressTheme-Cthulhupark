<?php
/**
 * The author page template file	
 *
 * @package Cthulhupark 
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php get_sidebar(left); ?>


        <?php get_sidebar(right); ?>
    </main><!-- #main -->
</div> <!-- #primary -->

<?php
get_footer();