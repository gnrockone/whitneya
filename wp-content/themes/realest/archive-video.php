<?php get_header(); ?>
	<?php 
		$args = array(
			//Type & Status Parameters
			'post_type'   => 'video',
			'post_status' => 'publish',
			//Order & Orderby Parameters
			'order'               => 'DESC',
			'orderby'             => 'date',
			//Pagination Parameters
			'posts_per_page'         => 10,
			'posts_per_archive_page' => 10,
			'paged'                  => get_query_var('paged'),
		);
	$query = new WP_Query( $args );
	print_r($query->posts);
	 ?>
	<div class="container video-container">
		<?php get_template_part('searchform_videos'); ?>
	</div><!--.container.video-container-->
	
<?php get_footer(); ?>