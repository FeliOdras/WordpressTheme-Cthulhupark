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
            <h1>This is the Author's page</h1>
            <?php 
                $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
            ?>
            <!-- The Loop -->
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                    <?php the_title(); ?></a>,
                    <?php the_time('d M Y'); ?> 
                </li>
            <?php endwhile; else: ?>
                <p><?php _e('No posts by this author.'); ?></p>
            <?php endif; ?>
            <!-- End Loop -->
        <?php get_sidebar(right); ?>
    </main><!-- #main -->
</div> <!-- #primary -->

<?php
get_footer();