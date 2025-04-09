<?php
/**
 * The template for displaying all neighborhoods (archive)
 *
 * @package AMRE
 */

get_header(); ?>

<div class="container archive-neighborhoods-container">
    
    <header class="mb-4">
        <h1 class="archive-title">
            <?php post_type_archive_title(); // Will display "Neighborhoods" ?>
        </h1>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
                
                <div class="col-md-4 mb-4">
                    <div class="neighborhood-card">
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'img-fluid mb-2']); ?>
                            </a>
                        <?php endif; ?>
                        
                        <h2 class="neighborhood-card-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        
                        <div class="neighborhood-card-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-2">
                            <?php _e('Learn More', 'amre'); ?>
                        </a>
                    </div>
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
