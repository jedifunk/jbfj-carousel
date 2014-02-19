<?php
/*
	Plugin Name: JBFJ Slider
	Description: Responsive Slider using the BX Slider
	Author: Bryce Flory
	Author URI: http://bryceflory.com
	Version: 1.5.2
*/

// Define Constants
define( 'jbfj_PATH', plugin_dir_path(__FILE__) );

// Create CPT for Slides
add_action( 'init', 'register_cpt_slide' );

function register_cpt_slide() {

    $labels = array( 
        'name' => _x( 'Slides', 'slide' ),
        'singular_name' => _x( 'Slide', 'slide' ),
        'add_new' => _x( 'Add New', 'slide' ),
        'add_new_item' => _x( 'Add New Slide', 'slide' ),
        'edit_item' => _x( 'Edit Slide', 'slide' ),
        'new_item' => _x( 'New Slide', 'slide' ),
        'view_item' => _x( 'View Slide', 'slide' ),
        'search_items' => _x( 'Search Slides', 'slide' ),
        'not_found' => _x( 'No slides found', 'slide' ),
        'not_found_in_trash' => _x( 'No slides found in Trash', 'slide' ),
        'parent_item_colon' => _x( 'Parent Slide:', 'slide' ),
        'menu_name' => _x( 'Slides', 'slide' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies' => array( 'slideshows' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => plugins_url('jbfj-slider/lib/img/images-stack.png'),
        'show_in_nav_menus' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'
    );

    register_post_type( 'slide', $args );
}

// Create Custom Taxonomy for Slideshows
add_action( 'init', 'register_taxonomy_slideshows' );

function register_taxonomy_slideshows() {

    $labels = array( 
        'name' => _x( 'Slideshows', 'slideshows' ),
        'singular_name' => _x( 'Slideshow', 'slideshows' ),
        'search_items' => _x( 'Search Slideshows', 'slideshows' ),
        'popular_items' => _x( 'Popular Slideshows', 'slideshows' ),
        'all_items' => _x( 'All Slideshows', 'slideshows' ),
        'parent_item' => _x( 'Parent Slideshow', 'slideshows' ),
        'parent_item_colon' => _x( 'Parent Slideshow:', 'slideshows' ),
        'edit_item' => _x( 'Edit Slideshow', 'slideshows' ),
        'update_item' => _x( 'Update Slideshow', 'slideshows' ),
        'add_new_item' => _x( 'Add New Slideshow', 'slideshows' ),
        'new_item_name' => _x( 'New Slideshow', 'slideshows' ),
        'separate_items_with_commas' => _x( 'Separate slideshows with commas', 'slideshows' ),
        'add_or_remove_items' => _x( 'Add or remove slideshows', 'slideshows' ),
        'choose_from_most_used' => _x( 'Choose from the most used slideshows', 'slideshows' ),
        'menu_name' => _x( 'Slideshows', 'slideshows' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => false,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => array( 'slug' => 'slideshow' )
    );

    register_taxonomy( 'slideshows', 'slide', $args );
}


// Create New SQL DB Table
function jbfj_slider_create_table() {
	global $wpdb;
	
	$type = 'slideshows';
	$table_name = $wpdb->prefix . $type . 'meta';
		
	  $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
	  	meta_id bigint(20) NOT NULL AUTO_INCREMENT,
	  	{$type}_id bigint(20) NOT NULL default 0,

		meta_key varchar(255) DEFAULT NULL,
		meta_value tinytext DEFAULT NULL,
	   		
	  	UNIQUE KEY meta_id (meta_id)
	);";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}

// this hook will cause our creation function to run when the plugin is activated
register_activation_hook( __FILE__, 'jbfj_slider_create_table' );

// Initialize Plugin
add_action('init', 'jbfj_slider_init');

function jbfj_slider_init() {
	global $wpdb;
	$variable_name = $type . 'meta';
	$wpdb->$variable_name = $table_name;
	$wpdb->slideshowsmeta = $wpdb->prefix . 'slideshowsmeta';
}

//Add Javascript for Slider
add_action('wp_enqueue_scripts', 'jbfj_slider_scripts' );

function jbfj_slider_scripts() {
	
	if ( !is_admin() ) {
	
		wp_register_style('jbfjslider_styles', plugins_url('lib/css/jbfj-slider.css', __FILE__));
		
		wp_register_script('bxslider_script', plugins_url('lib/js/jquery.bxslider.min.js', __FILE__), array('jquery'), false, true );
		wp_register_script('jbfj-slider_script', plugins_url('lib/js/jbfj-slider-script.js', __FILE__), array('jquery'), false, true );

	}
	
}


/******************* SLIDE ADMIN & SETTINGS SECTIONS ****************/
if ( is_admin() ) {
	require_once( 'lib/jbfj-slider-admin.php' );
	require_once( 'lib/jbfj-slider-settings.php' );
}

/******************* FRONT END OUTPUT *******************/
//Display functionality
function jbfj_slider( $slideshow = '' ) {
	include('lib/jbfj-slider-output.php');	
	global $slideshows;	
	global $wpdb;
	
	$term = get_term_by( 'name', $slideshow, 'slideshows' );
	$slideshowid = $term->term_id;	
	$table_name = $wpdb->prefix . 'slideshowsmeta';
	
	$slider_mode = $wpdb->get_var( "SELECT meta_value FROM wp_slideshowsmeta WHERE slideshows_id = {$slideshowid} AND meta_key= 'slider_mode'" );
	$slider_speed = $wpdb->get_var( "SELECT meta_value FROM wp_slideshowsmeta WHERE slideshows_id = {$slideshowid} AND meta_key= 'slider_speed'" );
	$slider_pause = $wpdb->get_var( "SELECT meta_value FROM wp_slideshowsmeta WHERE slideshows_id = {$slideshowid} AND meta_key= 'slider_pause'" );
	$slider_useCSS = $wpdb->get_var( "SELECT meta_value FROM wp_slideshowsmeta WHERE slideshows_id = {$slideshowid} AND meta_key= 'slider_useCSS'" );
	$slider_pager = $wpdb->get_var( "SELECT meta_value FROM wp_slideshowsmeta WHERE slideshows_id = {$slideshowid} AND meta_key= 'slider_pager'" );
	$slider_controls = $wpdb->get_var( "SELECT meta_value FROM wp_slideshowsmeta WHERE slideshows_id = {$slideshowid} AND meta_key= 'slider_controls'" );
	$slider_hover = $wpdb->get_var( "SELECT meta_value FROM wp_slideshowsmeta WHERE slideshows_id = {$slideshowid} AND meta_key= 'slider_hover'" );
	$slider_ticker = $wpdb->get_var( "SELECT meta_value FROM wp_slideshowsmeta WHERE slideshows_id = {$slideshowid} AND meta_key= 'slider_ticker'" );
	$slider_tHover = $wpdb->get_var( "SELECT meta_value FROM wp_slideshowsmeta WHERE slideshows_id = {$slideshowid} AND meta_key= 'slider_tHover'" );
	
	$slideshows[$slideshow] = array(
		'jbfjslidermode' => $slider_mode,
		'jbfjsliderspeed' => $slider_speed,
		'jbfjsliderpause' => $slider_pause,
		'jbfjslideruseCSS' => $slider_useCSS,
		'jbfjsliderpager' => $slider_pager,
		'jbfjslidercontrols' => $slider_controls,
		'jbfjsliderhover' => $slider_hover,
		'jbfjsliderticker' => $slider_ticker,
		'jbfjslidertHover' => $slider_tHover
	);
	
	wp_enqueue_script('bxslider_script');
	wp_enqueue_script('jbfj-slider_script');
	wp_enqueue_style('jbfjslider_styles');
}

//Localize Settings for use in Slider JS
add_action( 'wp_footer', 'jbfj_slider_localize' );

function jbfj_slider_localize() {
	global $slideshows;	
	
	if ( !is_admin() ) {
	
		wp_localize_script('jbfj-slider_script', 'jbfjslidersettings', $slideshows);
	}
}
