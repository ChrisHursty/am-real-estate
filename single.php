<?php

/**
 * Single Post Template
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); ?>

<!-- Progress Bar Container -->
<div id="progressBarContainer">
    <div id="progressBar"></div>
</div>

<?php
// Initialize variables
$post_id            = get_the_ID();
$default_image_url  = get_template_directory_uri() . '/dist/images/default-hero-img.webp'; // Default image URL
$featured_image_url = get_the_post_thumbnail_url($post_id, 'full'); // Attempt to get the featured image URL
$category_terms     = get_the_terms($post_id, 'category'); // Get categories

// Use default image if no featured image is set
if (!$featured_image_url) {
    $featured_image_url = $default_image_url;
}

// Output the section only if we have an image URL (which will always be true at this point)
echo '<section class="container-fw hero-title-area" style="background-image: url(' . esc_url($featured_image_url) . ');">';
echo '<div class="container"><div class="row"><div class="align-center text-center">';
echo '<h1>' . get_the_title() . '</h1></div>';

// Check if there are categories and they are not WP errors
if (!empty($category_terms) && !is_wp_error($category_terms)) {
    echo '<div class="genre-container">'; // Changed class name from genre-container to category-container for clarity
    foreach ($category_terms as $category_term) {
        $category_link = get_term_link($category_term->term_id, 'category'); // Get category link
        if (!is_wp_error($category_link)) {
            echo '<div class="text-center genre-link"><a href="' . esc_url($category_link) . '">' . esc_html($category_term->name) . '</a></div>';
        }
    }
    echo '</div>'; // Close category-container div
}

echo '</div></div></section>';

?>
<section class="container content-bg">
    <div class="row">
        <div class="col-sm-12 col-md-8 content">
            <div class="content-area">
                <?php the_content(); ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div><!-- .row -->
</section>

<section class="cta">
    <?php get_template_part('template-parts/call-to-action'); ?>
</section>

<?php
get_footer();
