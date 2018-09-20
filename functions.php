<?php 
/**
 * readmore ajax loaded
 */
add_action("wp_ajax_readmore_posts", "readmore_posts");
add_action("wp_ajax_nopriv_readmore_posts", "readmore_posts");

function readmore_posts() {
	ob_start();
	$page = $_POST['page'];
    $category = $_POST['category'];
    $post_type = $_POST['post_type'];
	$args = array(
		'paged' => $page,
		'post_type' => $post_type,
		'post_status' => 'publish',
		'posts_per_page' => 12,
		'order' => 'DESC'
	);
	if(!empty($category)) {
		$args['category_name'] = $category;
	}

	$custom_posts = new WP_Query($args);

	if($custom_posts->found_posts) {
		foreach($custom_posts->posts as $custom_post){
			?>
			<div class="item_1_3">
			<?php
			echo '<a href="'.get_permalink($custom_post->ID).'">';
			echo get_the_post_thumbnail($custom_post->ID);
			echo '<h2>'.get_the_title($custom_post->ID).'</h2>';
			echo '</a>';
			echo get_the_excerpt($custom_post->ID);
			?>
			</div>
			<?php
		}
	}
	echo ob_get_clean();
	die();
}