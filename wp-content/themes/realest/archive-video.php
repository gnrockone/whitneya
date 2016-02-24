<?php get_header(); ?>
	<?php 
		$args = array(
			//Type & Status Parameters
			'post_type'   => 'video',
			'post_status' => 'publish',
			//Order & Orderby Parameters
			'order'               => 'DESC',
			'orderby'             => 'date',
			//Pagination Parameters
			'posts_per_page'         => 10,
			'posts_per_archive_page' => 10,
			'paged'                  => get_query_var('paged'),
		);
	$querys = new WP_Query( $args );
	$posts = $querys->posts;
	 ?>
	<div class="container video-container clearfix">
		<div class="row">
		<?php get_template_part('searchform_videos'); ?>
		</div>
		<div class="row iframe-row">
			<div id="iframe-container" class="embed-responsive embed-responsive-16by9">
				
			</div>
		</div>
		<div class="row">
			<div id="video-carousel" class="slides video-slides">
			<?php $count= 0; ?>
		<?php foreach($posts as $post): ?>
			    <div class="video-slide item">
			    	<?php $videoid = explode("=", $post->post_content); ?>
			    	<a class="video-anchor" href="#" ahref ="<?php echo $videoid[1]; ?>">
			    	<?php echo "<img src='http://img.youtube.com/vi/" . $videoid[1] . "/mqdefault.jpg'>"; ?>
			    	</a>
			    	<h4 class="video-title"><?php echo $post->post_title; ?></h4>
			    </div>
			    <?php $count++; ?>
		<?php endforeach; ?>
				<input id="video-count" type="disabled" style="display:none" value="<?php echo $count; ?>">
			</div>
		</div>
	</div><!--.container.video-container-->
<script type="text/javascript">
(function($){
	var custom = {};

	custom.carousel = function(elementId,countId) {
		var carouselId = "#" + elementId;
		var countId = "#" + countId;
		var count = $(countId).attr("val");
		$(carouselId).owlCarousel({
			autoPlay: 3000,
			items: count,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3]
		});
	}
	custom.appendDefault = function(videoId) {
		custom.removeEmbed();
		href = (videoId) ? videoId : $('.video-slide.item a').attr('ahref');
		//var href = $('.video-slide.item a').attr('ahref');
		var appendItem = '<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/' + href + '"></iframe>';
		$('.embed-responsive').append(appendItem);
	}
	custom.removeEmbed = function() {
		$('.embed-responsive').empty();
	}



jQuery(document).ready(function( $ ) {
	custom.carousel('video-carousel','video-count');
	custom.appendDefault();

	$('.video-anchor').on('click',function(e){
		e.preventDefault();
		var videoId = $(this).attr('ahref');
		custom.appendDefault(videoId);
	});
});

jQuery(document).load(function($) {

});

})(jQuery);

	
	
</script>
<?php get_footer(); ?>