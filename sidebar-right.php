<aside id="sidebar-right" class="sidebar-right sidebar">
    <div class="latestTBE"></div>
    <?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
        <ul class="widget-area" id="widget-area-left">
            <?php dynamic_sidebar( 'sidebar-right' ); ?>
        </ul>
    <?php endif; ?>
    
</aside>