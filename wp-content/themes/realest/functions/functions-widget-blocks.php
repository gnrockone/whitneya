<?php
add_action('widgets_init', function() {
	register_widget( 'about_whitney' );
	register_widget( 'social_medias' );
	register_widget( 'search_whitney');
	register_widget( 'whitney_newsletter_signup');
	register_widget( 'whitney_top_posts');
	register_widget( 'Artbees_Widget_Social');
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
			extract($instance); 
			$html = '<div class="row text-center socialmedias-sidebar">'; 
			$html .= ($facebook) ? '<a class="socialmedias-sidebar-anchor" href="http://'.$facebook .'"><span class="fa fa-facebook"></span></a>': ''; 
			$html .= ($twitter) ? '<a class="socialmedias-sidebar-anchor" href="http://'.$twitter .'"><span class="fa fa-twitter"></span></a>': ''; 
			$html .= ($linkedin) ? '<a class="socialmedias-sidebar-anchor" href="http://'.$linkedin .'"><span class="fa fa-linkedin"></span></a>': '';
			$html .= ($instagram) ? '<a class="socialmedias-sidebar-anchor" href="http://'.$instagram .'"><span class="fa fa-instagram"></span></a>': '';
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
			<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="navbar-form form-inline">
			    <input type="search" id="" class="form-control" placeholder="Search Blog" 
			    	value="<?php echo get_search_query() ?>" name="s" title="Search" />
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






/*
	SOCIAL NETWORKS ICON
*/
class Artbees_Widget_Social extends WP_Widget {

	var $sites = array(
			'px',
            'aim',
            'amazon',
            'apple',
            'bebo',
            'behance',
            'blogger', 
            'delicious', 
            'deviantart', 
            'digg', 
            'dribbble', 
            'dropbox', 
            'envato', 
            'facebook', 
            'flickr', 
            'github', 
            'google', 
            'googleplus', 
            'lastfm', 
            'linkedin',
            'instagram', 
            'myspace', 
            'path', 
            'pinterest', 
            'reddit', 
            'rss', 
            'skype', 
            'stumbleupon', 
            'tumblr', 
            'twitter', 
            'vimeo', 
            'wordpress', 
            'yahoo', 
            'yelp', 
            'youtube',
            'xing',
            'imdb',
            'qzone',
            'renren',
            'vk',
            'wechat',
            'weibo',
            'whatsapp',
            'soundcloud',


	);
	var $size = array(

		'large' => array(
			'name'=>'Large',
			'path'=>'large',
		),

		'medium' => array(
			'name'=>'Medium',
			'path'=>'medium',
		),

		'small' => array(
			'name'=>'Small',
			'path'=>'small',
		),

	);

	var $align = array(

		'left' => array(
			'name'=>'Left',
			'path'=>'left',
		),

		'center' => array(
			'name'=>'Center',
			'path'=>'center',
		),

		'right' => array(
			'name'=>'Right',
			'path'=>'right',
		),

	);


	function Artbees_Widget_Social() {
		$widget_ops = array( 'classname' => 'widget_social_networks', 'description' => 'Displays a list of Social Icon icons' );
		$this->WP_Widget( 'social', THEME_SLUG.' - '.'Social Networks', $widget_ops );

	}


	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$alt = isset( $instance['alt'] )?$instance['alt']:'';
		$size = $instance['size'];
		$style = isset($instance['style']) ? $instance['style'] : 'simple';
		$skin = $instance['skin'];
		$align = isset($instance['align']) ? $instance['align'] : 'left'; 
		$icon_color = isset($instance['icon_color']) ? $instance['icon_color'] : '';
		$icon_hover_color = isset($instance['icon_hover_color']) ? $instance['icon_hover_color'] : '';
		$icon_border_color = isset($instance['icon_border_color']) ? $instance['icon_border_color'] : '';
		$icon_bg_main_color = isset($instance['icon_bg_main_color']) ? $instance['icon_bg_main_color'] : '';
		$icon_bg_color = isset($instance['icon_bg_color']) ? $instance['icon_bg_color'] : '';
		$icons_margin = isset($instance['icons_margin']) ? $instance['icons_margin'] : '';
		$custom_count = isset($instance['custom_count']) ? $instance['custom_count'] : '';
		$icon_style_css = '';
		$uniqueID = 'social-'.uniqid();

		switch($style) {
        	case 'rounded' :
            $icon_style = 'fa fa-';
            break;
            case 'simple' :
            $icon_style = 'fa fa-';
            break;
            case 'simple-circle' :
            $icon_style = 'fa fa-';
            $icon_style_css = 'mk-circle-frame ';
            break;
            case 'circle' :
            $icon_style = 'fa fa-';
            break;
            case 'square-pointed' :
            $icon_style = 'fa fa-';
            $icon_style_css = 'mk-square-pointed ';
            break;
            case 'square-rounded' :
            $icon_style = 'fa fa-';
            $icon_style_css = 'mk-square-rounded ';
            break;
            default : 
            $icon_style = 'fa fa-';
        }

		$output ='';

		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {
				$path = $this->size[$size]['path'];
				$link = isset( $instance[strtolower( $site )] )?$instance[strtolower( $site )]:'#';
					$output .= '<a href="'.$link.'" rel="nofollow" class="builtin-icons '.$icon_style_css.$skin.' '.$path.' '.$site.'-hover" target="_blank" alt="'.$alt.' '.$site.'" title="'.$alt.' '.$site.'"><i class="'.$icon_style.$site.'"></i></a>';
	
			}
			if($skin == 'custom' || !empty($icons_margin) ) {
				if ( !empty($icon_color) || !empty($icon_hover_color) || !empty($icon_bg_color) || !empty($icon_bg_main_color) || !empty($icon_border_color) || !empty($icons_margin) ) {
					$output .= '
					<style>
						#'.$uniqueID.' a { 
							opacity: 100 !important;';
					if ( !empty($icons_margin) ) {
						$output .= '
						margin: '.$icons_margin.'px;';
					}
					if ( !empty($icon_color) ) { 
						$output .= 'color: '.$icon_color.' !important;';
					}
					if ( !empty($icon_border_color) ) { 
						$output .= 'border-color: '.$icon_border_color.' !important;';
					}
					if ( !empty($icon_bg_main_color) && ($style == 'square-pointed' || $style == 'square-rounded' || $style == 'simple-circle')) { 
						$output .= 'background-color: '.$icon_bg_main_color.' !important;';
					}
					$output .= '}';
					$output .= '
						#'.$uniqueID.' a:hover { ';
					if ( !empty($icon_hover_color) ) { 
						$output .= 'color: '.$icon_hover_color.' !important;';
					}
					if ( !empty($icon_bg_color) && ($style == 'square-pointed' || $style == 'square-rounded' || $style == 'simple-circle')) { 
						$output .= 'border-color: '.$icon_bg_color.' !important;';
						$output .= 'background-color: '.$icon_bg_color.' !important;';
					}
					$output .= '}
					</style>';
				}
			} 
		}
		if ( $custom_count > 0 ) {
			for ( $i=1; $i<= $custom_count; $i++ ) {
				$name = isset( $instance['custom_'.$i.'_name'] )?$instance['custom_'.$i.'_name']:'';
				$icon = isset( $instance['custom_'.$i.'_icon'] )?$instance['custom_'.$i.'_icon']:'';
				$link = isset( $instance['custom_'.$i.'_url'] )?$instance['custom_'.$i.'_url']:'#';
				if ( !empty( $icon ) ) {
					$output .= '<a href="'.$link.'" rel="nofollow" target="_blank"><img src="'.$icon.'" alt="'.$alt.' '.$name.'" title="'.$alt.' '.$name.'"/></a>';
				}
			}
		}



		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
				echo '<div id="'.$uniqueID.'" class="align-'.$align.'">';
				echo $output;
				echo '</div>';
				echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['alt'] = strip_tags( $new_instance['alt'] );
		$instance['size'] = $new_instance['size'];
		$instance['align'] = $new_instance['align'];
		$instance['skin'] = $new_instance['skin'];
		$instance['icon_color'] = $new_instance['icon_color'];
		$instance['icon_hover_color'] = $new_instance['icon_hover_color'];
		$instance['icon_border_color'] = $new_instance['icon_border_color'];
		$instance['icon_bg_main_color'] = $new_instance['icon_bg_main_color'];
		$instance['icon_bg_color'] = $new_instance['icon_bg_color'];
		$instance['icons_margin'] = $new_instance['icons_margin'];
		$instance['style'] = $new_instance['style'];
		$instance['enable_sites'] = $new_instance['enable_sites'];
		$instance['custom_count'] = (int) $new_instance['custom_count'];
		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {
				$instance[strtolower( $site )] = isset( $new_instance[strtolower( $site )] )?strip_tags( $new_instance[strtolower( $site )] ):'';
			}
		}
		for ( $i=1;$i<=$instance['custom_count'];$i++ ) {
			$instance['custom_'.$i.'_name'] = strip_tags( $new_instance['custom_'.$i.'_name'] );
			$instance['custom_'.$i.'_url'] = strip_tags( $new_instance['custom_'.$i.'_url'] );
			$instance['custom_'.$i.'_icon'] = strip_tags( $new_instance['custom_'.$i.'_icon'] );
		}
		return $instance;
	}

	function form( $instance ) {

		
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$alt = isset( $instance['alt'] ) ? esc_attr( $instance['alt'] ) : 'Follow Us on';
		$size = isset( $instance['size'] ) ? $instance['size'] : 'medium';
		$align = isset( $instance['align'] ) ? $instance['align'] : 'left';
		$skin = isset( $instance['skin'] ) ? $instance['skin'] : 'dark';
		$icon_color = isset( $instance['icon_color'] ) ? $instance['icon_color'] : '';
		$icon_hover_color = isset( $instance['icon_hover_color'] ) ? $instance['icon_hover_color'] : '';
		$icon_border_color = isset( $instance['icon_border_color'] ) ? $instance['icon_border_color'] : '';
		$icon_bg_main_color = isset( $instance['icon_bg_main_color'] ) ? $instance['icon_bg_main_color'] : '';
		$icon_bg_color = isset( $instance['icon_bg_color'] ) ? $instance['icon_bg_color'] : '';
		$icons_margin = isset( $instance['icons_margin'] ) ? $instance['icons_margin'] : '';
		$style = isset( $instance['style'] ) ? $instance['style'] : 'circle';
		$enable_sites = isset( $instance['enable_sites'] ) ? $instance['enable_sites'] : array();
		foreach ( $this->sites as $site ) {
			$$site = isset( $instance[strtolower( $site )] ) ? esc_attr( $instance[strtolower( $site )] ) : '';
		}
		$custom_count = isset( $instance['custom_count'] ) ? absint( $instance['custom_count'] ) : 0;
		for ( $i=1;$i<=10;$i++ ) {
			$custom_name = 'custom_'.$i.'_name';
			$$custom_name = isset( $instance[$custom_name] ) ? $instance[$custom_name] : '';
			$custom_url = 'custom_'.$i.'_url';
			$$custom_url = isset( $instance[$custom_url] ) ? $instance[$custom_url] : '';
			$custom_icon = 'custom_'.$i.'_icon';
			$$custom_icon = isset( $instance[$custom_icon] ) ? $instance[$custom_icon] : '';
		}

		
?>
		<!--title-->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<!--alt title-->
		<p><label for="<?php echo $this->get_field_id( 'alt' ); ?>"><?php _e('Icon Alt Title:', 'mk_framework'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id( 'alt' ); ?>" name="<?php echo $this->get_field_name( 'alt' ); ?>" type="text" value="<?php echo $alt; ?>" /></p>

		<!--size-->
		
		<p class="mk-choose-social-networks">
			<label for="<?php echo $this->get_field_id( 'enable_sites' ); ?>"><?php _e('Choose Sites:', 'mk_framework'); ?></label>
			<select name="<?php echo $this->get_field_name( 'enable_sites' ); ?>[]" id="<?php echo $this->get_field_id( 'enable_sites' ); ?>" style="width:300px" class="social_icon_select_sites mk-chosen widefat" multiple="multiple">
				<?php foreach ( $this->sites as $site ):?>
				<option value="<?php echo strtolower( $site );?>"<?php echo in_array( strtolower( $site ), $enable_sites )? 'selected="selected"':'';?>><?php echo $site;?></option>
				<?php endforeach;?>
			</select>
		</p>

		<p>
			<em><?php echo "Note: Please input FULL URL <br/>(e.g. <code>http://www.facebook.com/username</code>)";?></em>
		</p>
		<div class="social_icon_wrap">
		<?php foreach ( $this->sites as $site ):?>
		<p class="social_icon_<?php echo strtolower( $site );?>" <?php if ( !in_array( strtolower( $site ), $enable_sites ) ):?>style="display:none"<?php endif;?>>
			<label for="<?php echo $this->get_field_id( strtolower( $site ) ); ?>"><?php echo $site.' '.'URL:'?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( strtolower( $site ) ); ?>" name="<?php echo $this->get_field_name( strtolower( $site ) ); ?>" type="text" value="<?php echo $$site; ?>" />
		</p>
		<?php endforeach;?>
		</div>

<?php

	}
}
/***************************************************/



?>