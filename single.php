<?php
/**
 * Single Post Template
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header(); ?>

<?php
// Initialize variables
$post_id            = get_the_ID();
$default_image_url  = get_template_directory_uri() . '/dist/images/default-hero-img.webp';
$featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
$category_terms     = get_the_terms($post_id, 'category');

// Fallback if no featured image
if (!$featured_image_url) {
    $featured_image_url = $default_image_url;
}
?>

<section class="container single-post-hero text-center">
    <!-- Post Title -->
    <h1><?php echo esc_html( get_the_title() ); ?></h1>

    <!-- Categories (comma-separated) -->
    <?php
    $category_terms = get_the_terms(get_the_ID(), 'category');
    if (!empty($category_terms) && !is_wp_error($category_terms)) : ?>
        <div class="post-categories mb-2">
            <?php
            // Build an array of linked category names
            $linked_cats = array();
            foreach ( $category_terms as $cat ) {
                $cat_link = get_term_link( $cat->term_id, 'category' );
                if ( ! is_wp_error($cat_link) ) {
                    $linked_cats[] = '<a href="' . esc_url($cat_link) . '">' . esc_html($cat->name) . '</a>';
                }
            }
            
            // Print them, comma-separated
            echo implode(', ', $linked_cats);
            ?>
        </div>
    <?php endif; ?>

    <!-- Featured Image -->
    <?php if ($featured_image_url) : ?>
        <div class="featured-image">
            <img 
                src="<?php echo esc_url($featured_image_url); ?>" 
                alt="<?php echo esc_attr(get_the_title()); ?>" 
                class="img-fluid" 
            />
        </div>
    <?php endif; ?>
</section>

<section class="container content-bg slim-page">
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
