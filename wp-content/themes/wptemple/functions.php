<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'WP Temple Theme' );
define( 'CHILD_THEME_URL', 'https://www.wptemple.com/');
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );

//* Add support for header image upload
add_theme_support( 'custom-header', array(
    'default-text-color'        => 'ffffff',
    'header-selector'           => '.header-image .site-header .wrap',
    'no_header_text'            => TRUE,
    'height'                    => 100,
    'width'                     => 300,
) );

//* WPT Code Snippets CPT

// Register Custom Post Type
// Register Custom Post Type
function wpt_code_snippets() {

	$labels = array(
		'name'                => _x( 'Code Snippets', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Code Snippet', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Snippets', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Snippets', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'code-snippets', 'text_domain' ),
		'description'         => __( 'Code Snippets for WP Temple', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( ),
		'taxonomies'          => array( 'category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'						=> 'dashicons-editor-code',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
        'rewrite'             => array( 'slug' => 'snippets'),
	);
	register_post_type( 'code_snippets', $args );

}

// Hook into the 'init' action
add_action( 'init', 'wpt_code_snippets', 0 );
