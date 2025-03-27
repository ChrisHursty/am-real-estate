<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); ?>

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

echo '</div></div></section>';

?>

<div class="container single-listing-container">
    <div class="row">

        <!-- Main Content -->
        <div class="col-md-8 listing-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <?php
                // ACF fields
                $price        = get_field('price');
                $bedrooms     = get_field('bedrooms');
                $bathrooms    = get_field('bathrooms');
                $sq_footage   = get_field('square_footage');
                $short_desc   = get_field('short_description');
                $gallery      = get_field('photo_gallery');

                // If no gallery is set, use the featured image
                $images_for_slider = array();

                // 1) Featured image if it exists
                if ( has_post_thumbnail() ) {
                    $images_for_slider[] = array(
                        'full_url' => get_the_post_thumbnail_url(get_the_ID(), 'full'),  // large or 'full'
                        'thumb_url'=> get_the_post_thumbnail_url(get_the_ID(), 'large'),
                        'alt'      => get_the_title()
                    );
                }

                // 2) ACF gallery images
                if ( $gallery ) {
                    foreach ( $gallery as $image ) {
                        $images_for_slider[] = array(
                            'full_url' => $image['url'],           // full size
                            'thumb_url'=> $image['sizes']['large'], // or 'medium_large'
                            'alt'      => $image['alt']
                        );
                    }
                }

                // If we have images, display Owl Carousel
                if ( !empty($images_for_slider) ) : ?>
                    <div class="owl-carousel owl-theme listing-featured-carousel mb-3">
                        <?php foreach ( $images_for_slider as $img ) : ?>
                            <div class="item">
                                <!-- Wrap the image in a link to the full-size version -->
                                <a href="<?php echo esc_url($img['full_url']); ?>" class="popup-image">
                                    <img 
                                        src="<?php echo esc_url($img['thumb_url']); ?>" 
                                        alt="<?php echo esc_attr($img['alt']); ?>"
                                        class="img-responsive"
                                    />
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="listing-details d-flex flex-wrap justify-content-start">
                    <?php if ( $price ) : ?>
                        <div class="detail-box text-center">
                            <i class="fas fa-dollar-sign"></i>
                            <span class="detail-text">
                                <?php echo esc_html('$' . number_format($price)); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <?php if ( $bedrooms ) : ?>
                        <div class="detail-box text-center">
                            <i class="fas fa-bed"></i>
                            <span class="detail-text">
                                <?php echo esc_html($bedrooms . ' Bedrooms'); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <?php if ( $bathrooms ) : ?>
                        <div class="detail-box text-center">
                            <i class="fas fa-bath"></i>
                            <span class="detail-text">
                                <?php echo esc_html($bathrooms . ' Bathrooms'); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <?php if ( $sq_footage ) : ?>
                        <div class="detail-box text-center">
                            <i class="fas fa-ruler-combined"></i>
                            <span class="detail-text">
                                <?php echo esc_html( number_format($sq_footage) . ' sqft' ); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>

                <?php
                if ( $short_desc ) {
                    echo '<p class="listing-shortdesc">' . wp_kses_post( $short_desc ) . '</p>';
                }

                // The main content (if any) can be used for a longer property description
                the_content();
                ?>

            <?php endwhile; endif; ?>
            <?php
            // Title is the address
            $address = get_the_title();

            // url-encode it for a maps query
            $encoded_address = urlencode($address);

            // Simple Google Maps embed
            ?>
            <div class="listing-map">
                <iframe
                    width="100%"
                    height="400"
                    frameborder="0"
                    style="border:0"
                    src="https://www.google.com/maps?q=<?php echo $encoded_address; ?>&output=embed"
                    allowfullscreen
                >
                </iframe>
            </div>

        </div><!-- .col-md-8 -->
        <!-- Sidebar -->
        <?php get_sidebar(); ?>
    </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
