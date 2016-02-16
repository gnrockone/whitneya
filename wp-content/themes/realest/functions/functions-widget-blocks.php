<?php
add_action('widgets_init', function() {
	register_widget( 'about_whitney' );
});
class about_whitney extends WP_Widget {
	function __construct() {
		/**
		 * @param1 base id
		 * @param2 name - will be displayed in widget dashboard
		 * @param3 optional - optional array
		 */
		parent::__construct(
			'about_whitney_unique_id', //base id
			__('About Whitney'),
			array( 
				'description' => 'Who am I',
				'classname'   => 'about_whitney_class' )
			);
	}
	/**
	 * back end widget form
	 * @param   $instance [Previously saved values from database]
	 * @return [type]           [description]
	 */
	public function form( $instance ) {
		extract($instance);
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title Label</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>"></input>
		</p>
		<p>
			<?php $args = array(
				'sort_order' => 'asc',
				'sort_column' => 'post_title',
				'hierarchical' => 1,
				'post_type' => 'page',
				'post_status' => 'publish' );
				$pages = get_pages( $args );
			?>
			<label for="<?php echo $this->get_field_id( 'page'); ?>">Page Label</label>
			<select id="<?php echo $this->get_field_id( 'page'); ?>" class="widefat" name="<?php echo $this->get_field_name( 'page' ); ?>"><?php _e('Select Page'); ?>
				<?php print_r($pages); ?>
				<?php foreach( $pages as $page): ?>
					<option value="<?php echo $page->ID; ?>" <?php echo ($page->ID == $instance['page']) ? 'selected': ''; ?>><?php echo $page->post_title; ?>
					</option>
				<?php endforeach; ?>
			</select>			
		</p>

	<?php }

	/**
	 * processes the widget options on save. This function update your widget
	 * @param  [type] $new_instance [values just sent to be saved. These values will be coming]
	 * @param  [type] $old_instance [Previously saved values from the database]
	 * @return [type]               [description]
	 */
	public function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance['title'] );
		$instance[ 'page']   = strip_tags( $new_instance['page'] );
		return $instance;
	}

	/**
	 * front end dispplay
	 * @param  [type] $args     [description]
	 * @param  [type] $instance [description]
	 * @return [type]           [description]
	 */
	public function widget( $args, $instance ) {
	
     	echo $args['before_widget'];
     	echo get_the_post_thumbnail( $instance['page'],null,array('class' => 'img-responsive') );
		echo $args['after_widget'];
	}
}
?>