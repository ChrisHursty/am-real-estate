<?php
/**
 * Archive: Listing
 */
get_header(); ?>

<div class="container archive-listing-container">
    <header class="archive-header">
        <h1 class="archive-title"><?php post_type_archive_title(); ?></h1>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="row listing-grid">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-sm-6 col-md-3 listing-item">
                    <div class="listing-thumb">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium', [ 'class' => 'img-responsive' ] ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="listing-info">
                        <h2 class="listing-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <?php
                        // ACF fields
                        $price      = get_field('price');
                        $bedrooms   = get_field('bedrooms');
                        $bathrooms  = get_field('bathrooms');
                        $sq_footage   = get_field('square_footage');

                        if ( $price ) {
                            // Format number with commas (e.g. 650000 -> 650,000)
                            // Prepend the $ symbol
                            $formatted_price = '$' . number_format($price);

                            echo '<div class="listing-price">' . esc_html($formatted_price) . '</div>';
                        }
                        if ( $bedrooms ) {
                            echo '<div class="listing-beds">Beds: ' . esc_html( $bedrooms ) . '</div>';
                        }
                        if ( $bathrooms ) {
                            echo '<div class="listing-baths">Baths: ' . esc_html( $bathrooms ) . '</div>';
                        }
                        if ( $sq_footage ) {
                            // Format number with commas (e.g. 1800 -> 1,800)
                            // Then append the “sqft” or “sq ft”
                            $formatted_sqft = number_format($sq_footage) . ' sqft';
                        
                            echo '<div class="listing-sqft">' . esc_html($formatted_sqft) . '</div>';
                        }
                        ?>
                    </div>
                </div><!-- .col -->
            <?php endwhile; ?>
        </div><!-- .row -->

        <!-- Pagination -->
        <div class="pagination-wrap">
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '« Previous', 'textdomain' ),
                'next_text' => __( 'Next »', 'textdomain' ),
            ) );
            ?>
        </div>

    <?php else : ?>
        <div class="no-listings">
            <p><?php _e( 'No listings found.', 'textdomain' ); ?></p>
        </div>
    <?php endif; ?>

</div><!-- .container -->

<?php get_footer(); ?>
