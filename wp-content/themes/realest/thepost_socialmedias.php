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