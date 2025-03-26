<?php
// Access the customizer values
$heading                 = get_theme_mod('heading', '');
$text                    = get_theme_mod('text', '');
$button_text             = get_theme_mod('button_text', '');
$button_url              = get_theme_mod('button_url', '');
$background_color        = get_theme_mod('background_color', '#ffffff'); // Default white
$text_color              = get_theme_mod('text_color', '#000000'); // Default black
$button_background_color = get_theme_mod('button_background_color', '#000000'); // Default black
$button_text_color       = get_theme_mod('button_text_color', '#ffffff'); // Default white

if ($heading || $text || $button_text) : ?>
    <section class="container-fw call-to-action" style="background-color: #<?php echo esc_attr($background_color); ?>; color: <?php echo esc_attr($text_color); ?>;">
        <div class="container">
            <div class="row cta-container">
                <div class="col-12 col-md-8 align-center">
                    <?php if ($heading) : ?>
                        <h2 class="cta-heading" style="color: <?php echo esc_attr($text_color); ?>;"><?php echo esc_html($heading); ?></h2>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <p class="cta-text"><?php echo esc_html($text); ?></p>
                    <?php endif; ?>

                    <?php if ($button_text && $button_url) : ?>
                        <a href="<?php echo esc_url($button_url); ?>" class="cta-button" style="background-color: <?php echo esc_attr($button_background_color); ?>;">
                            <span style="color: <?php echo get_theme_mod('button_text_color'); ?>">
                                <?php echo esc_html($button_text); ?><i style="margin-left: 6px;"class="fas fa-external-link-alt"></i>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            </div><!--  /.row -->
        </div><!--  /.container -->
    </section>
<?php endif; ?>
