<?php
$show_recent_listings = get_field('show_recent_listings');
$num_recent_listings  = (int) get_field('num_recent_listings');

if ( $show_recent_listings && $num_recent_listings > 0 ) :
    // Query for the most recent listings
    $args = array(
        'post_type'      => 'listing',
        'posts_per_page' => $num_recent_listings
    );
    $recent_listings = new WP_Query($args);

    if ( $recent_listings->have_posts() ) : 
?>
<section class="container-fw home-recent-listings">
    <div class="container">
        <div class="align-center">
            <h2>Latest Listings</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php while ( $recent_listings->have_posts() ) : $recent_listings->the_post(); ?>
                <div class="col-sm-12 col-md-4">
                    <div class="listing-item card">
                        <a href="<?php the_permalink(); ?>" class="img-link">
                            <?php 
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail('medium', ['class' => 'card-img-top']);
                                }
                            ?>
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <?php 
                                $price = get_field('price');
                                if ( $price ) :
                            ?>
                                <p class="card-text">$<?php echo esc_html( number_format($price) ); ?></p>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="amre-btn">
                                <span><?php _e('View Details', 'amre'); ?></span>
                                
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <a class="amre-btn align-center" href="/listings"><span>View All Listings</span></a>
        </div><!-- .row -->
    </div> <!-- .container -->
</section>
<?php 
    endif;
    wp_reset_postdata();
endif;
?>