<?php

/**
 * Landing Page CPT
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$post_id = get_the_ID();
$featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
// Fetch common data from Theme Options
$business_name = get_field('business_name', 'option');
$business_logo = get_field('business_logo', 'option');
$phone = get_field('business_phone', 'option');
$address = [
    'street' => get_field('street_address', 'option'),
    'city' => get_field('city', 'option'),
    'state' => get_field('state', 'option'),
    'postal_code' => get_field('postal_code', 'option'),
    'country' => get_field('country', 'option'),
    'latitude' => get_field('latitude', 'option'),
    'longitude' => get_field('longitude', 'option'),
];
$social_links = get_field('social_links', 'option');

// Fetch dynamic data for the Landing Page
$target_area = get_field('target_area');
$custom_description = get_field('custom_description');
$page_image = get_field('page_image');

// Generate Schema
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => $business_name,
    'description' => $custom_description ?: get_field('default_description', 'option'),
    'image' => $page_image ?: $business_logo,
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $address['street'],
        'addressLocality' => $address['city'],
        'addressRegion' => $address['state'],
        'postalCode' => $address['postal_code'],
        'addressCountry' => $address['country']
    ],
    'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => $address['latitude'],
        'longitude' => $address['longitude']
    ],
    'telephone' => $phone,
    'url' => get_permalink(),
    'serviceArea' => $target_area ? ['@type' => 'Place', 'name' => $target_area] : null,
    'sameAs' => $social_links ? array_column($social_links, 'social_platform_url') : []
];

// Output JSON-LD
echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';

?>
<!-- LP HERO -->
<section class="container-fw lp-hero light-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 lp-hero-content align-left">
                <h1>AM Real Estate | Real Estate Services Near <?php the_field('location_name'); ?></h1>
                <div class="lp-hero-text">
                    <?php echo wp_kses_post(get_field('additional_details')); ?>
                </div>
                <div class="button-box">
                    <a href="<?php the_field('sign_up_url'); ?>" target="_blank" class="amre-btn">
                        <span>Get in Touch</span>
                    </a>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 lp-hero-image align-right">
                <?php 
                $neighborhood_id = get_field('neighborhood_post_id');

                // Try to get neighborhood featured image
                if ($neighborhood_id && get_post_type($neighborhood_id) === 'neighborhoods') {
                    $thumbnail_id = get_post_thumbnail_id($neighborhood_id);
                    $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'large');
                }

                // If neighborhood image missing or ID invalid, get fallback image from options page
                if (empty($thumbnail_url)) {
                    $fallback = get_field('fallback_image', 'option');
                    if ($fallback && isset($fallback['url'])) {
                        $thumbnail_url = esc_url($fallback['url']);
                    }
                }

                // Output the image or final fallback message
                if (!empty($thumbnail_url)) {
                    echo '<img src="' . esc_url($thumbnail_url) . '" class="img-fluid neighborhood-hero-img" alt="Featured neighborhood image" loading="lazy">';
                } else {
                    echo '<p>No image available.</p>';
                }
                ?>
            </div>


        </div><!-- .row -->
    </div>
</section>

<!-- About Section -->
<section class="container about-section">
    <div class="row">
        <div class="col-sm-12 col-md-6 align-left image">
            <?php 
            if (has_post_thumbnail()) {
                echo get_the_post_thumbnail(get_the_ID(), 'full', ['alt' => get_the_title()]);
            } else {
                echo '<p>No featured image available.</p>';
            }
            ?>
        </div>
        <div class="col-sm-12 col-md-6 align-right content">
            <?php echo apply_filters('the_content', get_field('lp_intro', 'option')); ?>
            <a href="<?php the_field('sign_up_url'); ?>" target="_blank" class="amre-btn">
                <span>Get In Touch</span>
            </a>
        </div>
    </div>
</section>

<!-- Grid Repeater from Content Options -->
<section class="container-fw services-container dark-bg">
    <div class="container">
        <div class="row">
            <div class="align-center">
                <h2>Services</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row grid-row">
            <?php if (have_rows('services_grid_repeater', 'option')) : ?>
                <?php
                $grid_items = get_field('services_grid_repeater', 'option');
                $total_items = is_array($grid_items) ? count($grid_items) : 0;

                // Determine column class based on number of items
                $col_class = 'col-md-12';
                if ($total_items == 2) {
                    $col_class = 'col-sm-12 col-md-6';
                } elseif ($total_items >= 3) {
                    $col_class = 'col-sm-12 col-md-4';
                }
                ?>

                <?php while (have_rows('services_grid_repeater', 'option')) : the_row(); 
                    $image = get_sub_field('image');
                    $title = get_sub_field('heading');
                    $description = get_sub_field('description');
                    $button_text = get_sub_field('button_text');
                    $button_link = get_sub_field('button_link');
                ?>
                    <div class="grid-item <?php echo esc_attr($col_class); ?>">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="service-image">
                        <?php endif; ?>
                        <div class="grid-content">
                            <?php if ($title) : ?>
                                <h2 class="grid-title"><?php echo esc_html($title); ?></h2>
                            <?php endif; ?>
                            <?php if ($description) : ?>
                                <p class="grid-description"><?php echo esc_html($description); ?></p>
                            <?php endif; ?>
                            <?php if ($button_text && $button_link) : ?>
                                <a class="grid-btn white-btn" href="<?php echo esc_url($button_link); ?>">
                                    <span><?php echo esc_html($button_text); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="align-center">No grid available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <a class="amre-btn align-center white-btn" href="/services"><span>View All Of Our Services</span></a>
        </div>
    </div>
</section>

<!-- LP Gallery Slider -->
<section class="container-fw gallery-bg">
    <?php
    $images = get_field('lp_gallery', 'option');
    if ($images) : ?>
        <div class="owl-carousel hp-slider owl-theme lp-gallery-carousel">
            <?php foreach ($images as $image) : ?>
                <div class="item">
                    <img src="<?php echo wp_get_attachment_image_url($image['id'], 'lp-gallery-img'); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>No gallery images found.</p>
    <?php endif; ?>
</section>

<?php
// Ensure ACF is active
if( function_exists('have_rows') && have_rows('mobile_buttons', 'option') ):

    while( have_rows('mobile_buttons', 'option') ): the_row();

    $button_one_text = get_sub_field('button_one_text', 'option');
    $button_one_url = get_sub_field('button_one_url', 'option');
    $button_one_icon = get_sub_field('button_one_icon', 'option');
    $button_one_bg_color = get_sub_field('button_one_bg_color', 'option');
    $button_one_text_color = get_sub_field('button_one_text_color', 'option');

    $button_two_text = get_sub_field('button_two_text', 'option');
    $button_two_url = get_sub_field('button_two_url', 'option');
    $button_two_icon = get_sub_field('button_two_icon', 'option');
    $button_two_bg_color = get_sub_field('button_two_bg_color', 'option');
    $button_two_text_color = get_sub_field('button_two_text_color', 'option');

    ?>

    <div class="mobile-buttons">
        <a href="<?php echo esc_url($button_one_url); ?>" class="mobile-button" style="background-color: <?php echo esc_attr($button_one_bg_color); ?>; color: <?php echo esc_attr($button_one_text_color); ?>;">
            <?php echo esc_html($button_one_text); ?><i class="fas <?php echo esc_attr($button_one_icon); ?>" aria-label="Free Class" aria-hidden="true"></i>
        </a>
        <?php if ($button_two_text && $button_two_url): ?>
            <a href="<?php echo esc_url($button_two_url); ?>" class="mobile-button" style="background-color: <?php echo esc_attr($button_two_bg_color); ?>; color: <?php echo esc_attr($button_two_text_color); ?>;">
                <?php echo esc_html($button_two_text); ?><i class="fas <?php echo esc_attr($button_two_icon); ?>" aria-label="Register for Events" aria-hidden="true"></i>
            </a>
        <?php endif; ?>
    </div>

<?php endwhile; endif; ?>

<?php get_footer();
