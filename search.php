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
        <?php get_sidebar('left'); ?>
        <section id="main-entry" class="main-entry">
            <article class="entry-content">
                <h1 class="entry-title"><?php  the_title(); ?></h1>
                <article><?php echo $wp_query->found_posts; ?> <?php _e( 'Suchergebnisse für ', 'locale' ); ?>: "<?php the_search_query(); ?>"</article>
                <?php
			    // Start the Loop.
                while ( have_posts() ) : the_post() ?>
                    <div class="archive-entry">
                        <header class="post-header">                                   
                            <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h2>
                        </header>
                        <div class="post-excerpt">
                            <?php the_excerpt () ?>
                        </div> <!-- .post-excerpt -->
                        <footer class="search-meta">
                            Kategorien: <?php echo get_the_category_list(); ?><br />
                            <?php the_tags(); ?>
                        </footer>              
			        </div>	
                <?php endwhile; ?>
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