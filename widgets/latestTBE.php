<?php 
function cpLatestTBE_load_widget() {
    register_widget( 'cpLatestTBE_widget' );
}
add_action( 'widgets_init', 'cpLatestTBE_load_widget' );

class cpLatestTBE_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'cpLatestTBE_widget', 
            // Widget name will appear in UI
            __('Neueste Tagebucheinträge', 'cthulhupark'), 
            // Widget description
            array( 'description' => __( 'Neueste Tagebucheinträge', 'cthulhupark' ), ) 
        );
    }
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        # Output Latest TBE
        echo '<div class="latestTBE"></div>';
    }  
    # End of Widget output Latest TBE       
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Neue Beiträge', 'cthulhupark' );
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
    # Class cpLatestTBE ends here
}
?>