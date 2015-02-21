<?php
// Add new Slider Form
function jbfj_add_slider() {

	// Setting a default values for user guidance purposes
	$slider_defaults = array(
		'speed' => '4000',
		'pause' => '500', 
		'minSlides' => '1',
		'maxSlides' => '1',
		'slideWidth' => '0'
	);

?>
	<div class="form-field">
		<label for="slider_mode"><?php _e( 'Effects Mode', 'jbfj' ); ?></label>
		<select name="slider_settings[slider_mode]" id="slider_mode">
			<option value="fade" <?php selected( $slider_mode, 'fade' ); ?>>Fade</option>
			<option value="horizontal" <?php selected( $slider_mode, 'horizontal' ); ?>>Horizontal</option>
			<option value="vertical" <?php selected( $slider_mode, 'vertical' ); ?>>Vertical</option>
		</select>
	</div>
	
	<div class="form-field">
		<label for="slider_speed"><?php _e( 'Transition Speed', 'jbfj' ); ?></label>
		<input type="text" id="slider_speed" name="slider_settings[slider_speed]" size="20" value="<?php echo $slider_defaults['speed'] ?>" />
	</div>
	
	<div class="form-field">
		<label for="slider_pause"><?php _e( 'Display Time', 'jbfj' ); ?></label>
		<input type="text" id="slider_pause" name="slider_settings[slider_pause]" size="20" value="<?php echo $slider_defaults['pause']; ?>" />
	</div>
	
	<div class="form-field">
		<label for="slider_useCSS"><?php _e( 'Use CSS Transitions', 'jbfj' ); ?></label>
		Yes <input type="radio" id="slider_useCSS" name="slider_settings[slider_useCSS]" value="1" />
		No <input type="radio" id="slider_useCSS" name="slider_settings[slider_useCSS]" value="0" />
	</div>
	
	<div class="form-field">
		<label for="slider_pager"><?php _e( 'Display Pager', 'jbfj' ); ?></label>
		Yes <input type="radio" id="slider_pager" name="slider_settings[slider_pager]" value="1" />
		No <input type="radio" id="slider_pager" name="slider_settings[slider_pager]" value="0" />
	</div>
	
	<div class="form-field">
		<label for="slider_controls"><?php _e( 'Display Prev/Next Controls', 'jbfj' ); ?></label>
		Yes <input type="radio" id="slider_controls" name="slider_settings[slider_controls]" value="1" />
		No <input type="radio" id="slider_controls" name="slider_settings[slider_controls]" value="0" />
	</div>
	
	<div class="form-field">
		<label for="slider_hover"><?php _e( 'Pause on Hover', 'jbfj' ); ?></label>
		Yes <input type="radio" id="slider_hover" name="slider_settings[slider_hover]" value="1" />
		No <input type="radio" id="slider_hover" name="slider_settings[slider_hover]" value="0" />
	</div>
	
	<div class="form-field">
		<label for="slider_ticker"><?php _e( 'Use as Ticker', 'jbfj' ); ?></label>
		Yes <input type="radio" id="slider_ticker" name="slider_settings[slider_ticker]" value="1" />
		No <input type="radio" id="slider_ticker" name="slider_settings[slider_ticker]" value="0" />
	</div>
	
	<div class="form-field">
		<label for="slider_tHover"><?php _e( 'Pause Ticker on Hover', 'jbfj' ); ?></label>
		Yes <input type="radio" id="slider_tHover" name="slider_settings[slider_tHover]" value="1" />
		No <input type="radio" id="slider_tHover" name="slider_settings[slider_tHover]" value="0" />
	</div>
	
	<div class="form-field">
		<label for="slider_minSlides"><?php _e( 'Min Slides', 'jbfj' ); ?></label>
		<input type="text" id="slider_minSlides" name="slider_settings[slider_minSlides]" size="20" value="<?php echo $slider_defaults['minSlides']; ?>" />
	</div>
	
	<div class="form-field">
		<label for="slider_maxSlides"><?php _e( 'Max Slides', 'jbfj' ); ?></label>
		<input type="text" id="slider_maxSlides" name="slider_settings[slider_maxSlides]" size="20" value="<?php echo $slider_defaults['maxSlides']; ?>" />
	</div>
	
	<div class="form-field">
		<label for="slider_slideWidth"><?php _e( 'Slide Width', 'jbfj' ); ?></label>
		<input type="text" id="slider_slideWidth" name="slider_settings[slider_slideWidth]" size="20" value="<?php echo $slider_defaults['slideWidth']; ?>" />
	</div>
<?php }
// Add fields to Create Page
add_action('slideshows_add_form_fields', 'jbfj_add_slider', 10, 2);

