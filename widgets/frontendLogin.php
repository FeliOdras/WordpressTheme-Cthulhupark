<?php 
# Register and load Login Widget
function cplogin_load_widget() {
    register_widget( 'cplogin_widget' );
}
add_action( 'widgets_init', 'cplogin_load_widget' );
 // Creating the widget 
class cplogin_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'cplogin_widget', 
            __('Login', 'cthulhupark'), 
            array( 'description' => __( 'Login Form', 'cthulhupark' ), ) 
        );
    }
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        
        # Output Login Form
        global $user_login;
        // In case of a login error.
        if ( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) : ?>
            <div class="login_error">
                <p><?php __( 'Fehler. Bitte versuche es noch einmal.', 'cthulhupark' ); ?></p>
            </div>
        <?php 
        endif;
        // If user is already logged in.
        if ( is_user_logged_in() ) : ?>
            <div class="logout"> 
                <?php 
                    _e( 'Hallo ', 'cthulhupark' ); 
                    echo $user_login; 
                ?>
            </div>
            <a id="wp-submit" href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">
                <?php _e( 'Logout', 'cthulhupark' ); ?>
            </a>
            <?php 
            // If user is not logged in.
        else: 
            // Login form arguments.
            $args = array(
                'echo'           => true,
                'form_id'        => 'loginform',
                'label_username' => __( 'Username' ),
                'label_password' => __( 'Password' ),
                'label_remember' => __( 'Remember Me' ),
                'label_log_in'   => __( 'Log In' ),
                'id_username'    => 'user_login',
                'id_password'    => 'user_pass',
                'id_remember'    => 'rememberme',
                'id_submit'      => 'wp-submit',
                'remember'       => true,
                'value_username' => NULL,
                'value_remember' => true
                ); 
            // Calling the login form.
            wp_login_form( $args );
        endif;
    }
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Parole', 'cthulhupark' );
        }
        // Widget admin form
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
} // Class cplogin_widget ends here
?>