<?php
/**
 * Template Name: Grid, Repeater Template
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

<!-- Grid Repeater -->
<section class="container-fw content-bg">
    <div class="container">
        <div class="row">
            <?php if (have_rows('grid_repeater')) : ?>
                <?php
                $total_items = count(get_field('grid_repeater')); // Count the total repeater items
                $col_class = 'col-md-12'; // Default to full-width

                // Determine column class based on the number of items
                if ($total_items == 2) {
                    $col_class = 'col-sm-12 col-md-6';
                } elseif ($total_items == 3) {
                    $col_class = 'col-sm-12 col-md-4';
                } elseif ($total_items >= 4) {
                    $col_class = 'col-sm-12 col-md-4';
                }
                ?>

                <?php while (have_rows('grid_repeater')) : the_row();
                    $image = get_sub_field('image');
                    $title = get_sub_field('heading');
                    $description = get_sub_field('description');
                    $button_text = get_sub_field('button_text');
                    $button_link = get_sub_field('button_link');

                    // Safety check for image URL
                    $icon_url = isset($icon['url']) ? $icon['url'] : ''; 
                ?>
                    <div class="grid-item <?php echo esc_attr($col_class); ?>">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="service-image">
                        <?php endif; ?>
                        <div class="grid-content">
                            <?php if ($title) : ?>
                                <h2 class="grid-title"><?php echo esc_html($title); ?></h2>
                            <?php endif; ?>
                            <?php if ($description) : ?>
                                <p class="grid-description"><?php echo esc_html($description); ?></p>
                            <?php endif; ?>
                            <?php if ($button_text && $button_link) : ?>
                                
                                <a class="grid-btn" href="<?php echo esc_url($button_link); ?>">
                                    <span><?php echo esc_html($button_text); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="align-center">No grid available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <a class="amre-btn align-center" target="_blank" rel="nofollow noopener" href="https://johannaclark.glossgenius.com/"><span>Book An Appointment<i style="margin-left: 6px;" class="fas fa-external-link-alt"></i></span></a>
        </div>
    </div>
    
</section>



<?php
get_footer();
?>
