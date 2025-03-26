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
// Featured Image Background and Title
if (has_post_thumbnail()) {
    $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
} else {
    // Define a default image URL
    $default_image_url = get_template_directory_uri() . '/dist/images/default-hero-img.webp';
    $featured_image_url = $default_image_url; 
}

// Only output section if we have an image URL
if ($featured_image_url) { 
    echo '<section class="container-fw hero-title-area" style="background-image: url(' . esc_url($featured_image_url) . ');">';
    echo '<div class="container"><div class="row"><div class="align-center text-center">';
    echo '<h1>' . get_the_title() . '</h1>';
    echo '</div></div></div></section>';
}

?>

<section class="container content-bg">
    <div class="row">
        <div class="align-center content">
            <div class="content-area">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<section class="cta">
    <?php get_template_part('template-parts/call-to-action'); ?>
</section>

<?php
get_footer();
