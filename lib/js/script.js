/* Script for JBFJ Slider */

// Set jQuery into no conflict
var $j = jQuery.noConflict();

$j(document).ready(function() {
	
	// Get slider options
	var $slidermode = jbfjslidersettings.jbfjslidermode;
	var $sliderspeed = parseInt( jbfjslidersettings.jbfjsliderspeed );
	var $sliderpause = parseInt( jbfjslidersettings.jbfjsliderpause );
	var $slideruseCSS = jbfjslidersettings.jbfjslideruseCSS;
	var $sliderpager = jbfjslidersettings.jbfjsliderpager;
	var $slidercontrols = jbfjslidersettings.jbfjslidercontrols;
	var $sliderhover = jbfjslidersettings.jbfjsliderhover;
	var $sliderticker = jbfjslidersettings.jbfjsliderticker;
	var $slidertHover = jbfjslidersettings.jbfjslidertHover;
	
	//Setup Slider
	$j('.carousel').bxSlider({
		auto: true,
		mode: $slidermode,
		speed: $sliderspeed,
		pause: $sliderpause,
		useCSS: $slideruseCSS,
		pager: $sliderpager,
		controls: $slidercontrols,
		autoHover: $sliderhover,
		ticker: $sliderticker,
		tickerHover: $slidertHover,
	});
});