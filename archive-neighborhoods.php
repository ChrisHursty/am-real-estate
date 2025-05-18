<?php
/**
 * The template for displaying all neighborhoods (archive)
 *
 * @package AMRE
 */

get_header(); ?>
<section class="title-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1><?php post_type_archive_title();?></h1>
            </div>
        </div>
    </div>
</section>

<div class="container archive-neighborhoods-container">
    <?php if ( have_posts() ) : ?>
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
                
                <div class="col-md-3 col-sm-12 neighborhood-card">
                    
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="image-container">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'img-fluid card-img']); ?>
                            </a>
                        </div>
                        
                    <?php endif; ?>
                    
                    <h2 class="neighborhood-card-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    
                    <div class="neighborhood-card-excerpt">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="neighborhood-btn">
                        <?php _e('Read More →', 'amre'); ?>
                    </a>
                </div><!-- .col -->
                
            <?php endwhile; ?>
        </div><!-- .row -->

        <!-- Pagination -->
        <div class="archive-pagination">
            <?php the_posts_pagination(); ?>
        </div>

    <?php else : ?>
        <p><?php _e('No neighborhoods found.', 'amre'); ?></p>
    <?php endif; ?>

</div><!-- .container -->

<?php get_footer(); ?>
