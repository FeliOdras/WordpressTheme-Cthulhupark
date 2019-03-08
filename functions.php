<?php 
# Enquueue Scrips and Styles
function cthulhupark_theme_styles() {
    wp_enqueue_style( 'cthulhupark', get_template_directory_uri().'/style.css', array(), 1.0, 'screen' );
    wp_enqueue_script( 'cthulhupark-main', get_template_directory_uri() . '/js/cthulhupark-main.js', array(), 1.0, true);
    wp_enqueue_script( 'wp-api' );
}
add_action( 'wp_enqueue_scripts', 'cthulhupark_theme_styles' );


# Change Excerpt length
function custom_excerpt_length( $length ) {
	return 23;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

#Custom Header Image
$args = array(
    'width'         => 1000,
    'flex-width'    => true,
    'height'        => 150,
    'flex-height'   => true,
	'default-image' => get_template_directory_uri() . '/images/default-header.png',
);
add_theme_support( 'custom-header', $args );

#Custom Menus
function register_my_menu() { 
    register_nav_menu('main-menu',__( 'Main Menu' )); 
} 
add_action( 'init', 'register_my_menu' );

#Remove "Archive" and "Tag" from category title 
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } 
    return $title;
});

#Exclude category dairy and dreamlands from search query
function wcs_exclude_category_search( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
      return;
  
    if ( $query->is_search ) {
      $query->set( 'cat', '-2, -11' );
    }
  
  }
  add_action( 'pre_get_posts', 'wcs_exclude_category_search', 1 );

# Register sidebars

// Left Sidebar
function sidebar_left() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar left', 'cthulhupark' ),
            'id' => 'sidebar-left',
            'description' => __( 'Left sidebar', 'cthulhupark' ),
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'sidebar_left' );

// Right sidebar
function sidebar_right() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar right', 'cthulhupark' ),
            'id' => 'sidebar-right',
            'description' => __( 'Right sidebar', 'cthulhupark' ),
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'sidebar_right' );

// Author sidebar
function sidebar_author() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar author', 'cthulhupark' ),
            'id' => 'sidebar-author',
            'description' => __( 'Author sidebar', 'cthulhupark' ),
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'sidebar_author' );


#Add post thumbnail support
add_theme_support( 'post-thumbnails' );

# Register and load author list widget
function cpal_load_widget() {
    register_widget( 'cpal_widget' );
}
add_action( 'widgets_init', 'cpal_load_widget' );
 
// Creating the widget 
class cpal_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'cpal_widget', // Widgets base ID
            __('Cthulhu Author List', 'cthulhupark'), // Widget name displayed in backend
            array( 'description' => __( 'Lists Posts by author', 'cthulhupark' ), ) // Widget description 
        );
    }
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        // This is where you run the code and display the output
        echo '<ul>';
        wp_list_authors( 'show_fullname=1&optioncount=1&orderby=post_count&order=DESC&number=10&include=1,6,7,9,10,11,12,14,15&echo=true');
        echo '</ul>';
    }        
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Scriptoren', 'cthulhupark' );
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
} // Class cpal_widget ends here

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
        echo '<ul>';
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
            <a id="wp-submit" href="<?php echo wp_logout_url(home_url()); ?>" title="Logout">
                <?php _e( 'Logout', 'cthulhupark' ); ?>
            </a>
            <?php 
            // If user is not logged in.
        else: 
            // Login form arguments.
            $args = array(
                'echo'           => true,
                'redirect'       => home_url(), 
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

include 'widgets/latestTBE.php';



?>