<?php
/*
Template Name: WordPress HTML Export
*/
?>


<?php

// Define newline

	$newline = "\r\n";
	$separator = "==================================================";

// Export speakers
// Change category_name to the current year’s category

	$s_args = array( 'post_type' => 'speakers', 'category_name' => 'typecon2019', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'wpcf-speaker-sort' );
	$loop = new WP_Query( $s_args );
	if ( $loop -> have_posts() ) {
		while ( $loop -> have_posts() ) : $loop -> the_post();
			$id = get_the_id();
			$title = wp_strip_all_tags( get_the_title(), false );
			$content = wp_strip_all_tags( get_the_content(), false );
			$twitter = get_post_meta($id, 'wpcf-speaker-twitter', true);
			$instagram = get_post_meta($id, 'wpcf-speaker-instagram', true);
			$insert_twitter = "";
			$insert_instagram = "";
			if ($twitter != '') {
				$insert_twitter = "Twitter: " . $twitter . $newline;
				}
			if ($instagram != '') {
				$insert_instagram = "Instagram: " . $instagram . $newline;
				}
			$twitter = get_post_meta($id, 'wpcf-speaker-twitter', true);
			$instagram = get_post_meta($id, 'wpcf-speaker-instagram', true);
			echo $title . $newline . $insert_twitter . $insert_instagram . $content . $newline . $newline;
		endwhile;
		}

// Export pages
// Specify the post ID of each page in the post__in array
//
//  86 = Program
//  26 = Education Forum
// 179 = Workshops
// 201 = Special Events

	$p_args = new WP_Query( array( 'post_type' => 'page', 'post__in' => array( 26, 86, 179, 201 ) ) );
	while ( $p_args -> have_posts() ) : $p_args -> the_post();
		$title = wp_strip_all_tags( get_the_title(), false );
		$content = wp_strip_all_tags( get_the_content(), false );
		echo $newline . $separator . $newline . $newline . $newline;
		echo $title . $newline . $newline . $content . $newline . $newline;
	endwhile;

?>
