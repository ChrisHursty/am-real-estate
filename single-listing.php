<?php
/**
 * Single: Listing
 */
get_header(); ?>

<div class="container single-listing-container">
    <div class="row">

        <!-- Main Content -->
        <div class="col-md-8 listing-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
                <h1 class="listing-title"><?php the_title(); ?></h1>

                <?php
                // ACF fields
                $price        = get_field('price');
                $bedrooms     = get_field('bedrooms');
                $bathrooms    = get_field('bathrooms');
                $sq_footage   = get_field('square_footage');
                $short_desc   = get_field('short_description');
                $gallery      = get_field('photo_gallery');

                // Display featured image at top if you want
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'large', [ 'class' => 'img-responsive mb-3' ] );
                }

                // Additional info fields
                echo '<div class="listing-details">';
                    if ( $price ) {
                        // Format number with commas (e.g. 650000 -> 650,000)
                        // Prepend the $ symbol
                        $formatted_price = '$' . number_format($price);

                        echo '<div class="listing-price">' . esc_html($formatted_price) . '</div>';
                    }
                    if ( $bedrooms ) {
                        echo '<div class="listing-bedrooms"><strong>Bedrooms:</strong> ' . esc_html( $bedrooms ) . '</div>';
                    }
                    if ( $bathrooms ) {
                        echo '<div class="listing-bathrooms"><strong>Bathrooms:</strong> ' . esc_html( $bathrooms ) . '</div>';
                    }
                    if ( $sq_footage ) {
                        // Format number with commas (e.g. 1800 -> 1,800)
                        // Then append the “sqft” or “sq ft”
                        $formatted_sqft = number_format($sq_footage) . ' sqft';
                    
                        echo '<div class="listing-sqft">' . esc_html($formatted_sqft) . '</div>';
                    }
                echo '</div>';

                if ( $short_desc ) {
                    echo '<p class="listing-shortdesc">' . wp_kses_post( $short_desc ) . '</p>';
                }

                // The main content (if any) can be used for a longer property description
                the_content();

                // Gallery
                if ( $gallery ) {
                    echo '<div class="listing-gallery row">';
                    foreach ( $gallery as $image ) {
                        $thumb_url  = esc_url($image['sizes']['medium']);
                        $full_url   = esc_url($image['url']);
                        $alt        = esc_attr($image['alt']);

                        echo '<div class="col-md-4 col-sm-6">';
                            echo '<a href="' . $full_url . '" target="_blank">';
                                echo '<img src="' . $thumb_url . '" alt="' . $alt . '" class="img-fluid listing-gallery-item" />';
                            echo '</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
                ?>

            <?php endwhile; endif; ?>
        </div><!-- .col-md-8 -->

        <!-- Sidebar -->
        <div class="col-md-4 listing-sidebar">
            <aside class="widget related-properties">
                <h3>Related Properties</h3>
                <p>(Placeholder for related properties by taxonomy, location, etc.)</p>
            </aside>

            <aside class="widget open-houses">
                <h3>Open Houses</h3>
                <p>(Placeholder for future “Open House” CPT relationship)</p>
            </aside>

            <aside class="widget recent-posts">
                <h3>From Our Blog</h3>
                <p>(Placeholder for recent blog posts.)</p>
            </aside>
        </div><!-- .col-md-4 -->
    </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
