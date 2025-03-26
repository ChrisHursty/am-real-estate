<section class="container-fw">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <?php 
                // Fetching the logo from ACF options
                $pre_footer_logo = get_field('pre_footer_logo', 'option'); 
                if ($pre_footer_logo): ?>
                    <img src="<?php echo esc_url($pre_footer_logo['url']); ?>" alt="<?php echo esc_attr($pre_footer_logo['alt']); ?>" class="img-fluid">
                <?php endif; ?>
            </div>

            <div class="col-sm-12 col-md-6">
                <?php 
                // Fetching the photo from ACF options
                $pre_footer_photo = get_field('pre_footer_photo', 'option'); 
                if ($pre_footer_photo): ?>
                    <img src="<?php echo esc_url($pre_footer_photo['url']); ?>" alt="<?php echo esc_attr($pre_footer_photo['alt']); ?>" class="img-fluid">
                <?php endif; ?>
            </div>
        </div><!-- .row -->
    </div>
</section>