<?php

// Add fields to Create Page
add_action('slideshows_add_form_fields', 'jbfj_add_slider', 10, 2);

function jbfj_add_slider() {
	
	$slider_mode = get_metadata('slideshows', $tag->term_id, 'slider_mode', true);
    
    
    $slider_speed = get_metadata('slideshows', $tag->term_id, 'slider_speed', true);
    if (!$slider_speed) {
        $slider_speed = '500';
	}
	
    $slider_pause = get_metadata('slideshows', $tag->term_id, 'slider_pause', true);
	if (!$slider_pause) {
        $slider_pause = '4000';
    }
    
    $slider_useCSS = get_metadata('slideshows', $tag->term_id, 'slider_useCSS', true);
	if (!$slider_useCSS) {
        $slider_useCSS = '0';
    }
    
    $slider_pager = get_metadata('slideshows', $tag->term_id, 'slider_pager', true);
	if (!$slider_pager) {
        $slider_pager = '0';
    }
    
    $slider_controls = get_metadata('slideshows', $tag->term_id, 'slider_controls', true);
	if (!$slider_controls) {
        $slider_controls = '0';
    }
    
    $slider_hover = get_metadata('slideshows', $tag->term_id, 'slider_hover', true);
	if (!$slider_hover) {
        $slider_hover = '0';
    }
    
    $slider_ticker = get_metadata('slideshows', $tag->term_id, 'slider_ticker', true);
	if (!$slider_ticker) {
        $slider_ticker = '0';
    }
    
    $slider_tHover = get_metadata('slideshows', $tag->term_id, 'slider_tHover', true);
	if (!$slider_tHover) {
        $slider_tHover = '0';
    } 
	
?>
	<div class="form-field">
		<label for="slider_mode"><?php _e( 'Effects Mode', 'jbfj' ); ?></label>
		<select name="slider_mode" id="slider_mode">
			<option value="fade" <?php selected( $slider_mode, 'fade' ); ?>>Fade</option>
			<option value="horizontal" <?php selected( $slider_mode, 'horizontal' ); ?>>Horizontal</option>
			<option value="vertical" <?php selected( $slider_mode, 'vertical' ); ?>>Vertical</option>
		</select>
	</div>
	
	<div class="form-field">
		<label for="slider_speed"><?php _e( 'Transition Speed', 'jbfj' ); ?></label>
		<input type="text" id="slider_speed" name="slider_speed" size="20" value="<?php echo $slider_speed ?>" />
	</div>
	
	<div class="form-field">
		<label for="slider_pause"><?php _e( 'Display Time', 'jbfj' ); ?></label>
		<input type="text" id="slider_pause" name="slider_pause" size="20" value="<?php echo $slider_pause; ?>" />
	</div>
	
	<div class="form-field">
		<label for="slider_useCSS"><?php _e( 'Use CSS Transitions', 'jbfj' ); ?></label>
		<input type="checkbox" id="slider_useCSS" name="slider_useCSS" value="0" <?php checked( $slider_useCSS, 1 ); ?>/>
	</div>
	
	<div class="form-field">
		<label for="slider_pager"><?php _e( 'Display Pager', 'jbfj' ); ?></label>
		<input type="checkbox" id="slider_pager" name="slider_pager" value="0" <?php checked( 1, $slider_pager ); ?>/>
	</div>
	
	<div class="form-field">
		<label for="slider_controls"><?php _e( 'Display Prev/Next Controls', 'jbfj' ); ?></label>
		<input type="checkbox" id="slider_controls" name="slider_controls" value="0" <?php checked( 1, $slider_controls ); ?>/>
	</div>
	
	<div class="form-field">
		<label for="slider_hover"><?php _e( 'Pause on Hover', 'jbfj' ); ?></label>
		<input type="checkbox" id="slider_hover" name="slider_hover" value="0" <?php checked( 1, $slider_hover ); ?>/>
	</div>
	
	<div class="form-field">
		<label for="slider_ticker"><?php _e( 'Use as Ticker', 'jbfj' ); ?></label>
		<input type="checkbox" id="slider_ticker" name="slider_ticker" value="0" <?php checked( 1, $slider_ticker ); ?>/>
	</div>
	
	<div class="form-field">
		<label for="slider_tHover"><?php _e( 'Pause Ticker on Hover', 'jbfj' ); ?></label>
		<input type="checkbox" id="slider_tHover" name="slider_tHover" value="0" <?php checked( 1, $slider_tHover ); ?>/>
	</div>
<?php }

// Add fields to Edit Page
add_action( 'slideshows_edit_form_fields', 'jbfj_edit_slider_settings', 10, 2);

