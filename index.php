<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Cthulhupark 
 */

get_header();
get_sidebar('left');
?>
    <div id="primary" class="content-area">
		<main id="main" class="site-main">
        <?php 
            if ( have_posts() ) :
            while ( have_posts() ) : the_post();
        ?>
        
        <h2><?php the_title() ?></h2>
		<?php the_content() ?>

        <?php
            endwhile;
            else :
            echo '<p>Hier gibt es leider nichts zu sehen</p>';
            endif;
        ?>
            <?php 
                get_sidebar('right'); 
                get_sidebar('author');
            ?>
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();