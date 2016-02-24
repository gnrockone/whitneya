<?php


function CPT_Video() {
	$labels = array(
		'name'               => __( 'Videos'),
		'singular_name'      => __( 'Video'),
		'menu_name'          => __( 'Videos'),
		'name_admin_bar'     => __( 'Video'),
		'add_new'            => __( 'Add New'),
		'add_new_item'       => __( 'Add New Video'),
		'new_item'           => __( 'New Video'),
		'edit_item'          => __( 'Edit Video'),
		'view_item'          => __( 'View Video'),
		'all_items'          => __( 'All Videos'),
		'search_items'       => __( 'Search Videos'),
		'parent_item_colon'  => __( 'Parent Videos:'),
		'not_found'          => __( 'No Videos found.'),
		'not_found_in_trash' => __( 'No Videos found in Trash.')
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'			 => 'dashicons-video-alt2',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'video' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'author')
	);

	register_post_type( 'video', $args );
}
add_action('init','CPT_Video');

function CPT_Articles() {
	$labels = array(
		'name'               => __( 'Articles'),
		'singular_name'      => __( 'Article'),
		'menu_name'          => __( 'Articles'),
		'name_admin_bar'     => __( 'Article'),
		'add_new'            => __( 'Add New'),
		'add_new_item'       => __( 'Add New Article'),
		'new_item'           => __( 'New Article'),
		'edit_item'          => __( 'Edit Article'),
		'view_item'          => __( 'View Article'),
		'all_items'          => __( 'All Articles'),
		'search_items'       => __( 'Search Articles'),
		'parent_item_colon'  => __( 'Parent Articles:'),
		'not_found'          => __( 'No Articles found.'),
		'not_found_in_trash' => __( 'No Articles found in Trash.')
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'			 => 'dashicons-article-edit',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'writing' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5, //this is under post post type
		'supports'           => array( 'title', 'editor', 'author')
	);

	register_post_type( 'writing', $args );
}
add_action('init','CPT_Articles');


/*
	==================================================
	| Creating Custom Type Setup Function
	==================================================
 */

// template for creating custom post type
// function CPT_Book() {
// 	$labels = array(
// 		'name'               => __( 'Books'),
// 		'singular_name'      => __( 'Book'),
// 		'menu_name'          => __( 'Books'),
// 		'name_admin_bar'     => __( 'Book'),
// 		'add_new'            => __( 'Add New'),
// 		'add_new_item'       => __( 'Add New Book'),
// 		'new_item'           => __( 'New Book'),
// 		'edit_item'          => __( 'Edit Book'),
// 		'view_item'          => __( 'View Book'),
// 		'all_items'          => __( 'All Books'),
// 		'search_items'       => __( 'Search Books'),
// 		'parent_item_colon'  => __( 'Parent Books:'),
// 		'not_found'          => __( 'No books found.'),
// 		'not_found_in_trash' => __( 'No books found in Trash.')
// 	);

// 	$args = array(
// 		'labels'             => $labels,
//         'description'        => __( 'Description.'),
// 		'public'             => true,
// 		'publicly_queryable' => true,
// 		'show_ui'            => true,
// 		'show_in_menu'       => true,
// 		'menu_icon'			 => 'dashicons-book-alt',
// 		'query_var'          => true,
// 		'rewrite'            => array( 'slug' => 'book' ),
// 		'capability_type'    => 'post',
// 		'has_archive'        => true,
// 		'hierarchical'       => false,
// 		'menu_position'      => 5, //this is under post post type
// 		'supports'           => array( 
// 		'title', 
// 		'editor',
// 		'comments'
// 		'trackbacks',
// 		'revisions',
// 		'author',
// 		'excerpt',
// 		'thumbnail',
// 		'custom-fields',
// 		'page-attributes' )
// 	);

// 	register_post_type( 'book', $args );
// }
// add_action('init','CPT_Book');

?>