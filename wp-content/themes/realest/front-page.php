<?php get_header(); ?>
	<div class="container blogs-container">
		<?php get_sidebar('sidebar'); ?>
		<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
			<?php get_template_part('theloop'); ?>
			<?php endwhile; ?>
		<?php else: ?>
				<h1>No results</h1>
		<?php endif;  ?>
			</div><!---end of blog-main, can be seen in sidebar.php-->
	</div><!--end of blogs-container-->
<?php get_footer(); ?>