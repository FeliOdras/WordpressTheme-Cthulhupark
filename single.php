<?php
/**
 * The single post template file
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
                <h1><?php the_title(); ?></h1>
            </header> <!-- .page-header-->
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();