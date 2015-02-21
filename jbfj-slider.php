<?php
/*
    Plugin Name: JBFJ Slider
    Description: Custom Slider
    Author: Bryce Flory, Chad Sanda and Cameron Huntington
    Author URI: http://bryceflory.com
    Version: 1.7.3
*/

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
        'menu_icon' => plugins_url('jbfjwp-slider/lib/img/images-stack.png'),
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


// Activate plugin with multisite check
register_activation_hook( __FILE__, 'jbfj_slider_activate' );

function jbfj_slider_activate($networkwide) {
    global $wpdb;

    if ( function_exists( 'is_multisite' ) && is_multisite() ) {
        if ($networkwide) {
            $old_blog = $wpdb->blogid;
            $blogids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->blogs}");
            foreach ( $blogids as $blog_id ) {
                switch_to_blog($blog_id);
                jbfj_slider_table_activation();
            }
            switch_to_blog($old_blog);
            return;
        }
    }
    jbfj_slider_table_activation();
}

// Prep for table creation
function jbfj_slider_table_activation() {
    global $wpdb;

    $type = 'slideshows';
    $table_name = $wpdb->prefix . $type . 'meta';

    if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {
        jbfj_slider_create_table( $table_name, $type );
    }
}

// Create Table & activate plugin when new site added to multisite
add_action( 'wpmu_new_blog', 'new_blog', 10, 6);

function new_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
    global $wpdb;

    if ( is_plugin_active_for_network( 'jbfjwp-slider/jbfj-slider.php' ) ) {
        $old_blog = $wpdb->blogid;
        switch_to_blog( $blog_id );
        jbfj_slider_table_activation();
        switch_to_blog( $old_blog );
    }
}

// Create custom table
function jbfj_slider_create_table( $table_name, $type ) {
    global $wpdb;

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
    require_once( 'lib/jbfj-slider-settings-forms.php' );
}

/******************* FRONT END OUTPUT *******************/
function jbfj_slider( $slideshow = '' ) {

    global $slideshows;
    global $wpdb;
    
    // Rename Name to slug via string replacement and lowercasing
    $slideshow = strtolower(str_replace(' ', '-', $slideshow));
    
    // Include the output file
    include('lib/jbfj-slider-output.php');
    
    // Get our slideshow and pull settings from the DB
    $term = get_term_by( 'slug', $slideshow, 'slideshows' );
    $table_name = $wpdb->prefix . 'slideshowsmeta';
    $slideshowid = $term->term_id;

    // Get meta_keys and meta_values columns, combine to $settings associative array
    $slider_keys = $wpdb->get_col( "SELECT meta_key from {$table_name} WHERE slideshows_id = {$slideshowid}");
    $slider_values = $wpdb->get_col( "SELECT meta_value from {$table_name} WHERE slideshows_id = {$slideshowid}");
    $slider_settings = array_combine($slider_keys, $slider_values);

    // Hack for old versions of PHP to use boolval
	if (!function_exists('boolval')) {
        function boolval($val) {
                return (bool) $val;
        }
	
	}

    // Store each sliders settings in a multi-dimensional array
    $slideshows[$slideshow] = array(
        'jbfjslidermode' => $slider_settings['slider_mode'],
        'jbfjsliderspeed' => $slider_settings['slider_speed'],
        'jbfjsliderpause' => $slider_settings['slider_pause'],
        'jbfjslideruseCSS' => boolval($slider_settings['slider_useCSS']),
        'jbfjsliderpager' => boolval($slider_settings['slider_pager']),
        'jbfjslidercontrols' => boolval($slider_settings['slider_controls']),
        'jbfjsliderhover' => boolval($slider_settings['slider_hover']),
        'jbfjsliderticker' => boolval($slider_settings['slider_ticker']),
        'jbfjslidertHover' => boolval($slider_settings['slider_tHover']),
        'jbfjsliderminSlides' => $slider_settings['slider_minSlides'],
		'jbfjslidermaxSlides' => $slider_settings['slider_maxSlides'],
		'jbfjsliderslideWidth' => $slider_settings['slider_slideWidth']
    );  
    
    // Load necessary scripts for use with slider
    wp_enqueue_script('bxslider_script');
    wp_enqueue_script('jbfj-slider_script');
    wp_enqueue_style('jbfjslider_styles');
}

// Localize Settings for use in Slider JS
add_action( 'wp_footer', 'jbfj_slider_localize' );

function jbfj_slider_localize() {
    global $slideshows;

    if ( !is_admin() ) {
        wp_localize_script('jbfj-slider_script', 'jbfjslidersettings', $slideshows);
    }
}

// Custom Shortcode
function jbfj_slider_shortcode($atts) {
    extract(shortcode_atts(array(
        'slug' => ''
    ), $atts) );
    $slug = "{$slug}";
    ob_start(); // Output buffering not entirely necessary, but handy for waiting on large chunks of return html
    $result = jbfj_slider($slug);
    $result = ob_get_clean();
    return $result;
}

/* rename to match above */
add_shortcode("slider", "jbfj_slider_shortcode");
