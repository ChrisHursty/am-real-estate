<?php

/**
 * Template Name: Home Page
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
?>

<?php 
// Get gallery field (array of images) for slideshow
$slides = get_field('hero_gallery');

// Get text fields
$hero_heading = get_field('hero_heading');
$hero_intro   = get_field('hero_intro');

// Get button text and link fields (3 buttons)
$button_1_text = get_field('button_1_text');
$button_1_link = get_field('button_1_link');

$button_2_text = get_field('button_2_text');
$button_2_link = get_field('button_2_link');

$button_3_text = get_field('button_3_text');
$button_3_link = get_field('button_3_link');
?>

<section class="container-fw home-hero">
    
    <!-- Slideshow wrapper -->
    <?php if ( $slides ): ?>
        <div class="hero-slideshow">
            <?php foreach ( $slides as $index => $slide ): 
                $slide_url = esc_url($slide['url']);
            ?>
                <div class="hero-slide" style="background-image: url('<?php echo $slide_url; ?>');"></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Gradient overlay -->
    <div class="hero-overlay"></div>

    <!-- Hero content -->
    <div class="container hero-content-wrapper">
        <div class="row">
            <div class="col-sm-12 align-center text-center">
                <?php if ( $hero_heading ): ?>
                    <h1><?php echo wp_kses_post( $hero_heading ); ?></h1>
                <?php endif; ?>

                <?php if ( $hero_intro ): ?>
                    <h2 class="intro"><?php echo wp_kses_post( $hero_intro ); ?></h2>
                <?php endif; ?>

                <div class="button-box">
                    <?php if ( $button_1_text && $button_1_link ): ?>
                        <a href="<?php echo esc_url($button_1_link); ?>" class="amre-btn hero-btn">
                            <span><?php echo esc_html($button_1_text); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if ( $button_2_text && $button_2_link ): ?>
                        <a href="<?php echo esc_url($button_2_link); ?>" class="amre-btn white-btn">
                            <span><?php echo esc_html($button_2_text); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if ( $button_3_text && $button_3_link ): ?>
                        <a href="<?php echo esc_url($button_3_link); ?>" class="amre-btn hero-btn">
                            <span><?php echo esc_html($button_3_text); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section><!-- .home-hero -->

<!-- About -->
<section class="container-fw home-about light-bg">
    <div class="container">
        <div class="align-center">
            <h2>About</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 about-content">
            <?php 
                $about_content = get_field('about'); 
                if( $about_content ):
                    echo wp_kses_post($about_content); 
                endif; 
                ?>
            </div>
            <div class="col-md-6 about-image">
            <?php 
            $about_image = get_field('about_image');
            if ($about_image) {
                $image_url = $about_image['url'];
                $alt_text = !empty($about_image['alt']) ? $about_image['alt'] : 'Ashly Merced Real Estate NY'; // Fallback alt text if none is provided
                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '">';
            }
            ?>
            </div>
        </div><!-- .row -->
    </div>
</section>

<!-- Listings -->
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
    <section class="container-fw home-recent-listings light-bg">
        <div class="container">
            <div class="align-center">
                <h2>Latest Listings</h2>
            </div>
        </div>
        <div class="container">

            <div class="row">
                <?php while ( $recent_listings->have_posts() ) : $recent_listings->the_post(); ?>
                    <div class="col-sm-12 col-md-4 mb-4">
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
            </div><!-- .row -->
        </div> <!-- .container -->
    </section>
<?php 
    endif;
    wp_reset_postdata();
endif;
?>

<!-- Services -->
<section class="cta">
    <?php get_template_part('template-parts/services'); ?>
</section>
<!-- Testimonial Slider -->
<section class="testimonials">
    <?php get_template_part('template-parts/testimonial-slider'); ?>
</section>

<section class="cta">
    <?php get_template_part('template-parts/call-to-action'); ?>
</section>
<section class="container-fw gallery-bg">
    <?php while (have_posts()) : the_post();
        $images = get_field('hp_gallery');
        if ($images) : ?>
            <div class="owl-carousel hp-slider owl-theme hp-gallery-carousel">
                <?php foreach ($images as $image) : ?>
                    <div class="item">
                        <img src="<?php echo wp_get_attachment_image_url( $image['id'], 'hp-gallery-img' ); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                <?php endforeach; ?>
            </div>
    <?php endif;
    endwhile; ?>
</section>
<?php
get_footer();
