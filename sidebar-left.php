<aside id="sidebar-left" class="sidebar-left sidebar ">
    <ul>
        <?php if ( is_active_sidebar( 'sidebar-left' ) ) : 
            dynamic_sidebar( 'sidebar-left' ); 
        endif; ?>
    </ul>
</aside>