<?php

/**
 * Template Name: Regular Page, One Column
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

// Featured Image Background and Title for a regular page
if (is_page()) {
    $post_id = get_the_ID();
    $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');

    // Define a default image URL
    $default_image_url = get_template_directory_uri() . '/dist/images/default-hero-img.webp';

    // Use the featured image if available, otherwise use the default
    $background_image_url = $featured_image_url ? $featured_image_url : $default_image_url;

    echo '<section class="container-fw hero-title-area" style="background-image: url(' . esc_url($background_image_url) . ');">';
    echo '<div class="container"><div class="row"><div class="align-center text-center">';
    echo '<h1>' . get_the_title() . '</h1>';
    echo '</div></div></div></section>';
}
?>

<section class="container content-bg">
    <div class="row">
        <div class="col-12 align-center content">
            <div class="content-area">
                <?php the_content(); ?>
            </div>
        </div>
    </div><!-- .row -->
</section>



<?php
get_footer();
