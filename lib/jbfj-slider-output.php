<div class="jbfj-carousel" id="<?php echo $slideshow; ?>">
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
			$post_id = get_the_ID();
			$post_meta = get_post_meta( $post_id );
			if ($post_meta["slide_url"][0]) {
				echo '<a href="'. $post_meta["slide_url"][0] .'">';
					the_post_thumbnail( 'full' );
				echo '</a>';
			} else {
				the_post_thumbnail( 'full' );
			}
			
			$caption_content = get_the_content();
			$caption_content = apply_filters( 'the_content', $caption_content );
			
			if( !empty($caption_content) ) {
				echo '<div class="jbfj-carousel-caption">'.$caption_content.'</div>';
			}
			
		echo '</div>';
	endwhile; wp_reset_postdata();
?>
</div>
