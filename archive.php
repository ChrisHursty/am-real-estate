<?php

/**
 * Blog Archive
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
?>
<section class="title-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1><?php the_field('archive_title', 'option'); ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="container content-bg blog-archive">
    <div class="row">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-md-3 col-sm-12 archive-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', ['class' => 'img-fluid card-img']); ?>
                        </a>
                    <?php endif; ?>
                    <h2 class="archive-card-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="archive-card-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="archive-btn">
                        <?php _e('Read More →', 'amre'); ?>
                    </a>
                </div>
            <?php endwhile;
        else : ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif;
        wp_reset_postdata(); ?>

    </div><!-- .row -->
</section>
<?php get_footer(); ?>