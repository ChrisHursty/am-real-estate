<section class="container-fw services-container light-bg">
    <div class="container">
        <div class="align-center">
            <h2>Services</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php if (have_rows('services')) : ?>
                <?php while (have_rows('services')) : the_row();
                    // Your sub fields go here
                    $icon = get_sub_field('icon');
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                ?>
                    <div class="service-item" style="background-image: url('<?php echo esc_url($icon); ?>');">
                        <div class="service-content">
                            <h2 class="service-title"><?php echo esc_html($title); ?></h2>
                            <p class="service-description"><?php echo esc_html($description); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <a class="amre-btn align-center" href="/services"><span>View All Of Our Services</span></a>
    </div>
</section>