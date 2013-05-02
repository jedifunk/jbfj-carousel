<?php

function jbfj_slider_settings_page() {
	
	// check for sufficient admin permissions
	if ( !current_user_can('manage_options') ) {
		wp_die(__('You do not have sufficient permissions to access this page') );
	}
	
	//variables for the fields & options
	
?>

<div class="wrap">
	<?php screen_icon('options-general'); ?><h2>JBFJ Slider Settings</h2>
	<?php settings_errors(); ?>
	
	<form method="post" action="options.php">
		<?php 
			settings_fields('jbfj_slider_options');
			do_settings_sections('jbfj_slider_admin'); 
		
			submit_button(); 
		?>
	</form>
</div>

<?php }

// Set Defaults
function jbfj_slider_default_options() {
	
	$defaults = array(
		'slider_mode'	=>	'fade',
		'slider_speed'	=>	'500',
		'slider_pause'		=>	'4000',
		'slider_useCSS'		=>	false,
		'slider_pager'		=>	false,
		'slider_controls'	=>	false,
		'slider_hover'	=>	false,
		'slider_ticker'		=>	false,
		'slider_tHover'		=>	false
	);
	
	return apply_filters( 'jbfj_slider_default_options', $defaults );
	
}

function jbfj_slider_admin_init() {

	if( false == get_option( 'jbfj_slider_options' ) ) {	
		add_option( 'jbfj_slider_options', apply_filters( 'jbfj_slider_default_options', jbfj_slider_default_options() ) );
	}
	// Main Slider settings
	add_settings_section('jbfj_slider_main', 'Slider Settings', 'main_section_callback', 'jbfj_slider_admin');
	add_settings_field(
		'slider_mode',
		'Effect Mode:',
		'slider_mode_callback',
		'jbfj_slider_admin',
		'jbfj_slider_main'
	);
	add_settings_field(
		'slider_speed',
		'Transisiton Speed:',
		'slider_speed_callback',
		'jbfj_slider_admin',
		'jbfj_slider_main'
	);
	add_settings_field(
		'slider_pause',
		'Display Time:',
		'slider_pause_callback',
		'jbfj_slider_admin',
		'jbfj_slider_main'
	);
	add_settings_field(
		'slider_useCSS',
		'Use CSS3 Transitions:',
		'slider_useCSS_callback',
		'jbfj_slider_admin',
		'jbfj_slider_main'
	);
	add_settings_field(
		'slider_pager',
		'Display Pager:',
		'slider_pager_callback',
		'jbfj_slider_admin',
		'jbfj_slider_main'
	);
	add_settings_field(
		'slider_controls',
		'Display Prev/Next Controls:',
		'slider_controls_callback',
		'jbfj_slider_admin',
		'jbfj_slider_main'
	);
	add_settings_field(
		'slider_hover',
		'Pause on Hover:',
		'slider_hover_callback',
		'jbfj_slider_admin',
		'jbfj_slider_main'
	);
	
	// Ticker Settings
	add_settings_section('jbfj_slider_ticker', 'Ticker', 'ticker_section_callback', 'jbfj_slider_admin');
	add_settings_field(
		'slider_ticker',
		'Ticker Mode:',
		'slider_ticker_callback',
		'jbfj_slider_admin',
		'jbfj_slider_ticker'
	);
	add_settings_field(
		'slider_tHover',
		'Pause Ticker on Hover:',
		'slider_tHover_callback',
		'jbfj_slider_admin',
		'jbfj_slider_ticker'
	);
	
	register_setting('jbfj_slider_options', 'jbfj_slider_options', 'jbfj_slider_validate');
}

// Section description callbacks
function main_section_callback() {
	echo '<p>All slider settings here</p>';
}
function ticker_section_callback() {
	echo '<p>Settings for using slider as news ticker</p>';
}

