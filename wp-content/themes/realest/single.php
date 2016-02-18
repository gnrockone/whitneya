<?php get_header(); ?>
	<?php  set_post_views( get_the_ID() );?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php endwhile; else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
	<h1>Hello im single.php</h1>
<?php get_footer(); ?>