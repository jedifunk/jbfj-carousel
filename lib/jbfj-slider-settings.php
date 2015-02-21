<?php
// Save fields to database
add_action( 'edited_slideshows', 'jbfj_save_slider_settings', 10, 2);
add_action( 'create_slideshows', 'jbfj_save_slider_settings', 10, 2);

function jbfj_save_slider_settings( $term_id, $tt_id ) {

    if (!$term_id) return false;

	foreach($_POST['slider_settings'] as $option => $value) {
		update_metadata('slideshows', $term_id, $option, $value);
	}

}

// Delete fields from database
add_action('delete_slideshows', 'jbfj_delete_slider_settings', 10, 2);

function jbfj_delete_slider_settings( $term_id, $tt_id ) {

	$meta_keys = get_metadata('slideshows', $term_id);

	foreach($meta_keys as $key => $value) {
		delete_metadata('slideshows', $term_id, $key);
	}

}

// Add Slider Metadata on Post Save
function jbfj_create_slider_metadata( $term_id, $tt_id ) {
	
	// Setting a default values for user guidance purposes
	$slider_defaults = array(
		'slider_mode' => 'fade',
		'slider_speed' => '4000',
		'slider_pause' => '500', 
		'slider_minSlides' => '1',
		'slider_maxSlides' => '1',
		'slider_slideWidth' => '0'
	);
	
	foreach($slider_defaults as $option => $value) {
		update_metadata('slideshows', $term_id, $option, $value);
	}
}

add_action( 'create_slideshows', 'jbfj_create_slider_metadata', 10, 2 );