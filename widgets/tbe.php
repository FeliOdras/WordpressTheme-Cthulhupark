<?php
# Register and load TBE Widget
function cptbe_load_widget() {
    register_widget( 'cptbe_widget' );
}
add_action( 'widgets_init', 'cptbe_load_widget' );

// Creating the widget 
class cptbe_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'cptbe_widget', 
            // Widget name will appear in UI
            __('Tagebucheinträge', 'cthulhupark'), 
            // Widget description
            array( 'description' => __( 'Tagebucheinträge', 'cthulhupark' ), ) 
        );
    }
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        # Output TBE
        // The Query
        query_posts(array('category_name' => 'abenteurertagebuch', 'posts_per_page' => 23 ));
        echo '<ul class="hidden tbe-ul">';
        // The Loop
        while ( have_posts() ) : the_post() ?>
            <li class="entries">
                <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" ><?php the_title(); ?>
                <br />
                <div class="tbe-entry-meta">
                    <span class="author"><?php the_author_meta( 'nickname' )?></span>
                    <span class="date"><?php the_time('j. F Y') ?></span>
                </div>
                </a>
            </li>
        <?php endwhile;
        echo '</ul>';
        // Reset Query
        wp_reset_query();
    }  
    # End of Widget output TBE     
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Tagebucheinträge', 'cthulhupark' );
        }
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php __( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <?php 
    }    
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class cptbe_widget ends here
?>