<?php get_header(); ?>
	<?php $value = isset($_GET['s']) ? $_GET['s'] : "";
	 $args = array(
		's' => $value,
		'post_type' => 'post',
		'post_status' => 'publish',
		'suppress_filters' => TRUE
	);
	 $search = new WP_Query($args);
	 ?>
	<section class="search-label-container">
		<h1 id="search-label" class="text-center">Search for > <?php echo $value; ?></h1>
	</section>
	<div class="container blogs-container">
		<?php get_sidebar('sidebar'); ?>
		<?php if ( $search->have_posts() ) : ?>
		<!-- pagination here -->
			<!-- the loop -->
			<?php while ( $search->have_posts() ) : $search->the_post(); ?>
				<?php get_template_part('theloop'); ?>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		<?php else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
		
		</div><!--.blog-main-->
	</div><!--end of blogs-container-->
<?php get_footer(); ?>