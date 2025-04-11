<?php

/**
 * Template Name: Pricing Page
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); ?>

<section class="title-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="container content-bg slim-page">
    <div class="row">
        <div class="col-12 align-center content">
            <div class="content-area">
                <?php the_content(); ?>
            </div>
        </div>
    </div><!-- .row -->
</section>
<section class="pricing">
    <?php get_template_part('template-parts/pricing'); ?>
</section>



<?php
get_footer();
