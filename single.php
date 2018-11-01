<?php
/**
 * The single post template file	
 *
 * @package Cthulhupark 
 */

get_header();
?>

    <div id="primary" class="content-area">
		<main id="main" class="site-main">
            <?php get_sidebar(left); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <h3><?php the_category('&nbsp;&rsaquo;&nbsp;'); echo "&nbsp;&rsaquo;&nbsp;"; the_title(); ?></h3>
                    <?php the_content(); ?>
                <?php endwhile; // end of the loop. ?>
            <?php get_sidebar(right); ?>
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();