// Add fields to Edit Page
function jbfj_edit_slider_settings($tag, $taxonomy) {

	// Get currently saved settings from the database
    $cur = get_metadata('slideshows', $tag->term_id);

?>	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_mode"><?php _e( 'Effects Mode', 'jbfj' ); ?></label></th>
		<td>
			<select name="slider_settings[slider_mode]" id="slider_mode">
				<option value="fade" <?php selected( $cur['slider_mode'][0], 'fade' ); ?>>Fade</option>
				<option value="horizontal" <?php selected( $cur['slider_mode'][0], 'horizontal' ); ?>>Horizontal</option>
				<option value="vertical" <?php selected( $cur['slider_mode'][0], 'vertical' ); ?>>Vertical</option>
			</select>
		</td>
	</tr>
    <tr class="form-field">
		<th scope="row" valign="top"><label for="slider_speed"><?php _e( 'Transition Speed', 'jbfj' ); ?></label></th>
		<td>
			<input type="text" id="slider_speed" name="slider_settings[slider_speed]" size="20" value="<?php echo $cur['slider_speed'][0] ?>" />
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_pause"><?php _e( 'Display Time', 'jbfj' ); ?></label></th>
		<td>
			<input type="text" id="slider_pause" name="slider_settings[slider_pause]" size="20" value="<?php echo $cur['slider_pause'][0]; ?>" />
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_useCSS"><?php _e( 'Use CSS Transitions', 'jbfj' ); ?></label></th>
		<td>
			Yes <input type="radio" id="slider_useCSS" name="slider_settings[slider_useCSS]" value="1" <?php checked( 1, $cur['slider_useCSS'][0] ); ?>/>
			No <input type="radio" id="slider_useCSS" name="slider_settings[slider_useCSS]" value="0" <?php checked( 0, $cur['slider_useCSS'][0] ); ?>/>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_pager"><?php _e( 'Display Pager', 'jbfj' ); ?></label></th>
		<td>
			Yes <input type="radio" id="slider_pager" name="slider_settings[slider_pager]" value="1" <?php checked( 1, $cur['slider_pager'][0] ); ?>/>
			No <input type="radio" id="slider_pager" name="slider_settings[slider_pager]" value="0" <?php checked( 0, $cur['slider_pager'][0] ); ?>/>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_controls"><?php _e( 'Display Prev/Next Controls', 'jbfj' ); ?></label></th>
		<td>
			Yes <input type="radio" id="slider_controls" name="slider_settings[slider_controls]" value="1" <?php checked( 1, $cur['slider_controls'][0] ); ?>/>
			No <input type="radio" id="slider_controls" name="slider_settings[slider_controls]" value="0" <?php checked( 0, $cur['slider_controls'][0] ); ?>/>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_hover"><?php _e( 'Pause on Hover', 'jbfj' ); ?></label></th>
		<td>
			Yes <input type="radio" id="slider_hover" name="slider_settings[slider_hover]" value="1" <?php checked( 1, $cur['slider_hover'][0] ); ?>/>
			No <input type="radio" id="slider_hover" name="slider_settings[slider_hover]" value="0" <?php checked( 0, $cur['slider_hover'][0] ); ?>/>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_ticker"><?php _e( 'Use as Ticker', 'jbfj' ); ?></label></th>
		<td>
			Yes <input type="radio" id="slider_ticker" name="slider_settings[slider_ticker]" value="1" <?php checked( 1, $cur['slider_ticker'][0] ); ?>/>
			No <input type="radio" id="slider_ticker" name="slider_settings[slider_ticker]" value="0" <?php checked( 0, $cur['slider_ticker'][0] ); ?>/>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_tHover"><?php _e( 'Pause Ticker on Hover', 'jbfj' ); ?></label></th>
		<td>
			Yes <input type="radio" id="slider_tHover" name="slider_settings[slider_tHover]" value="1" <?php checked( 1, $cur['slider_tHover'][0] ); ?>/>
			No <input type="radio" id="slider_tHover" name="slider_settings[slider_tHover]" value="0" <?php checked( 0, $cur['slider_tHover'][0] ); ?>/>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_minSlides"><?php _e( 'Min Slides', 'jbfj' ); ?></label></th>
		<td>
			<input type="text" id="slider_minSlides" name="slider_settings[slider_minSlides]" size="20" value="<?php echo $cur['slider_minSlides'][0]; ?>" />
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_maxSlides"><?php _e( 'Max Slides', 'jbfj' ); ?></label></th>
		<td>
			<input type="text" id="slider_maxSlides" name="slider_settings[slider_maxSlides]" size="20" value="<?php echo $cur['slider_maxSlides'][0]; ?>" />
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_slideWidth"><?php _e( 'Slide Width', 'jbfj' ); ?></label></th>
		<td>
			<input type="text" id="slider_slideWidth" name="slider_settings[slider_slideWidth]" size="20" value="<?php echo $cur['slider_slideWidth'][0]; ?>" />
		</td>
	</tr>
	
<?php }

// Add fields to Edit Page
add_action( 'slideshows_edit_form_fields', 'jbfj_edit_slider_settings', 10, 2);