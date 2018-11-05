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
                    <div class="main-post <?php if (in_category(traumwelten)) :?>dreamlands<?php elseif (in_category(abenteurertagebuch)) :?>dairy<?php endif;?>">
                        <h3><?php the_title(); ?></h3>
                        <?php the_content(); ?>
                    </div><!-- .main-post -->
                <?php endwhile; // end of the loop. ?>
            <?php get_sidebar(right); ?>
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();