<?php
/**
 * This file adds the Home Page to the WP Temple Child Theme.
 *
 * @author Zach Russell 
 * @package WP Temple 
 * @subpackage Customizations
 */
require_once( ABSPATH . '/wp-content/plugins/genesis-simple-share/lib/front-end.php' );

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'wpt_home_loop');

function wpt_home_loop() {
  if ( function_exists( 'genesis_grid_loop' ) ) {
    genesis_grid_loop(
      array( 'features' => 1,
	'feature_image_size' => 'homepage-featured-large',
	'feature_image_class' => 'post-image-featured',
	'feature_content_limit' => 150,
	'grid_image_size' => 'homepage-featured',
	'grid_image_class' => 'post-image',
	'grid_content_limit' => 80,
	'more' => "read more",
      ) );
  } else {
    genesis_standard_loop();
  }
}

remove_action( 'genesis_entry_footer', 'genesis_post_meta', 10 );
remove_action( 'genesis_loop', array( $Genesis_Simple_Share, 'start_icon_actions' ), 5 );
remove_action( 'genesis_loop', array( $Genesis_Simple_Share, 'end_icon_actions' ), 15 );

add_action( 'genesis_entry_footer', 'wpt_share', 10);

function wpt_share() {
  global $Genesis_Simple_Share;
  
  echo genesis_share_get_icon_output( 'home-' . get_the_ID(), $Genesis_Simple_Share->icons );
}

genesis();
?>
