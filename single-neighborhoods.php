<?php
/**
 * The template for displaying single neighborhoods
 *
 * @package AMRE
 */

get_header();
$distance   = get_field('distance_from_manhattan');
$map_embed  = get_field('google_map_embed_code'); 

?>
<section class="title-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
            <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</section>

<div class="container single-neighborhood-container slim-page">
    <div class="row">
        <div class="col-12 align-center">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
                <!-- Featured Image / Banner -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="neighborhood-hero text-center">
                        <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
                    </div>
                <?php endif; ?>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>
<div class="container neighborhood-container slim-page">
    <div class="row">
        <div class="col-sm-12 col-md-6 map">
            <?php echo $map_embed; ?>
        </div>
        <div class="col-sm-12 col-md-6 info">
            <h2><?php the_title(); ?></h2>
            <p><strong>Distance from Manhattan:</strong> <?php echo $distance; ?></p>
        </div>
    </div>
</div>
<div class="container neighborhood-content slim-page">
    <div class="row">
        <div class="col-md-12 align-center">
            <!-- Neighborhood Content -->
            <div class="">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
