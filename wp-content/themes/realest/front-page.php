<?php get_header(); ?>
	<div class="container blogs-container">
		<?php get_sidebar('sidebar'); ?>
		<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
				<article class="blog-container">
					<h2 class="thepost-title"><a href="<?php echo esc_attr( the_permalink() ); ?>"><?php the_title(); ?></a></h2>
					<div class="thepost-meta">
						<span class="thepost-date"><?php the_time('l, F j, Y'); ?> / </span>
						<span class="glyphicon glyphicon-comment thepost-comments"><<?php comments_number('0', '1', '%' );?> /</span>
						<span class="glyphicon glyphicon-cloud thepost-categories"><?php the_category(", "); ?> /</span>
						<span class="glyphicon glyphicon-tags thepost-tags"><?php the_tags(); ?> /</span>
						<span class="glyphicon glyphicon-heart-empty thepost-like">0</span>
					</div>
					<div class="thepost-content"><?php the_content(); ?></div>
					<div class="thepost-socialmedias">
						<div class="row text-center">
							<?php if(get_option('facebook_url')): ?>
								<a class="socialmedias-anchor" href="<?php echo get_option('facebook_url'); ?>"><span class="socialmedias fa fa-facebook"></span></a>
							<?php endif; ?>
							<?php if(get_option('twitter_url')): ?>
								<a class="socialmedias-anchor" href="<?php echo get_option('twitter_url'); ?>"><span class="socialmedias fa fa-twitter"></span></a>
							<?php endif; ?>
							<?php if(get_option('linkedin_url')): ?>
								<a class="socialmedias-anchor" href="<?php echo get_option('linkedin_url'); ?>"><span class="socialmedias fa fa-linkedin"></span></a>
							<?php endif; ?>
							<?php if(get_option('instagram_url')): ?>
								<a class="socialmedias-anchor" href="<?php echo get_option('instagram_url'); ?>"><span class="socialmedias fa fa-instagram"></span></a>
							<?php endif; ?>
						</div>
					</div>
				</article>

			<?php endwhile; ?>
		<?php else: ?>
				<h1>No results</h1>
		<?php endif;  ?>
			</div><!---end of blog-main-->
	</div><!--end of blogs-container-->
<?php get_footer(); ?>