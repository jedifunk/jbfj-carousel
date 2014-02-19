/* Script for JBFJ Slider */

// Set jQuery into no conflict
var $j = jQuery.noConflict();

$j(document).ready(function() {

	var settings;

	jQuery.each( jbfjslidersettings, function( key, value ) { 
		settings = key;

		// Get slider options
			var $slider_mode = this.jbfjslidermode;
			var $slider_speed = parseInt( this.jbfjsliderspeed );
			var $slider_pause = parseInt( this.jbfjsliderpause );
			var $slider_useCSS = this.jbfjslideruseCSS;
			var $slider_pager = this.jbfjsliderpager;
			var $slider_controls = this.jbfjslidercontrols;
			var $slider_hover = this.jbfjsliderhover;
			var $slider_ticker = this.jbfjsliderticker;
			var $slider_tHover = this.jbfjslidertHover;
			
			//Setup Slider
			//onsole.log( $j("#" + settings).children("div").length);
			if ( $j( "#" + settings).children("div").length > 1 ) {
				$j("#" + settings).bxSlider({
					auto: true,
					mode: $slider_mode,
					speed: $slider_speed,
					pause: $slider_pause,
					useCSS: $slider_useCSS,
					pager: $slider_pager,
					controls: $slider_controls,
					autoHover: $slider_hover,
					ticker: $slider_ticker,
					tickerHover: $slider_tHover,
				});
			}
	});

});