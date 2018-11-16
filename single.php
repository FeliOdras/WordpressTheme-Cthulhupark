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
            <?php get_sidebar('left'); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                   <section id="main-entry" class="main-entry">
                    <article class="entry-content <?php if (in_category('traumwelten')) :?>dreamlands<?php elseif (in_category('abenteurertagebuch')) :?>dairy<?php endif;?> <?php the_author_nickname() ?>">
                       <?php if (in_category('traumwelten') || in_category('abenteurertagebuch')) :?>
                            <time class="date"><?php the_time('l, j. F Y') ?></time>
                        <?php endif; ?>
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                        <div class="edit-link"><?php edit_post_link('Bearbeiten', '', ''); ?></div>                        
                    </article><!-- .main-post -->
                    <?php if (in_category('traumwelten') || in_category('abenteurertagebuch')) :?>
                        <footer class="post-navigation">
                            <div class="author"><?php _e('Von', 'cthulhupark') ?> <?php the_author_posts_link(); ?></div>
                                <?php next_post_link('%link', '%title', TRUE); ?> ~ <?php previous_post_link('%link', '%title', TRUE); ?>
                        </footer>
                    <?php endif; ?>
                    </section>         
                <?php endwhile; // end of the loop. ?>
            <?php 
                get_sidebar('right');
                get_sidebar('author');
             ?>
        </main><!-- #main -->
    </div> <!-- #primary -->


<?php
get_footer();