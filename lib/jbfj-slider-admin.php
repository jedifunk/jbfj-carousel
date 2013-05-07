<?php
// Add Thumbnail Support
add_theme_support('post-thumbnails');

// Customize and move featured image box to main column
add_action( 'do_meta_boxes', 'jbfjslider_image_box' );

function jbfjslider_image_box() {
	remove_meta_box( 'postimagediv', 'slide', 'side' );
	add_meta_box( 'postimagediv', 'Slide Image', 'post_thumbnail_meta_box', 'slide', 'normal', 'high' );
}

// Remove permalink metabox
add_action( 'admin_menu', 'jbfjslider_remove_permalink_meta_box' );

function jbfjslider_remove_permalink_meta_box() {
	remove_meta_box( 'slugdiv', 'slide', 'core' );
}


/*************** CUSTOM META BOXES ***************/
// Add Meta Box for Slide Link URL
add_action('add_meta_boxes', 'jbfjslider_slide_url_meta_box');
add_action('save_post', 'add_slide_url');

function jbfjslider_slide_url_meta_box() {
	add_meta_box('slide_url_meta_box', 'Slide Link URL', 'slide_url_callback', 'slide', 'normal');
}

function slide_url_callback() {
	global $post;
	$url = get_post_meta($post->ID, 'slide_url', true);
	echo '<label for="slide_url_id">Custom URL:</label><input id="slide_url_id" name="slide_url_id" type="text" value="'.esc_attr($url).'" />';	
}

function add_slide_url() {
	global $post;
	$data = $_POST['slide_url_id'];
	update_post_meta($post->ID, 'slide_url', $data);
}