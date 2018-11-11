<?php 
function cthulhupark_theme_styles() {
    wp_enqueue_style( 'cthulhupark', get_template_directory_uri().'/style.css', array(), 1.0, 'screen' );
}
add_action( 'wp_enqueue_scripts', 'cthulhupark_theme_styles' );

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

# Register sidebars

function sidebar_left() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar left', 'cthulhupark' ),
            'id' => 'sidebar-left',
            'description' => __( 'Left sidebar', 'cthulhupark' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'sidebar_left' );

function sidebar_right() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar right', 'cthulhupark' ),
            'id' => 'sidebar-right',
            'description' => __( 'Right sidebar', 'cthulhupark' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'sidebar_right' );

#Add post thumbnail support
add_theme_support( 'post-thumbnails' );

// Register and load author list widget
function wpb_load_widget() {
    register_widget( 'cpal_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
// Creating the widget 
class cpal_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'cpal_widget', 
 
// Widget name will appear in UI
__('Cthulhu Author List', 'cthulhupark'), 
 
// Widget description
array( 'description' => __( 'Lists Posts by author', 'cthulhupark' ), ) 
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
wp_list_authors( 'show_fullname=1&optioncount=1&orderby=post_count&order=DESC&number=10&include=1,6,7,9,10,11,12,14,15&echo=true');
}
         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
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
} // Class wpb_widget ends here

#Make translation ready
load_theme_textdomain( 'cthulhupark', '~/Documents/ari/projects/wordpress/hq.cthulhupark/wp-content/themes/cthulhupark' );
?>