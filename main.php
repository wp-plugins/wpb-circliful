<?php
/**
Plugin Name: WPB Circliful
Plugin URI: http://demo.wpbean.com/wpb-circliful/
Description: By this plugin you can show any data statistics like percent,amount etc. You can choose different color, size, amount for each post. To use this plugin just put a shortcode to your post or page or anywhere. Shortcode: [wpb-circliful]
<br> jQuery Plugin by: <a href="https://github.com/pguso" target="_blank" >pguso</a>.
<br> Custom-Metaboxes-and-Fields by: <a href="https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress" target="_blank" >WebDevStudios</a>.
Author: WpBean
Version: 1.0
Author URI: http://wpbean.com
*/

//--------------- Adding Latest jQuery------------//
function wpb_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'wpb_jquery');


//-------------- include js files---------------//
function wpb_adding_scripts() {
wp_register_script('wpb_Circliful_js', plugins_url('js/jquery.circliful.min.js', __FILE__), array('jquery'),'1.10.2', true);
wp_enqueue_script('wpb_Circliful_js');
}
add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' ); 


//------------ include css files-----------------//
function wpb_adding_style() {
wp_register_style('wpb_Circliful_style', plugins_url('css/jquery.circliful.css', __FILE__),'','1.10.2', false);
wp_register_style('wpb_fontawesoume_style', plugins_url('css/font-awesome.min.css', __FILE__),'','4.3.0', false);
wp_register_style('wpb_main_style', plugins_url('css/main.css', __FILE__),'','1.0', false);
wp_enqueue_style('wpb_Circliful_style');
wp_enqueue_style('wpb_fontawesoume_style');
wp_enqueue_style('wpb_main_style');
}
add_action( 'init', 'wpb_adding_style' ); 


//--------- trigger the plugin---------------- //
function wpb_trigger() {
?>
<script>
	jQuery(document).ready(function() {
		jQuery('#myStat,#myStat4,#myStat2').circliful();
    });
</script>

<?php
}
add_action('wp_footer','wpb_trigger');


//--------- register post type---------------- //
function wpb_custom_post_circliful() {
        $labels = array(
                'name'               => _( 'Circliful' ),
                'singular_name'      => _( 'Circliful' ),
                'add_new'            => _( 'Add New' ),
                'add_new_item'       => __( 'Add New Circliful' ),
                'edit_item'          => __( 'Edit Circliful' ),
                'new_item'           => __( 'New Circliful' ),
                'all_items'          => __( 'All Circliful' ),
                'view_item'          => __( 'View Circliful' ),
                'search_items'       => __( 'Search Circliful' ),
                'not_found'          => __( 'No Circliful found' ),
                'not_found_in_trash' => __( 'No Circliful found in the Trash' ),
                'parent_item_colon'  => '',
                'menu_name'          => 'Circliful'
        );
        $args = array(
                'labels'        => $labels,
                'description'   => 'Post your Circliful here.',
                'public'        => true,
                'menu_position' => 5,
				'menu_icon' => 'dashicons-backup',
                'supports'      => array( 'title' ),
                'has_archive'   => true,
        );
        register_post_type( 'circliful', $args );
}
add_action( 'init', 'wpb_custom_post_circliful' );


//--------- register short code---------------- //

function  wpb_circliful_shortcode(){

	global $post;
	$return_string = '<div class="cir_area">';
    query_posts(array('post_type' => 'circliful','orderby' => 'date', 'order' => 'DESC' , 'showposts' => 3));
    if (have_posts()) :
      while (have_posts()) : the_post();
        $return_string .= '<div class="cir_single">';
		$return_string .= '<div id="myStat"
		data-dimension="'.get_post_meta( $post->ID, '_cmb_wpb_dimension', true ).'" 
		data-text="'.get_post_meta( $post->ID, '_cmb_wpb_percent', true ).''.get_post_meta( $post->ID, '_cmb_wpb_type', true ).'" 
		data-info="'.get_the_title().'" 
		data-width="'.get_post_meta( $post->ID, '_cmb_wpb_width', true ).'" 
		data-fontsize="'.get_post_meta( $post->ID, '_cmb_wpb_fontsize', true ).'" 
		data-percent="'.get_post_meta( $post->ID, '_cmb_wpb_percent', true ).'" 
		data-fgcolor="'.get_post_meta( $post->ID, '_cmb_wpb_color', true ).'"  
		data-border="inline" 
		data-icon="'.get_post_meta( $post->ID, '_cmb_wpb_icon', true ).'">
		</div>';
		$return_string .= '</div>';
      endwhile;
   endif;
   $return_string .= '</div>';

   wp_reset_query();
   return $return_string;
   
}
function wpb_register_shortcodes(){
   add_shortcode('wpb-circliful', 'wpb_circliful_shortcode');
}
add_action( 'init', 'wpb_register_shortcodes');


//--------- Initialize the metabox class---------------- //
add_action( 'init', 'wpb_initialize_cmb_meta_boxes', 9999 );
function wpb_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once( 'lib/init.php' );
    }
}


//--------- configure metabox---------------- //
require_once( 'wpb_metaboxes.php' );