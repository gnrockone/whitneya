<?php
add_action('widgets_init', function() {
	register_widget( 'about_whitney' );
	register_widget( 'social_medias' );
	register_widget( 'search_whitney');
	register_widget( 'whitney_newsletter_signup');
	register_widget( 'whitney_top_posts');
});

/**
 * about whitney widget block
 */
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
     	echo '<h5>' .$instance['title'].'</h5>';
     	echo get_the_post_thumbnail( $instance['page'],null,array('class' => 'img-responsive center-block') );
		echo $args['after_widget'];
	}
}

/**
 * widgetblock : social medias
 * 
 */
class social_medias extends WP_Widget {
	/**
	 * @param1 base id
	 * @param2 name - will be displayed in widget dashboard
	 * @param3 optional - optional array
	 */
	function __construct() {
		parent::__construct(
			'social_medias_unique_id',
			'Social Medias',
			array(
				'description' => 'Social Medias',
				'classname'   => 'social_medias_class'
			)
		);
	}

	public function form($instance) {
		extract($instance);
		$facebook  = isset($facebook) ? $instance['facebook'] : "";
		$twitter   = isset($twitter) ? $instance['twitter'] : "";
		$linkedin  = isset($linkedin) ? $instance['linkedin'] : "";
		$instagram = isset($instagram) ? $instance['instagram'] : "";
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title') ?>">Title</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>">
		</p>
		<?php if (get_option('facebook_url')): ?>
		<p>
			<label for="<?php echo $this->get_field_id('facebook') ?>">Facebook</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="checkbox" value="<?php echo get_option('facebook_url'); ?>" <?php checked(get_option('facebook_url'),$facebook); ?>>
		</p>
		<?php endif; ?>
		<?php if (get_option('twitter_url')): ?>
		<p>
			<label for="<?php echo $this->get_field_id('twitter') ?>">Twitter</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="checkbox" value="<?php echo get_option('twitter_url'); ?>" <?php checked(get_option('twitter_url'),$twitter); ?>>
		</p>
		<?php endif; ?>
		<?php if (get_option('linkedin_url')): ?>
		<p>
			<label for="<?php echo $this->get_field_id('linkedin') ?>">Linkedin</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="checkbox" value="<?php echo get_option('linkedin_url'); ?>" <?php checked(get_option('linkedin_url'),$linkedin); ?>>
		</p>
		<?php endif; ?>
		<?php if (get_option('instagram_url')): ?>
		<p>
			<label for="<?php echo $this->get_field_id('instagram') ?>">Instagram</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="checkbox" value="<?php echo get_option('instagram_url'); ?>" <?php checked(get_option('instagram_url'),$instagram); ?>>
		</p>
		<?php endif; ?>
		
	<?php }

	public function update($new_instance,$old_instance) {
		$instance = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title']);
		$instance['facebook']  = $new_instance['facebook'];
		$instance['twitter']   = $new_instance['twitter'];
		$instance['linkedin']  = $new_instance['linkedin'];
		$instance['instagram'] = $new_instance['instagram'];
		return $instance;
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
			extract($instance); ?>
			<?php $html = '<div class="row text-center socialmedias-sidebar">'; 
			$html .= ($facebook) ? '<a class="socialmedias-sidebar-anchor" href="'.$facebook .'"><span class="fa fa-facebook"></span></a>': ''; 
			$html .= ($twitter) ? '<a class="socialmedias-sidebar-anchor" href="'.$twitter .'"><span class="fa fa-twitter"></span></a>': ''; 
			$html .= ($linkedin) ? '<a class="socialmedias-sidebar-anchor" href="'.$linkedin .'"><span class="fa fa-linkedin"></span></a>': '';
			$html .= ($instagram) ? '<a class="socialmedias-sidebar-anchor" href="'.$instagram .'"><span class="fa fa-instagram"></span></a>': '';
			$html .= '</div>';
			echo $html; ?>
		<?php echo $args['after_widget'];
	}
	public function add_social_media() {

	}
}

class search_whitney extends WP_Widget {
	function __construct() {
		parent::__construct(
			'unique_search_whitney',
			'Search Whitney',
			array(
				'description' => 'Search Whitney Blog',
				'classname'   => 'search_whitney_class'
			)
		);
	}
	public function form($instance) {
		extract($instance);
		$title = isset($title) ? $instance['title'] : "";
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title') ?>">Search Title</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
		</p>
	<?php }
	public function update($new_instance,$old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	public function widget($args,$instance) {
		echo $args['before_widget'];
		?>
		<div class="inner-addon right-addon">
			<form role="form" method="POST" action="search.php">
			    <i class="glyphicon glyphicon-search"></i>
			    <input type="text" class="form-control" placeholder="search" />
			</form>
		</div>
		<?php
		echo $args['after_widget'];
	}
}

class whitney_newsletter_signup extends WP_Widget {
	function __construct() {
		parent::__construct(
			'newsletter_signup',
			'Whitney Signup',
			array(
				'description' => 'Newsletter Signup',
				'classname'   => 'newsletter_signup_class'
			)
		);
	}
	public function form($instance) {
		extract($instance);
		$title = isset($title) ? $instance['title'] : "";
	 ?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
	</p>
	<?php }
	
	public function update($new_instance,$old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	public function widget($args,$instance) {
		echo $args['before_widget'];
			?>	
				<h5><?php echo $instance['title']; ?></h5>
				<button class="btn center-block btn-black" data-toggle="modal" data-target="#myModal">Sign Me Up</button>
	
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				  	<div class="box-padding">
						<div class="modal-content">
						  <div class="modal-header">
						    <button type="button" class="close" data-dismiss="modal">&times;</button>
						    <h4 class="modal-title">LET'S HANG
Stay connected with me and sign up for my newsletter!</h4>
						  </div>
						  <div class="modal-body">
						  	<form role="form" method="POST" action="">
						  		<div class="form-group">
							  		<label class="nl-labels" for="nl_name">Name</label>
							  		<input type="text" name="nl_name" class="form-control">
							  	</div>
							  	<div class="form-group">
							  		<label class="nl-labels"for="nl_eadd">Email: *</label>
							  		<input required type="email" name="nl_eadd" class="form-control">
							  	</div>
						  		<button type="submit" class="btn btn-black">Sign me up</button>
						  	</form>
						  </div>
						  <!-- <div class="modal-footer">
						    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  </div> -->
						</div>
				  	</div>
				    <!-- Modal content-->
				  </div>
				</div>
			<?php
		echo $args['after_widget'];
	}
}

class whitney_top_posts extends WP_Widget {
	function __construct() {
		parent::__construct(
			'whitney_top_posts_id',
			'Whiney Top Posts',
			array(
				'description' => 'Whitney top posts',
				'classname' => 'whitney_top_posts_class'
				)
			);
	}
	public function form($instance) {
		extract($instance);
		$title = isset($instance['title']) ? $instance['title'] : "";
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title Label</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>"></input>
		</p>
	<?php }
	public function update($new_instance,$old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	public function widget($args,$instance) {
		extract($args);
		echo $before_widget; ?>
			<?php
			$queried = query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC');
			wp_reset_query();
			print_r($queried);
			?>
		<?php echo $after_widget;
	}
}


?>