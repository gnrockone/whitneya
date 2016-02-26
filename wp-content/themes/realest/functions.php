<?php
require get_template_directory() . '/functions/functions-scripts.php'; //script functions
require get_template_directory() . '/functions/functions-menus.php'; //menu functions
require get_template_directory() . '/functions/functions-menus-bootstrap-walker.php';
require get_template_directory() . '/functions/functions-widgets.php';
require get_template_directory() . '/functions/functions-custom-posts.php';
require get_template_directory() . '/functions/functions-custom-taxonomies.php';
require get_template_directory() . '/functions/functions-custom-made.php'; //custom made functions
require get_template_directory() . '/functions/functions-shortcodes.php';
require get_template_directory() . '/functions/functions-images.php';
require get_template_directory() . '/functions/functions-breadcrumbs.php';
require get_template_directory() . '/functions/functions-comments.php';
require get_template_directory() . '/functions/functions-theme-options.php';
require get_template_directory() . '/functions/functions-widget-blocks.php';

/*
	==================================================
	| Add theme support
	==================================================
 */

define('THEME_GRAND_NAME','Realest'); //The mother of all themes
define('THEME_SLUG','Realest');

//feature: 'custom-background' - adds background in the appearance menu in the dashboard
add_theme_support('custom-background');
//example. add_theme_support('post-formats',('aside','gallery','link'));
add_theme_support('post-formats',array('aside','image','video'));
//example. add_theme_support('html5',array('comment-list','comment-form','search-form'));
add_theme_support('html5',array('search-form','comment-form','gallery','comment-list'));
//enable theme_support for title-tag, Let WordPress manage the document title.
// By adding theme support, we declare that this theme does not use a
// hard-coded <title> tag in the document head, and expect WordPress to
// provide it for us.
add_theme_support('title-tag');


function rl_go_top_btn() {
	echo '<!--I am located in functions.php-->';
	echo '<a href="#" class="go-top"><i class="fa fa-arrow-up"></i></a>';
	echo '<!--End: I am located in functions.php-->';
}
if( get_option('sticky_back_to_top')) { 
	add_action('before_body_end','rl_go_top_btn'); 
}


?>