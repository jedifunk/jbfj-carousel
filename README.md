#JBFJ Slider

By Bryce Flory, Chad Sanda and Cameron Huntington.

Fully responsive Wordpress content slider plugin.

This plugin uses the great bxslider.js jQuery plugin by Steven Wanderski.
View the plugin on GitHub at https://github.com/wandoledzep/bxslider-4

*Version 1.7.3*


##Feature Ideas

- Add Video embeds
- Add HTML content
- Custom pager location
- Replace control images with custom icon font options

##Documentation

### Use

#####Shortcode

	[slider slug=yourSlug]

#####Template Tag
Add this to your page template file. Takes one arguement, slider slug name

	<?php jbfj_slider( 'yourSlugName' ); ?>

###Inputs

#####Slide Width
Accepts integers and translates them to pixel values e.g. 200 -> 200px. If set to 0 (default), slides will be 100% width of their container.

#####Radios
If a radio option is not selected, that property will not save to the database, and will return as null (false).


##Change Log

*1.7.3: October 14, 2014*

- Bug fix: Error on new slideshow ... calling invalid arguement that didnt exist. Removed.
- Bug fix: Error on deleting slideshow

*1.7.2: October 10, 2014*

- Fix bug where new sliders create on slide page didn't add settings metadata to database
- Moved Create and Edit forms into separate file for better readability
- Updated Read Me to include template tag documentation

*1.7.1: October 7, 2014*

- Added delete functionality
- Defaults stored in an array
- Radios replaced check boxes to be always present in the $_POST variable
- Slider settings are now submitted as components of the associative array [slideshow_settings]
- Add/update now loops over $_POST variable

*1.7: October 7, 2014*

 - Added Ticker functionality
 - Added new options for use with Ticker and Carousel: minSlides, maxSlides and slideWidth
 - Refactored and reduced database calls in jbfj-slider.php
 - Removed redundancies in jbfj-slider-script.js
 - Refactored checkboxes to output as boolean values instead of integers
 - Renamed container div class to jbfj-carousel to not conflict with Bootstrap naming conventions
 - Removed redundancies for the update_metadata calls in jbfj-slider-settings.php
 - Updated BxSlider to latest version, 4.1.2

*1.6.6: September 10, 2014*

 - Added apply_filters to the caption area so it will execute shortcodes

*1.6.5: August 26, 2014*

 - Hooked up slide url so that when it is added on the custom post type it actually puts a link on the front page

*1.6.4: June 3, 2014*

 - Removed unnecessary definition for plugin_dir_path
 - Added if statement to caption div to not output if no content
 - Bug Fix: added wp_reset_postdata() to output to properly close loop

*1.6.3: March 17, 2014*

 - Fixed issue with multiple sliders not working in multisite

*1.6.2: February 25, 2014*

 - Added shortcode functionality [slider slug=yourSlug]

*1.6.1: February 25, 2014*

 - Changed carousel-caption class to jbfj-carousel-caption

*1.6: February 20, 2014*

 - Added Multisite compatibility

*1.5.2: February 5, 2014*

 - Fixed JS to handle slider with only one slide.

*1.5.1: February 5, 2014*

 - Moved to enqueuing scripts and styles only when slider function is called.  Prevents assets from loading on pages without a slider.
 - Changed slider JS filename to be more descriptive.

*1.5: January 20, 2014*

 - Slider settings are no longer global. Each slider has its own settings

*1.3.1: December 13, 2013*

 - Fixed broken file paths to reflect new directory structure

*1.3: May 8, 2013*

 - Added support for multiple sliders using custom taxonomy

*1.2: May 7, 2013*

 - Added Custom URLs
 
*1.1: May 3, 2013*

 - Added Captioning
 
*1.0: May 1, 2013*

 - Initial Release
 Added support for multiple sliders using custom taxonomy

*1.2: May 7, 2013*

 - Added Custom URLs
 
*1.1: May 3, 2013*

 - Added Captioning
 
*1.0: May 1, 2013*

 - Initial Release
