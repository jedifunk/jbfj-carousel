<?php
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'slide',
	'order' => 'ASC'
));
 
if($posts) {
	echo '<ul class="carousel">';
		
	foreach($posts as $post) {
		$url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
		$caption = get_post(get_post_thumbnail_id($post->ID)) -> post_excerpt;

		echo '<li>';
		if ($caption) {
			echo '<span class="slider-caption">'. $caption .'</span>';
		}
		$slide_url = get_post_meta($post->ID, 'slide_url', true);
		if ($slide_url !="" ) {
			echo '<a href="'. $slide_url .'"><img src="'. $url[0] .'" /></a></li>';
		} else {
			echo '<img src="'. $url[0] .'" /></li>';
		}
	};

	echo '</ul>';
}