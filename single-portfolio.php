<?php

/**
 * Single Portfolio
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
?>

<!-- Progress Bar Container -->
<div id="progressBarContainer">
    <div id="progressBar"></div>
</div>

<?php
// Featured Img BG, Title and Genre
if (is_singular('portfolio')) {
    $post_id            = get_the_ID();
    $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
    $genre_terms        = get_the_terms($post_id, 'genre');

    if ($featured_image_url) {
        echo '<section class="container-fw hero-title-area" style="background-image: url(' . esc_url($featured_image_url) . ');">';
        echo '<div class="container"><div class="row"><div class="align-center text-center">';
        echo '<h1>' . get_the_title() . '</h1></div>';

        if (!empty($genre_terms) && !is_wp_error($genre_terms)) {
            echo '<div class="genre-container">';
            foreach ($genre_terms as $genre_term) {
                $genre_link = get_term_link($genre_term->term_id, 'genre');
                if (!is_wp_error($genre_link)) {
                    echo '<div class="text-center genre-link"><a href="' . esc_url($genre_link) . '">' . esc_html($genre_term->name) . '</a></div>';
                }
            }
            echo '</div>';
        }

        echo '</div></div></section>';
    }
}

?>

<section class="container content-bg">
    <div class="row">
        <div class="col-12 col-md-8 content">
            <div class="content-area">
                <div class="single-port-intro">
                    <?php echo wp_kses_post(get_field('portfolio_intro')); ?>
                </div>
                <?php the_content(); ?>
            </div>
        </div>

        <div class="col-12 col-md-4 sidebar">
            <div class="portfolio-details">
                <h3>Project Details - At a Glance</h3>
                <?php
                if (have_rows('portfolio_details')) {
                    echo '<div class="portfolio-details-list">';
                    while (have_rows('portfolio_details')) {
                        the_row();
                        $description = get_sub_field('description');
                        $answer = get_sub_field('answer');

                        if ($description && $answer) {
                            echo '<div class="portfolio-detail">';
                            echo '<strong>' . esc_html($description) . ':</strong> ' . esc_html($answer);
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div><!-- .row -->
</section>
<section class="container-fw">
    <div class="row">
        <div class="col-12 text-center">
            <h3>Click an Image to magnify</h3>
            <?php while (have_posts()) : the_post();
                $images = get_field('portfolio_images');
                if ($images) : ?>
                    <div class="owl-carousel portfolio-carousel">
                        <?php foreach ($images as $image) : ?>
                            <div class="item">
                                <!-- Link for Magnific-Popup -->
                                <a href="<?php echo esc_url($image['url']); ?>" title="<?php echo esc_attr($image['caption']); ?>">
                                    <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
            <?php endif;
            endwhile; ?>
        </div>
    </div>
</section>



<?php
get_footer();
