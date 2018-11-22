<?php

/*
 Template Name: Tags
 Template Post Type: post
 */
get_header();
?>

<div id="primary" class="content-area">
		<main id="main" class="site-main">
        <?php get_sidebar('left'); ?>
        <section id="main-entry" class="main-entry">
            <article class="entry-content">
            <h1 class="entry-title"><?php  the_title(); ?></h1>
            <ul class="taglist">
                <?php
                $tags = get_tags();
                if ( $tags ) :
                    foreach ( $tags as $tag ) : ?>
                        <li><a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( $tag->name ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>  </article>
        </section>
        <?php 
            get_sidebar('right'); 
            get_sidebar('author');
        ?>
    </main><!-- #main -->
</div> <!-- #primary -->

<?php
get_footer();