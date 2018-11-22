<?php

/**
 * The 404 template file
 *
 * This page shows up when you are lost.
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
            <h1 class="entry-title">Sooo sorry.......</h1>
                <p>Hier gibt es nichts zu sehen. Haben Sie sich verlaufen?</p>
                <p>Möchten Sie die Bibliothek benutzen?</p>
                <h3>Bibliotheksbenutzung</h3>
                <?php get_search_form(); ?>
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