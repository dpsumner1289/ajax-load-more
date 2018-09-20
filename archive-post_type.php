<?php
// stuff
// the query
$query = new WP_Query( $args );

// the loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		?>
		<div class="item_1_3">
		<?php
		$query->the_post();
		echo '<a href="'.get_permalink().'">';
		the_post_thumbnail( 'full' );		
		the_title( '<h2>', '</h2>', true );
		echo '</a>';
		the_excerpt();
		?>
		</div>
		<?php
	}
	
	if($query->max_num_pages > 1) {
		?>
			<script>
				jQuery(document).ready(function($){
					var moreposts = '<a name="moreposts" class="moreposts">Load More</a>';
					$('#main').append(moreposts);
				});
			</script>
		<?php
	}
} else {
	// no posts found
}

// restore original post data
wp_reset_postdata();

?>
		</main><!-- #main -->
	</div><!-- #primary -->
<script>
	jQuery(document).ready(function($){
		var page = 2;
		$(document).on('click', 'a.moreposts', function(e){
			e.preventDefault();
			var data = {
				action : 'readmore_posts',
				page : page
			}
			$.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response){
                $('#main').append(response);
				$('.moreposts').remove().appendTo('#main');
            });
			page++;
		});
	});
</script>