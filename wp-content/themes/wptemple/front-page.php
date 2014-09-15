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
    $posts = get_home_posts();
    if (!count($posts)) {
        echo '<span class="well">No Posts</span>';
        return;
    }

    for ($i = 0; $i < count($posts); $i++) {
        $post = $posts[$i];
        if ($i === 0) { 
            $extra_class = 'top';
        } elseif ($i & 1) {
            $extra_class = 'odd';
        } else {
            $extra_class = 'even';
        }
?>
        <div class="grid-post-area <?php echo $extra_class;?>">
            <a href="<?php echo get_permalink($post->ID); ?>">
                <img class="grid-post-thumbnail" src="<?php echo get_thumbnail($post); ?>">
            </a>
            <a href="<?php echo get_permalink($post->ID); ?>">
                <h2 class="grid-post-title"><?php echo $post->post_title; ?></h2>
            </a>
            <p class="grid-post-excerpt"><?php echo (!empty($post->post_excerpt)) ? $post->post_excerpt : wp_trim_words($post->post_content); ?></p>
        </div>
<?php
    }
}

function get_thumbnail($post) {
    if (has_post_thumbnail($post->ID)) {
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID, 'single-post-thumbnail'));
        return $thumbnail[0];
    } else {
        return '';
    }
}

function get_home_posts() {
    $args = array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => 5,
        'orderby'           => 'date',
        'order'             => 'DESC'
    );

    $query = new WP_Query($args);
    return ($query->have_posts()) ? $query->get_posts() : array();
}

genesis();
