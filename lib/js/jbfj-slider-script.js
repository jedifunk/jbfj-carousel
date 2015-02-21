/* Script for JBFJ Slider */

// Set jQuery into no conflict
var $j = jQuery.noConflict();

$j(document).ready(function() {

	jQuery.each( jbfjslidersettings, function( key, value ) {
		sliderDiv = $j("#" + key);

		//Setup Slider
		if ( sliderDiv.children("div").length > 1 ) {
			sliderDiv.bxSlider({
				auto: true,
				mode: this.jbfjslidermode,
				speed: parseInt( this.jbfjsliderspeed, 10 ),
				pause: parseInt( this.jbfjsliderpause, 10 ),
				useCSS: this.jbfjslideruseCSS,
				pager: this.jbfjsliderpager,
				controls: this.jbfjslidercontrols,
				autoHover: this.jbfjsliderhover,
				ticker: this.jbfjsliderticker,
				tickerHover: this.jbfjslidertHover,
				minSlides: this.jbfjsliderminSlides,
				maxSlides: this.jbfjslidermaxSlides,
				slideWidth: this.jbfjsliderslideWidth
			});
		}
	});

});