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

                <!-- <div class="button-box">
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
                </div> -->
            </div>
        </div>
    </div>
</section><!-- .home-hero -->

<!-- About -->
<section class="container-fw home-about">
    <div class="container">
        <div class="align-center">
            <h2 class="upper">AM Real Estate Team</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 about-content">
            <?php 
                $about_content = get_field('about'); 
                if( $about_content ):
                    echo wp_kses_post($about_content); 
                endif; 
                ?>
                <div class="align-center text-center">
                    <a class="amre-btn" href="/contact">
                        <span>Contact Us</span>
                    </a>
                </div>
                
            </div>
            <div class="col-md-4 about-image">
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

<!-- Blog -->
<section class="container-fw home-recent-blogs">
    <div class="container">
        <div class="align-center">
            <h2 class="upper">From The Blog</h2>
        </div>
        <div class="row">
            <?php
            // Query for the 4 most recent blog posts
            $recent_blogs = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'order'          => 'DESC',
                'orderby'        => 'date'
            ));

            if ( $recent_blogs->have_posts() ) :
                while ( $recent_blogs->have_posts() ) : 
                    $recent_blogs->the_post(); 
                    ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="blog-card">
                            <!-- Featured Image -->
                            <a href="<?php the_permalink(); ?>" class="blog-image-link">
                                <?php 
                                if ( has_post_thumbnail() ) {
                                    // Medium size is typically ~300px wide. 
                                    // We'll square it in CSS.
                                    the_post_thumbnail('medium', array('class' => 'blog-card-img'));
                                } else {
                                    // Fallback image (optional)
                                    echo '<img src="'. esc_url(get_template_directory_uri() . '/images/blog-placeholder.jpg') .'" alt="Placeholder" class="blog-card-img" />';
                                }
                                ?>
                            </a>
                            <!-- Title -->
                            <h4 class="blog-card-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                        </div>
                    </div>
                <?php 
                endwhile; 
                wp_reset_postdata();
            else : 
                // Optional: Show a message if no posts
                echo '<div class="col-12"><p>No recent blog posts found.</p></div>';
            endif;
            ?>
        </div><!-- .row -->

        <!-- "View All" Button -->
        <div class="align-center mt-3">
            <?php 
            // Typically /blog or page_for_posts:
            $blog_page_url = get_permalink( get_option('page_for_posts') );
            if ( ! $blog_page_url ) {
                // Fallback if no static blog page is set
                $blog_page_url = home_url('/blog');
            }
            ?>
            <a class="amre-btn" href="<?php echo esc_url( $blog_page_url ); ?>">
                <span>Read More</span>
            </a>
        </div>
    </div><!-- .container -->
</section>
<section class="pricing">
    <?php get_template_part('template-parts/newsletter'); ?>
</section>
<?php
get_footer();
