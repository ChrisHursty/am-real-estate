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

    <!-- Hero content -->
    <div class="hero-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 align-center text-center text-container">
                    <?php 
                    $hero_text_background = get_field('hero_text_background_shape');
                    if ($hero_text_background) {
                        $image_url = $hero_text_background['url'];
                        $alt_text = !empty($hero_text_background['alt']) ? $hero_text_background['alt'] : 'Background Shape';
                        echo '<div class="hero-light" style="background-image: url(\'' . esc_url($image_url) . '\');"></div>';
                    }
                    ?>
                    <!-- <?php if ( $hero_intro ): ?>
                        <h2 class="intro"><?php echo wp_kses_post( $hero_intro ); ?></h2>
                    <?php endif; ?> -->
                </div>
            </div>
        </div>
    </div>
</section><!-- .home-hero -->

<!-- About -->
<section class="container-fw home-about">
    <div class="container">
        <div class="text-center">
            <h2>A.M. Real Estate Team</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 about-content align-center">
                <?php 
                $about_content = get_field('about'); 
                if ($about_content) {
                    echo wp_kses_post($about_content); 
                }
                ?>
                <div class="align-center text-center">
                    <a class="amre-btn" href="/contact">
                        <span>Contact Us</span>
                    </a>
                </div>
            </div>
        </div><!-- .row -->
    </div>
</section>

<!-- Blog -->
<section class="container-fw home-recent-blogs border-top">
    <div class="container">
        <h2>Blog &amp; News</h2>
    </div>
    <div class="container">
        <!-- Blog Search Bar -->
        <div class="row">
            <div class="col-md-12">
                <div class="blog-search">
                    <p class="search-label">Search our blogs</p>
                    <form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url('/') ); ?>">
                        <!-- Hidden input to search only blog posts -->
                        <input type="hidden" name="post_type" value="post" />
                        
                        <label class="search-icon">
                            <i class="fas fa-search"></i>
                        </label>
                        
                        <!-- Actual search input -->
                        <input type="search" name="s" class="search-field" placeholder="Search" 
                            value="<?php echo get_search_query(); ?>" />
                        
                        <!-- Optional submit button if you don't want to rely on pressing Enter -->
                        <!-- <button type="submit" class="search-submit">Search</button> -->
                    </form>
                </div>
            </div>
         </div>
    </div><!-- .container -->
    <div class="container">
        <div class="row">
            <!-- Owl Carousel wrapper -->
            <div class="owl-carousel blog-posts-carousel">
                <?php
                // Query up to 12 posts so user can scroll multiple pages of 4
                $recent_blogs = new WP_Query(array(
                    'post_type'      => 'post',
                    'posts_per_page' => 12,
                    'order'          => 'ASC',
                    'orderby'        => 'menu_order',
                    'post_status'    => 'publish'
                ));

                if ( $recent_blogs->have_posts() ) :
                    while ( $recent_blogs->have_posts() ) :
                        $recent_blogs->the_post(); ?>
                        
                        <!-- Each slide is a .item -->
                        <div class="item">
                            <div class="blog-card">
                                <!-- Featured Image -->
                                <a href="<?php the_permalink(); ?>" class="blog-image-link">
                                    <?php 
                                    if ( has_post_thumbnail() ) {
                                        // Medium size is ~300px wide by default
                                        the_post_thumbnail('medium', array('class' => 'blog-card-img'));
                                    } else {
                                        // Fallback image
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

                                <!-- Excerpt -->
                                <div class="archive-card-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div><!-- .item -->
                        
                    <?php endwhile; 
                    wp_reset_postdata();
                else :
                    echo '<div class="item"><p>No recent blog posts found.</p></div>';
                endif; ?>
            </div><!-- .owl-carousel -->

            <!-- "View All" Button -->
            <div class="align-center mt-3">
                <?php 
                // Typically /blog or page_for_posts
                $blog_page_url = get_permalink( get_option('page_for_posts') );
                if ( ! $blog_page_url ) {
                    $blog_page_url = home_url('/blog');
                }
                ?>
                <a class="amre-btn" href="<?php echo esc_url( $blog_page_url ); ?>">
                    <span>Read More</span>
                </a>
            </div><!-- .align-center -->
        </div><!-- .row -->
    </div><!-- .container -->
</section>

<section class="pricing">
    <?php get_template_part('template-parts/newsletter'); ?>
</section>
<?php
get_footer();
