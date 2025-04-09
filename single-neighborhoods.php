<?php
/**
 * The template for displaying single neighborhoods
 *
 * @package AMRE
 */

get_header(); ?>
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</section>

<div class="container single-neighborhood-container">
    <div class="row">
        <div class="col-12 align-center">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
                <!-- Featured Image / Banner -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="neighborhood-hero text-center">
                        <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                    </div>
                <?php endif; ?>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 align-center slim-page">
            <!-- Neighborhood Content -->
            <div class="neighborhood-content">
                <?php the_content(); ?>
            </div>

            <!-- Excerpt / Summary if you want -->
            <?php if ( has_excerpt() ) : ?>
                <div class="neighborhood-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>

            <!-- If needed, custom fields or meta data can go here -->
            
            <!-- For example, you might have ACF fields: population, main attractions, etc. -->
            <?php if ( function_exists('the_field') ) : ?>
                <div class="neighborhood-extra-info">
                    <p><strong>Population:</strong> <?php the_field('population'); ?></p>
                    <p><strong>Main Attractions:</strong> <?php the_field('main_attractions'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>
