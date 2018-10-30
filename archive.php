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
        </main><!-- #main -->
    </div> <!-- #primary -->

<?php
get_footer();