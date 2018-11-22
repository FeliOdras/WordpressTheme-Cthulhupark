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
        <?php get_sidebar('left'); ?>
        <section id="main-entry" class="main-entry">
            <article class="entry-content">
                <?php while ( have_posts() ) : the_post(); ?>
                    <h1 class="entry-title"><?php  the_title(); ?></h1>
                    <?php the_content(); ?>
                <?php endwhile; // end of the loop. ?>
            </article>
        </section>
            <?php 
                get_sidebar('right'); 
                get_sidebar('author');
            ?>
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();