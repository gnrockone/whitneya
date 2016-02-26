<?php get_header(); ?>
	<?php $category = get_queried_object();
	$value = $category->name; ?>
	<section class="category-label-container">
		<h1 id="category-label" class="text-center">Category > <span class="label-value"><?php echo $value; ?></span></h1>
	</section>
	<div class="container blogs-container">
		<?php get_sidebar('sidebar');
		$args = array(
			'cat' => $category->cat_ID,
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 5
		);
		$query = new WP_Query($args);
		if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post();
			get_template_part('theloop'); ?>
			<?php endwhile; ?>
		<?php else: ?>
				<h1>No results</h1>
		<?php endif;  ?>
		<?php wp_reset_query(); ?>
		<?php rl_category_pagination(); ?>
		</div><!--end of blog-main, can be seen in sidebar.php-->
	</div>
<?php get_footer(); ?>