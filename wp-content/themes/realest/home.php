<?php get_header(); ?>
	<div class="container blogs-container">
		<?php if( is_active_sidebar( 'sidebar1' )):  ?>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 blog-sidebar sidebar-padding">
			<?php dynamic_sidebar( 'sidebar1' ); ?>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 blog-main">
		<?php else: ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog-main">
		<?php endif; ?>
		<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
				<?php get_template_part('theloop'); ?>
			<?php endwhile; ?>
		<?php else: ?>
				<h1>wala</h1>
		<?php endif;  ?>
			</div>
	</div>
<?php get_footer(); ?>