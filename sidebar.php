<?php
/**
 * The Sidebar
 */
?>

<div class="col-sm-12 col-md-4 sidebar">

    <?php
    // === 1. Latest Listings (3) ===
    $latest_listings = new WP_Query(array(
        'post_type'      => 'listing', // your CPT slug
        'posts_per_page' => 3,
        'order'          => 'DESC',
        'orderby'        => 'date'
    ));

    if ( $latest_listings->have_posts() ) :
    ?>
        <div class="sidebar-section sidebar-latest-listings">
            <h2>Latest Listings</h2>
            <?php 
            // Get the current listing ID
            $current_listing_id = get_the_ID();
    
            // Query open_houses to see if one links to this listing
            $args = array(
                'post_type'      => 'open_houses',
                'posts_per_page' => -1,
                'meta_query'     => array(
                    array(
                        'key'     => 'linked_listing',   // The ACF field name
                        'value'   => '"' . $current_listing_id . '"', // ACF stores as a serialized string
                        'compare' => 'LIKE'
                    )
                ),
                // Optionally filter by date if you only want upcoming open houses
            );
    
            $open_query = new WP_Query($args);
    
            if ( $open_query->have_posts() ) : 
                while ( $open_query->have_posts() ) : $open_query->the_post();
                    $oh_date = get_field('open_house_date');
                    $oh_time = get_field('open_house_time');
                    ?>
                    <div class="open-house-banner">
                        <strong>Open House:</strong>
                        <?php if ( $oh_date ) : ?>
                            <span class="oh-date"><?php echo esc_html($oh_date); ?></span>
                        <?php endif; ?>
    
                        <?php if ( $oh_time ) : ?>
                            <span class="oh-time"><?php echo esc_html($oh_time); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            <ul class="amre-sidebar-list">
                <?php while ( $latest_listings->have_posts() ) : $latest_listings->the_post(); ?>
                    <li class="amre-sidebar-item mb-3">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="amre-sidebar-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('sidebar-thumb'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="amre-sidebar-text">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>

            <a href="<?php echo esc_url( get_post_type_archive_link('listing') ); ?>" class="text-right"><span>See More</span></a>
        </div>
        <hr>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // === 2. Open Houses (3) ===
    // Adjust post_type if it's registered with a different slug.
    $open_houses = new WP_Query(array(
        'post_type'      => 'open_house', 
        'posts_per_page' => 3,
        'order'          => 'DESC',
        'orderby'        => 'date'
    ));

    if ( $open_houses->have_posts() ) :
    ?>
        <div class="sidebar-section sidebar-open-houses">
            <h2>Open Houses</h2>
            <ul class="amre-sidebar-list">
                <?php while ( $open_houses->have_posts() ) : $open_houses->the_post(); ?>
                    <li class="amre-sidebar-item mb-3">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="amre-sidebar-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('sidebar-thumb'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="amre-sidebar-text">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>

            <a href="<?php echo esc_url( get_post_type_archive_link('open_house') ); ?>" class="text-right"><span>See More</span></a>
        </div>
        <hr>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // === 3. Blog Posts (3) ===
    $recent_posts = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'order'          => 'DESC',
        'orderby'        => 'date'
    ));

    if ( $recent_posts->have_posts() ) :
    ?>
        <div class="sidebar-section sidebar-blog-posts">
            <h2>From The Blog</h2>
            <ul class="amre-sidebar-list">
                <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                    <li class="amre-sidebar-item mb-3">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="amre-sidebar-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('sidebar-thumb'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="amre-sidebar-text">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>

            <?php 
                // Typically the blog archive is page_for_posts or just /blog/.
                $blog_url = get_permalink( get_option('page_for_posts') ); 
                if ( ! $blog_url ) {
                    $blog_url = home_url('/blog');
                }
            ?>
            <a href="<?php echo esc_url( $blog_url ); ?>" class="text-right"><span>See More</span></a>
        </div>
    <?php
    endif;
    wp_reset_postdata();
    ?>

</div> <!-- .col-sm-12 .col-md-4 -->
