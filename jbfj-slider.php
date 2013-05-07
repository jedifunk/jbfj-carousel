<?php
/*
	Plugin Name: JBFJ Slider
	Description: Custom Slider
	Author: Bryce Flory
	Author URI: http://bryceflory.com
	Version: 1.2
*/

// Define Constants
define( 'JBFJ_PATH', plugin_dir_path(__FILE__) );

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
        'taxonomies' => array( 'category' ),
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

//Add CSS for Slider
add_action('wp_print_styles', 'jbfj_slider_styles');

function jbfj_slider_styles() {
	//register
	wp_register_style('bxslider_styles', plugins_url('lib/css/jquery.bxslider.css', __FILE__));
	
	//enqueue
	wp_enqueue_style('bxslider_styles');
}

//Add Javascript for Slider
add_action('wp_print_scripts', 'jbfj_slider_scripts');

function jbfj_slider_scripts() {

	$jbfjslider_options = get_option('jbfj_slider_options');
	
	if ( !is_admin() ) {
		//register
		//wp_register_script('jquery-easing', plugin_url('lib/js/jquery.easing.1.3.js', __FILE__), array('jquery'));
		//wp_register_script('fitvids', plugin_url('lib/js/jquery.fitvids.js', __FILE__), array('jquery'));
		wp_register_script('bxslider_script', plugins_url('lib/js/jquery.bxslider.min.js', __FILE__), array('jquery'));
		wp_register_script('jbfj-slider_script', plugins_url('lib/js/script.js', __FILE__));
		
		//enqueue
		wp_enqueue_script('bxslider_script');
		wp_enqueue_script('jbfj-slider_script');
	
		wp_localize_script('jbfj-slider_script', 'jbfjslidersettings',
			array(
				'jbfjslidermode' => $jbfjslider_options['slider_mode'],
				'jbfjsliderspeed' => $jbfjslider_options['slider_speed'],
				'jbfjsliderpause' => $jbfjslider_options['slider_pause'],
				'jbfjslideruseCSS' => $jbfjslider_options['slider_useCSS'],
				'jbfjsliderpager' => $jbfjslider_options['slider_pager'],
				'jbfjslidercontrols' => $jbfjslider_options['slider_controls'],
				'jbfjsliderhover' => $jbfjslider_options['slider_hover'],
				'jbfjsliderticker' => $jbfjslider_options['slider_ticker'],
				'jbfjslidertHover' => $jbfjslider_options['slider_tHover']
			)
		);

	}
}

/******************* SETTINGS SECTION ************************/
// Add admin menu
function jbfj_slider_settings_menu() {
	require JBFJ_PATH . 'lib/jbfj-slider-settings.php';
	//add submenu
	add_submenu_page('edit.php?post_type=slide', 'Slider Settings', 'Slider Settings', 'manage_options', 'slider-settings', 'jbfj_slider_settings_page');
}
add_action('admin_menu', 'jbfj_slider_settings_menu');

/******************* SLIDE ADMIN SECTION ****************/
if ( is_admin() ) {
	require_once( 'lib/jbfj-slider-admin.php' );	
}

/******************* FRONT END OUTPUT *******************/
//Display functionality
function jbfj_slider() {
	require JBFJ_PATH . 'lib/jbfj-slider-output.php';
}
