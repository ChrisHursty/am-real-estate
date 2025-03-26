<?php

/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @package AMRE WP
 * @since 1.0.0
 */

get_header();

// Retrieve search query
$search_query = get_search_query();

// Featured Image and Title for Search Page
$default_image_url = get_template_directory_uri() . 'dist/images/default-hero-img.webp';
$background_image_url = $default_image_url; // Using default image for search page

echo '<section class="container-fw hero-title-area" style="background-image: url(' . esc_url($background_image_url) . ');">';
echo '<div class="container"><div class="row"><div class="align-center text-center">';
echo '<h1>Search Results</h1>';
echo '</div></div></div></section>';
?>

<section class="container content-bg slim-page">
    <div class="row">
        <div class="align-center content">
            <div class="content-area">
                <h2 class="text-center">Results for: <?php echo esc_html($search_query); ?></h2>

                <?php if (have_posts()) : ?>
                    <div class="search-results-list">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="search-result-item">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="search-result-snippet"><?php the_excerpt(); ?></div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="text-center">
                        <p>No results found for "<?php echo esc_html($search_query); ?>". Please try again with different keywords.</p>
                        <div class="search-container">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div><!-- .row -->
</section>

<?php
get_footer();
?>