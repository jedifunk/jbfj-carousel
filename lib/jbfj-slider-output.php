<?php
global $post;

$gps_temp = $post;
$loop = new WP_Query( array(
	'post_type' => 'slide',
	'slideshow' => $slideshow,
	'posts_per_page' => -1,
	'order' => 'ASC'
));
 
if( $loop->have_posts() ) : ?>
	<ul id="gpsslider-<?php echo $slideshow; ?>" class="carousel <?php echo $slideshow; ?>">
	
	<?php while ( $loop->have_posts() ) : $loop->the_post(); 
		$caption = get_post(get_post_thumbnail_id($post->ID)) -> post_excerpt;
	?>

		<li>
		<?php if ($caption) { ?>
			<span class="slider-caption"><?php echo $caption; ?></span>
		<?php } 
		$slide_url = get_post_meta($post->ID, 'slide_url', true);
		if ($slide_url !="" ) { ?>
			<a href="<?php echo $slide_url; ?>"><?php the_post_thumbnail('full'); ?></a></li>
		<?php } else {
			the_post_thumbnail('full');
		} ?>
		</li>
	<?php endwhile; ?>

	</ul>

<?php 
	$post = $gps_temp;
	wp_reset_postdata();
	endif;