/************** Individual field callbacks *****************/
// Effect Mode
function slider_mode_callback() {
	$options = get_option('jbfj_slider_options');
	$html = '<select id="slider_mode" name="jbfj_slider_options[slider_mode]">';
		$html .= '<option value="fade">' . __( 'Fade' ) . '</option>';
		$html .= '<option value="horizontal"' . selected( $options['slider_mode'], 'horizontal', false) . '>' . __( 'Horizontal') . '</option>';
		$html .= '<option value="vertical"' . selected( $options['slider_mode'], 'vertical', false) . '>' . __( 'Vertical') . '</option>';
	
	echo $html;
}

// Transition Speed
function slider_speed_callback() {
	$options = get_option('jbfj_slider_options');
	echo '<input type="text" id="slider_speed" name="jbfj_slider_options[slider_speed]" size="20" value="' . $options['slider_speed'] . '" />';
}

// Display Time
function slider_pause_callback() {
	$options = get_option('jbfj_slider_options');
	echo '<input type="text" id="slider_pause" name="jbfj_slider_options[slider_pause]" size="20" value="' . $options['slider_pause'] . '" />';
}

// Use CSS3 Transitions
function slider_useCSS_callback() {
	$options = get_option('jbfj_slider_options');
	$html = '<input type="checkbox" id="slider_useCSS" name="jbfj_slider_options[slider_useCSS]" value="1"' . checked( 1, $options['slider_useCSS'], false ) . '/>';	
	echo $html;
}

// Display pager
function slider_pager_callback() {
	$options = get_option('jbfj_slider_options');
	$html = '<input type="checkbox" id="slider_pager" name="jbfj_slider_options[slider_pager]" value="1"' . checked( 1, $options['slider_pager'], false ) . '/>';
	echo $html;
}

// Display prev/next controls
function slider_controls_callback() {
	$options = get_option('jbfj_slider_options');
	$html = '<input type="checkbox" id="slider_controls" name="jbfj_slider_options[slider_controls]" value="1"' . checked( 1, $options['slider_controls'], false ) . '/>';
	echo $html;
}

// Pause on Hover
function slider_hover_callback() {
	$options = get_option('jbfj_slider_options');
	$html = '<input type="checkbox" id="slider_hover" name="jbfj_slider_options[slider_hover]" value="1"' . checked( 1, $options['slider_hover'], false ) . '/>';
	echo $html;
}

// Slider as ticker
function slider_ticker_callback() {
	$options = get_option('jbfj_slider_options');
	$html = '<input type="checkbox" id="slider_ticker" name="jbfj_slider_options[slider_ticker]" value="1"' . checked( 1, $options['slider_ticker'], false ) . '/>';
	echo $html;
}

// Pause ticker on hover
function slider_tHover_callback() {
	$options = get_option('jbfj_slider_options');
	$html = '<input type="checkbox" id="slider_tHover" name="jbfj_slider_options[slider_tHover]" value="1"' . checked( 1, $options['slider_tHover'], false ) . '/>';
	echo $html;
}

function jbfj_slider_validate( $input ) {
	// Create our array for storing the validated options
	$output = array();
	
	// Loop through each of the incoming options
	foreach( $input as $key => $value ) {
		
		// Check to see if the current option has a value. If so, process it.
		if( isset( $input[$key] ) ) {
		
			// Strip all HTML and PHP tags and properly handle quoted strings
			$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
		}		
	}
	$defaults = array(
		'slider_mode'	=>	'fade',
		'slider_speed'	=>	'500',
		'slider_pause'		=>	'4000',
		'slider_useCSS'		=>	false,
		'slider_pager'		=>	false,
		'slider_controls'	=>	false,
		'slider_hover'	=>	false,
		'slider_ticker'		=>	false,
		'slider_tHover'		=>	false
	);
	
	foreach( $defaults as $key => $value ) {
		
		// Check to see if the current option has a value. If so, process it.
		if( !isset( $input[$key] ) ) {

			// Strip all HTML and PHP tags and properly handle quoted strings
			$output[$key] = $value;
		}		
	}

	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'jbfj_slider_validate', $output, $input );
}