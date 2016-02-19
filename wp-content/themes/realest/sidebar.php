<?php if( is_active_sidebar( 'sidebar1' )):  ?>
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 blog-sidebar sidebar-padding">
	<?php dynamic_sidebar( 'sidebar1' ); ?>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 blog-main">
<?php else: ?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog-main">
<?php endif; ?>