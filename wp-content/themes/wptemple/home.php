<?php
/**
 * This file adds the Home Page to the WP Temple Child Theme.
 *
 * @author Zach Russell 
 * @package WP Temple 
 * @subpackage Customizations
 */

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'wpt_home_loop');


function wpt_home_loop() {
   $item_no = (is_front_page()) ? 0 : 1;
   while ( have_posts() ) {
      the_post();
      
      $post = get_post( get_the_ID() );
      
      if ($item_no++ === 0) { 
	 $extra_class = 'top';
	 $thumbnail_size = 'homepage-featured-large';
      } else {
	 $thumbnail_size = 'homepage-featured';
	 if ($item_no & 1) {
	    $extra_class = 'even';
	 } else {
	    $extra_class = 'odd';
	 }
      }

      $categories = get_the_category($post->ID);
      $category_links = array_map(function ($cat) {
	 return '<a href="' . get_category_link($cat->term_id) . '">' . $cat->cat_name . '</a>';
      }, $categories);

      $tags = get_the_tags($post->ID);
      if (is_array($tags) && count($tags)) {
	 $tag_links = array_map(function ($tag) {
	    return '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
	 }, $tags);
      } else {
	 $tag_links = array('none');
      }

      $comments = get_comments_number($post->ID);
      global $Genesis_Simple_Share;

      if ( $extra_class === 'odd' ) {
	 echo '<div class="grid-post-row">';
      }
?>
<div class="grid-post-area <?php echo $extra_class;?>">
   <div class="grid-post-upper">
      <a href="<?php echo get_permalink($post->ID); ?>">
	 <?php echo get_grid_thumbnail($post, true, $thumbnail_size); ?>
      </a>
      <span class="grid-post-comment-count"><?php printf(ngettext('%d comment', '%d comments', $comments), $comments); ?></span>
   </div>
   <div class="grid-post-content-box">
      <a href="<?php echo get_permalink($post->ID); ?>">
	 <h2 class="grid-post-title"><?php echo $post->post_title; ?></h2>
      </a>
      <div class="grid-post-meta">
	 <span class="grid-post-meta">By <? echo get_the_author_meta( 'display_name', $post->post_author) ?> on <?php echo get_the_date( 'F j, Y', $post->ID ) ?> in <?php echo implode(', ', $category_links); ?></span>
	 <span class="grid-post-share-icons"><?php echo genesis_share_get_icon_output( 'home-page-post-' . $post->ID, $Genesis_Simple_Share->icons ) ?></span>
      </div>
      <p class="grid-post-excerpt"><?php echo (!empty($post->post_excerpt)) ? $post->post_excerpt : wp_trim_words($post->post_content); ?></p>
   </div>
   <div class="grid-post-read-more">
      <a href="<?php echo get_permalink($post->ID); ?>">Read More</a>
   </div>
</div>
<?php
if ( $extra_class === 'even' ) {
   echo '</div>';
}
}
if ( $extra_class === 'odd' ) {
   echo '</div>';
}
echo '<div class="pagination-container">';
genesis_posts_nav();
wp_reset_query();
}
  
echo '</div>';

function get_grid_thumbnail($post, $use_placeholder, $size ) {
if (has_post_thumbnail($post->ID)) {
$thumbnail = get_the_post_thumbnail($post->ID, $size, array('class' => 'grid-post-thumbnail'));
return $thumbnail;
} else {
if ($use_placeholder) {
return '<img class="grid-post-thumbnail" src="' . get_stylesheet_directory_uri() . '/images/home-placeholder-' . $size . '.gif">';
} else {
return '';
}
}
}

function get_home_posts() {
$page = get_query_var('paged');
$args = array(
'post_type'         => 'post',
'post_status'       => 'publish',
'posts_per_page'    => $page === 0 ? 5 : 6,
'orderby'           => 'date',
'order'             => 'DESC',
'paged'             => $page
);

return new WP_Query($args);
}

genesis();

?>
