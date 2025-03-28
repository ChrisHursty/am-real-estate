<?php

/**
 * Portfolio Archive
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
?>

<section class="container-fw hero-title-area" style="background-image: url('<?php echo the_field('portfolio_bg_image', 'option'); ?>');">
    <div class="container">
        <div class="row">
            <div class="col-12 align-center text-center">
                <h1><?php the_field('portfolio_title', 'option'); ?></h1>
            </div>
        </div>
</section>

<section class="container">
    <div class="row">
        <div class="col-12 text-center mt30">
            <h3>Click or hover an image</h3>
        </div>

        <?php
        $args = array(
            'post_type'      => 'portfolio',
            'hierarchical'   => true,
            'posts_per_page' => -1,
            'orderby'        => 'rand',
            'order'          => 'ASC'
        );
        $portfolio_query = new WP_Query($args);

        if ($portfolio_query->have_posts()) {
            echo '<div class="portfolio-grid">';

            while ($portfolio_query->have_posts()) {
                $portfolio_query->the_post();
                $thumbnail_id = get_post_meta(get_the_ID(), '_portfolio_thumbnail_id', true);

                if ($thumbnail_id) {
                    $thumbnail_url = wp_get_attachment_url($thumbnail_id);

                    echo '<div class="portfolio-item">';
                    echo '<a href="' . esc_url(get_permalink()) . '">';
                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title()) . '">';
                    echo '<div class="portfolio-overlay">';
                    echo '<span class="portfolio-title">' . get_the_title() . '</span>';
                    echo '</div>'; // .portfolio-overlay
                    echo '</a>';
                    echo '</div>'; // .portfolio-item
                }
            }

            echo '</div>'; // .portfolio-grid
            wp_reset_postdata();
        }
        ?>

    </div><!-- .row -->
</section>




<?php
get_footer();
