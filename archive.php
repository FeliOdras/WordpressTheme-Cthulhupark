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
            <header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="page-description">', '</div>' );
				?>
            </header><!-- .page-header -->
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h2 class="post-title"><a href="<?php the_permalink(); ?>
" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h2>
            <!-- contents of the loop -->

            <?php endwhile; endif; ?>

            <?php posts_nav_link('|','Neuere Beiträge','Ältere Beiträge'); ?>
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();