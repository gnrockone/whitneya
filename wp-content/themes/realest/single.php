<?php get_header(); ?>
	<?php //set_post_views( get_the_ID() );?>
	<div class="container blogs-container">
		<?php get_template_part('sidebar'); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part('theloop'); ?>
		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
		<?php $args = array(
			'class' => 'row row-single-pagination clearfix',
			'leftclass' => 'left-single-pagination single-pagination pull-left',
			'rightclass' => 'right-single-pagination single-pagination pull-right'
		); ?>
		<?php rl_single_pagination($args); ?>
		<?php comments_template(); ?>
		</div><!--end of main-container located in sidebar.php-->
		
	</div>
<?php get_footer(); ?>