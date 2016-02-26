<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
<div class="container">
	<div class="row error404">
		<div class="col-md-7 col-lg-7">
			<h1 class="error404-heading text-center">404</h1>
		</div>
		<div class="col-md-5 col-lg-5">
			<h1 class="error404-sorry">Sorry!</h1>
			<h2 class="error404-pnf">Page not found</h2>
			<h4>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</h4>
			<p>Please try using our search box below to look for information on the internet.</p>
			<?php get_template_part('searchform_videos'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
