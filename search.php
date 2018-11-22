<?php

/*
 Template Name: Tags
 Template Post Type: post, page
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
			</div>	
			<?php endwhile; ?>
        </section>
        <?php 
            get_sidebar('right'); 
            get_sidebar('author');
        ?>
    </main><!-- #main -->
</div> <!-- #primary -->

<?php
get_footer();