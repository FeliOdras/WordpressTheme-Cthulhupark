<?php
/**
 * The archive template file
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
            <header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="page-description">', '</div>' );
				?>
            </header><!-- .page-header -->
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article class="post-main">
                    <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h2>
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
                    <div class="more-link">Weiterlesen</div>
                </div><!-- .post-main -->
            <?php endwhile; endif; ?>
            <?php posts_nav_link('','<span class="prev">Neuere Beiträge</span>','<span class="next">Ältere Beiträge</span>'); ?>
            <?php get_sidebar(right); ?>
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();