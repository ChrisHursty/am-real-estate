<?php
/**
 * Custom WooCommerce shop archive → blog-style grid
 */

defined( 'ABSPATH' ) || exit;
get_header(); ?>

<section class="container content-bg blog-archive title-header">
  <div class="row">

    <?php if ( woocommerce_product_loop() ) : 
      while ( have_posts() ) : the_post();
        // this will pull in content-product.php from your theme/woocommerce/
        wc_get_template_part( 'content', 'product' );
      endwhile;
    else :
      // no products found
      echo '<p>' . esc_html__( 'Sorry, no tours matched your criteria.', 'amre' ) . '</p>';
    endif; ?>

  </div><!-- .row -->
</section>

<?php get_footer();
