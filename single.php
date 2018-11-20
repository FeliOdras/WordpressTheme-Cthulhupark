<?php
/**
 * The single post template file	
 *
 * @package Cthulhupark 
 */

get_header();
$taxonomy = 'category';
 
 // Get the term IDs assigned to post.
 $post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
  
 // Separator between links.
 $separator = ' ';
 $term_ids = implode( ',' , $post_terms );
 $terms = wp_list_categories( array(
         'title_li' => '',
         'style'    => 'none',
         'echo'     => false,
         'taxonomy' => $taxonomy,
         'include'  => $term_ids
  ) );
  $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
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
                        <div class="categories">
                            <?php // Display post categories.
                                if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) && ! in_category('traumwelten') && ! in_category('abenteurertagebuch') ) {echo  $terms;};
                            ?>
                        </div>
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                        <div class="single-post-entry">
                            <?php the_content(); ?>
                        </div> <!-- single post entry -->
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