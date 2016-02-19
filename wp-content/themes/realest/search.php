<?php get_header(); ?>
	<?php $value = isset($_GET['s']) ? $_GET['s'] : "";
	 $args = array(
		's' => $value,
		'post_type' => 'post',
		'post_status' => 'publish',
		'suppress_filters' => TRUE
	);
	 global $wpdb;
	 $query = "SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%" .$value. "%'";
	 $results = $wpdb->get_results($query);
	 print_r($results); 
	 ?>
	<section class="search-label-container">
		<h1 id="search-label" class="text-center">Search for > <?php echo $value; ?></h1>
	</section>
	<div class="container blogs-container">
		<?php get_sidebar('sidebar'); ?>
	</div><!--end of blogs-container-->
<?php get_footer(); ?>