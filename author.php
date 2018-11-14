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
           <section class="main-entry"> 
            <?php 
                $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
            ?>
            <h2>Beiträge von <?php echo $curauth->display_name; ?></h2>
            <!-- The Loop -->
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article class="post-main <?php if (in_category(traumwelten)) :?>dreamlands<?php elseif (in_category(abenteurertagebuch)) :?>dairy<?php endif;?> <?php the_author_nickname() ?>">
                    <header class="post-header">
                        <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h2>
                        <?php the_time('j. F Y') ?>
                    </header>
                    <div class="archive-entry">
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
                    </div><!-- .archive-entry -->
                   
                </article><!-- .post-main -->
            <?php endwhile; else: ?>
                <p><?php _e('No posts by this author.'); ?></p>
            <?php endif; ?>
            <nav class="post-navigation">
                <?php posts_nav_link('','<span class="prev">Neuere Beiträge</span>','<span class="next">Ältere Beiträge</span>'); ?>
            </nav>
            <!-- End Loop -->
            </section>
        <?php get_sidebar(right); ?>
    </main><!-- #main -->
</div> <!-- #primary -->

<?php
get_footer();