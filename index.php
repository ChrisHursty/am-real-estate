<?php
/**
 * The main template file for Hursty WP
 */

get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col">
        <h1>Index.PHP</h1>
    </div>
    <!-- more columns -->
  </div>
</div>

    <div class="cta">
        <?php get_template_part('template-parts/call-to-action'); ?>
    </div>
    
<?php
get_footer();
