<?php

/**
 * Page
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
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

<section class="container">
    <div class="row">
        <!-- Content Area -->
        <div class="col-md-12 align-center slim-page">
            <div class="content-area">
                <?php
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </div><!-- .row -->
</section>



<?php
get_footer();