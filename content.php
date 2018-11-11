<div id="main-content" class="main-content">
    <?php
    if ( is_archive() ) || (is_category()) :
    <h2 class="blog-post-title">Sample blog post</h2>
        <p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p>
            php the_content();
    ?>
</div>