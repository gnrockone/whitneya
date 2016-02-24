<?php get_header(); ?>
	<?php 
		$args = array(
			//Type & Status Parameters
			'post_type'   => 'article',
			'post_status' => 'publish',
			//Order & Orderby Parameters
			'order'               => 'DESC',
			'orderby'             => 'date',
			//Pagination Parameters
			'posts_per_page'         => 10,
			'posts_per_archive_page' => 10,
			'paged'                  => get_query_var('paged'),
		);
		$querys = new WP_Query( $args );
		$posts = $querys->posts;
		//print_r($posts);
		?>
		<div class="container writing-container clearfix">
			
				<?php foreach($posts as $post): ?>
					<article id="<?php echo $post->ID; ?>" class="">
						<h5><strong><i><?php echo $post->post_title; ?></i></strong> by <?php echo the_author_meta('user_nicename', $post->post_author); ?></h5>
						<div class="thepost-content">
							<?php echo $post->post_content; ?>
						</div>
					</article>
				<?php endforeach; ?>
			
		</div><!--.writing-container-->
<?php get_footer(); ?>