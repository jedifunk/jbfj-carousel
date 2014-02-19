<div class="carousel" id="<?php echo $slideshow; ?>">
<?php 
	$args = array( 
		'post_type' => 'slide', 
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'slideshows',
				'field' => 'slug',
				'terms' => $slideshow
			),
		)
	);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		echo '<div class="item">';
			the_post_thumbnail( 'full' );
			echo '<div class="carousel-caption">';
				echo the_content();
			echo '</div>';
		echo '</div>';
	endwhile;
?>
</div>
