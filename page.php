<?php
/**
 * The page template file	
 *
 * @package Cthulhupark 
 */

get_header();
?>

<div id="primary" class="content-area">
		<main id="main" class="site-main">
        <?php get_sidebar(left); ?>
          <?php while ( have_posts() ) : the_post(); ?>
                <h2><?php  the_title(); ?></h2>
                <?php the_content(); ?>
            <?php endwhile; // end of the loop. ?>
            <?php get_sidebar(right); ?>
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();