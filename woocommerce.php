<?php

/**
 * The template for all WooCommerce content.
 * Fallback for shop / product / cart / checkout / account pages
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
?>
<div class="title-header"></div>

<section class="container">
    <div class="row">
        <!-- Content Area -->
        <div class="col-md-12 align-center">
            <div class="content-area">
                <?php
                    woocommerce_content();
                ?>
            </div>
        </div>
    </div><!-- .row -->
</section>



<?php
get_footer();