function jbfj_edit_slider_settings($tag, $taxonomy) {

    $slider_mode = get_metadata('slideshows', $tag->term_id, 'slider_mode', true);
    
    
    $slider_speed = get_metadata('slideshows', $tag->term_id, 'slider_speed', true);
    if (!$slider_speed) {
        $slider_speed = '500';
	}
	
    $slider_pause = get_metadata('slideshows', $tag->term_id, 'slider_pause', true);
	if (!$slider_pause) {
        $slider_pause = '4000';
    }
    
    $slider_useCSS = get_metadata('slideshows', $tag->term_id, 'slider_useCSS', true);
	if (!$slider_useCSS) {
        $slider_useCSS = 'false';
    }
    
    $slider_pager = get_metadata('slideshows', $tag->term_id, 'slider_pager', true);
	if (!$slider_pager) {
        $slider_pager = '0';
    }
    
    $slider_controls = get_metadata('slideshows', $tag->term_id, 'slider_controls', true);
	if (!$slider_controls) {
        $slider_controls = '0';
    }
    
    $slider_hover = get_metadata('slideshows', $tag->term_id, 'slider_hover', true);
	if (!$slider_hover) {
        $slider_hover = '0';
    }
    
    $slider_ticker = get_metadata('slideshows', $tag->term_id, 'slider_ticker', true);
	if (!$slider_ticker) {
        $slider_ticker = '0';
    }
    
    $slider_tHover = get_metadata('slideshows', $tag->term_id, 'slider_tHover', true);
	if (!$slider_tHover) {
        $slider_tHover = '0';
    } 

?>	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_mode"><?php _e( 'Effects Mode', 'jbfj' ); ?></label></th>
		<td>
			<select name="slider_mode" id="slider_mode">
				<option value="fade" <?php selected( $slider_mode, 'fade' ); ?>>Fade</option>
				<option value="horizontal" <?php selected( $slider_mode, 'horizontal' ); ?>>Horizontal</option>
				<option value="vertical" <?php selected( $slider_mode, 'vertical' ); ?>>Vertical</option>
			</select>
		</td>
	</tr>
    <tr class="form-field">
		<th scope="row" valign="top"><label for="slider_speed"><?php _e( 'Transition Speed', 'jbfj' ); ?></label></th>
		<td>
			<input type="text" id="slider_speed" name="slider_speed" size="20" value="<?php echo $slider_speed ?>" />
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_pause"><?php _e( 'Display Time', 'jbfj' ); ?></label></th>
		<td>
			<input type="text" id="slider_pause" name="slider_pause" size="20" value="<?php echo $slider_pause; ?>" />
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_useCSS"><?php _e( 'Use CSS Transitions', 'jbfj' ); ?></label></th>
		<td>
			<input type="checkbox" id="slider_useCSS" name="slider_useCSS" value="0" <?php checked( $slider_useCSS, 1 ); ?>/>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_pager"><?php _e( 'Display Pager', 'jbfj' ); ?></label></th>
		<td>
			<input type="checkbox" id="slider_pager" name="slider_pager" value="0" <?php checked( 1, $slider_pager ); ?>/>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_controls"><?php _e( 'Display Prev/Next Controls', 'jbfj' ); ?></label></th>
		<td>
			<input type="checkbox" id="slider_controls" name="slider_controls" value="0" <?php checked( 1, $slider_controls ); ?>/>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_hover"><?php _e( 'Pause on Hover', 'jbfj' ); ?></label></th>
		<td>
			<input type="checkbox" id="slider_hover" name="slider_hover" value="0" <?php checked( 1, $slider_hover ); ?>/>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_ticker"><?php _e( 'Use as Ticker', 'jbfj' ); ?></label></th>
		<td>
			<input type="checkbox" id="slider_ticker" name="slider_ticker" value="0" <?php checked( 1, $slider_ticker ); ?>/>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="slider_tHover"><?php _e( 'Pause Ticker on Hover', 'jbfj' ); ?></label></th>
		<td>
			<input type="checkbox" id="slider_tHover" name="slider_tHover" value="0" <?php checked( 1, $slider_tHover ); ?>/>
		</td>
	</tr>
	
<?php }

// Save Fields
add_action( 'edited_slideshows', 'jbfj_save_slider_settings', 10, 2);
add_action( 'create_slideshows', 'jbfj_save_slider_settings', 10, 2 );

function jbfj_save_slider_settings( $term_id, $tt_id ) {

    if (!$term_id) return;
    
    if (isset($_POST['slider_mode'])) {
        update_metadata('slideshows', $term_id, 'slider_mode', $_POST['slider_mode']);
    }
    
    if (isset($_POST['slider_speed'])) {
    	update_metadata('slideshows', $term_id, 'slider_speed', $_POST['slider_speed']);  
    }

    if (isset($_POST['slider_pause'])) {
	    update_metadata('slideshows', $term_id, 'slider_pause', $_POST['slider_pause']);
    }
    
    if (isset($_POST['slider_useCSS'])) {
        update_metadata('slideshows', $term_id, 'slider_useCSS', true);
    } else {
	    update_metadata('slideshows', $term_id, 'slider_useCSS', false);
    }

	if (isset($_POST['slider_pager'])) {
		update_metadata('slideshows', $term_id, 'slider_pager', true);
	} else {
	    update_metadata('slideshows', $term_id, 'slider_pager', false);
    }
        
	if (isset($_POST['slider_controls'])) {
		update_metadata('slideshows', $term_id, 'slider_controls', true);
	} else {
	    update_metadata('slideshows', $term_id, 'slider_controls', false);
    }

	if (isset($_POST['slider_hover'])) {
		update_metadata('slideshows', $term_id, 'slider_hover', true);
	} else {
	    update_metadata('slideshows', $term_id, 'slider_hover', false);
    }

	if (isset($_POST['slider_ticker'])) {
		update_metadata('slideshows', $term_id, 'slider_ticker', true);
	} else {
	    update_metadata('slideshows', $term_id, 'slider_ticker', false);
    }
	
	if (isset($_POST['slider_tHover'])) {
		update_metadata('slideshows', $term_id, 'slider_tHover', true);
	} else {
	    update_metadata('slideshows', $term_id, 'slider_tHover', false);
    }
        
}
