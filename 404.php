<?php

/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @package AMRE WP
 * @since 1.0.0
 */
get_header(); 

// Featured Image Background and Title for a regular page

    $post_id = get_the_ID();
    $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');

    // Define a default image URL
    $default_image_url = get_template_directory_uri() . 'dist/images/default-hero-img.webp';

    // Use the featured image if available, otherwise use the default
    $background_image_url = $featured_image_url ? $featured_image_url : $default_image_url;

    echo '<section class="container-fw hero-title-area" style="background-image: url(' . esc_url($background_image_url) . ');">';
    echo '<div class="container"><div class="row"><div class="align-center text-center">';
    echo '<h1>';
    echo 'Oh No! Page Not Found?!';
    echo '</h1>';
    echo '</div></div></div></section>';

?>

<section class="container content-bg slim-page">
    <div class="row">
        <div class="align-center content">
            <div class="content-area text-center">
                <h2>
                    <?php esc_html_e( 'It looks like nothing was found at this location', 'amre-wp' ); ?>
                </h2>
                <div class="button-box">
                    <a href="/" class="amre-btn white-btn"><span>Return Home</span></a>
                </div>
                <div class="search-container">
                    <?php get_search_form(); ?>
                </div>
                
            </div>
        </div>
    </div><!-- .row -->
</section>

<?php
get_footer();
?>
