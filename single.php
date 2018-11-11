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
                   <section id="main-entry" class="main-entry">
                    <article class="entry-content <?php if (in_category(traumwelten)) :?>dreamlands<?php elseif (in_category(abenteurertagebuch)) :?>dairy<?php endif;?> <?php the_author_nickname() ?>">
                        <time class="date"><?php the_time('l, j. F Y') ?></time>
                        <h3><?php the_title(); ?></h3>
                        <?php the_content(); ?>
                        <div class="author"><?php _e('By', 'cthulhupark') ?> <?php the_author_posts_link(); ?></div>

                        <footer class="post-navigation">
                            <?php next_post_link('%link', '%title', TRUE); ?> ~ <?php edit_post_link('Edit', '', ''); ?> ~ <?php previous_post_link('%link', '%title', TRUE); ?>
                        </footer>
                    </article><!-- .main-post -->
                    </section>         
                <?php endwhile; // end of the loop. ?>
            <?php get_sidebar(right); ?>
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();