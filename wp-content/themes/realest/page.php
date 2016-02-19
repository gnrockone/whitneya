<?php get_header(); ?>
	<main class="main container">
	<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		<div class="page-container">
			<div class="thepage-content">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; endif; ?>
	</main>
<?php get_footer(); ?>