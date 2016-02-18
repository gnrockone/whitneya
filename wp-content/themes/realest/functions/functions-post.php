<?php
//enqueue jquery-ui-tabs
//register and enqueue jquery ui css
//put this in custom js when document is ready:
	//jQuery( "#custom-post-tabs" ).tabs();

//call this function to get latest,recomended,popular post
//call this anywhere
function get_posts_tabs() { ?>
	<div id="custom-post-tabs">
	<ul class="tab-links">
	    <li><a href="#recommended-posts">Recommended Posts</a></li>
	    <li><a href="#popular-posts">Popular Posts</a></li>
	    <li><a href="#latest-posts">Latest Posts</a></li>
	    <?php 
	    get_recommended_posts();
	    get_popular_posts();
	    get_latest_posts();
	    ?>
  	</ul>
	</div>
<?php } ?>

<?php 
function get_latest_posts() {
	$args = array(
    'numberposts' => 15,
    'offset' => 0,
    'category' => 0,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true 
    );
    $latest_posts = wp_get_recent_posts( $args, OBJECT ); ?>
	<ul id="latest-posts" class="post-results">
		<?php foreach( $latest_posts as $latest_post ): ?>
			<li id="post-result-<?php echo $latest_post->ID; ?>" class="post-result">
				<a href="<?php echo the_permalink( $latest_post->ID );?>" id="post-title-<?php echo $latest_post->ID; ?>">
					<?php echo $latest_post->post_title; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php } ?>
<?php
function get_popular_posts() {
	//param1: number of post to get
	$popular_posts = kk_star_ratings_get(10); ?>
	<ul id="popular-posts" class="post-results">
		<?php foreach( $popular_posts as $popular_post ): ?> 
			<li id="post-result-<?php echo $popular_post->ID; ?>" class="post-result">
				<a href="<?php echo the_permalink( $popular_post->ID ); ?>" id="post-title-<?php echo $popular_post->ID; ?>">
					<?php echo $popular_post->post_title; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php } ?>
<?php 
function get_recommended_posts() { ?>
	<?php
	$recommended_posts = new WP_Query( get_recommended_posts_arguments() ); ?>
	
	<ul id="recommended-posts" class="post-results">
	<?php 
	if( $recommended_posts->have_posts() ): 
		while( $recommended_posts->have_posts() ): $recommended_posts->the_post(); ?>
			<li id="post-result-<?php echo the_ID(); ?>" class="post-result">
				<a href="<?php echo the_permalink(); ?>" id="post-title-<?php echo the_ID(); ?>">
					<?php echo the_title(); ?>
				</a>
			</li>
		<?php endwhile;
	else: 
		echo 'no recommended post';
	endif;
	wp_reset_query(); ?>
	</ul>
<?php } ?>

<?php
function get_recommended_posts_arguments() { ?>
	<?php $tags = get_terms('post_tag');
	if( $tags && is_single() ):
		//if single and tags gets arguments for related tags
			$tag__in = array();
			foreach( $tags as $tag):
				$tag__in[] = $tag->term_id;
			endforeach;
			$args = array(
				'tag__in' => $tag__in,
				'post__not_in' => array( get_queried_object()->ID ),
				'posts_per_page' => 4,
				//'caller_get_posts'=> 1
			);
	//if no tag count or if not single or not tag count & not single
	else:
		$args = get_recommended_posts_default_arguments();
		echo 'NO TAGS AVAILABLE';
	endif; 
	return $args; ?>
<?php } ?>

<?php
function get_recommended_posts_default_arguments() {
	$args = array(
		'orderby' => 'rand',
		'posts_per_page' => 4
	);
	
	return $args;
} 

/**
 * [set_post_views - adds a meta key in meta data for every post, counts
 * the views of every post]
 * @param  [type] $postID [post ID of single post]
 * @return [type]         [description]
 */
function set_post_views($postID) {
    $count_key = 'set_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


?>



