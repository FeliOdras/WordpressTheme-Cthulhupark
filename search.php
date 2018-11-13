<?php
/**
 * The search results template file
 *
 * This is to organize categories and archives of our blog.
 *
 * @package Cthulhupark 
 */

get_header();
?>
    <div id="primary" class="content-area">
		<main id="main" class="site-main">
            <?php get_sidebar(left); ?>
            <section class="main-entry">
            <header class="page-header">
                <h2 class="page-title"> <?php _e('Suche', 'cthulhupark') ?></h2>
            </header><!-- .page-header -->
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <article class="post-main <?php if (in_category(traumwelten)) :?>dreamlands<?php elseif (in_category(abenteurertagebuch)) :?>dairy<?php endif;?> <?php the_author_nickname() ?>">
                        <header class="post-header">
                            <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h2>
                            <div class="post-meta">Verfasst von <?php the_author_link(); ?>  am <?php the_time('l, j. F Y') ?></div>
                        </header>
                        <div class="featured-image">
                            <?php 
                            // check if the post has a Post Thumbnail assigned to it.
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail();
                            } else {?>
                                <img src="<?php bloginfo('template_directory'); ?>/images/Aelteres_Zeichen_Upgrade_Eye_of_light_and_darkness.png" alt="<?php the_title(); ?>" />
                            <?php } ?>
                        </div><!-- .featured-image -->
                        <div class="post-excerpt">
                            <?php the_excerpt () ?>
                        </div> <!-- .post-excerpt -->
                        <footer class="post-footer">
                            <a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Weiterlesen</a>
                        </footer>
                    </article><!-- .post-main -->
                <?php endwhile; endif; ?>
                <nav class="post-navigation">
                    <?php posts_nav_link('','<span class="prev">Neuere Beiträge</span>','<span class="next">Ältere Beiträge</span>'); ?>
                </nav>
            </section>
            <?php get_sidebar(right); ?>
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();