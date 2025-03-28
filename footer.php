<?php

/**
 * The footer for our theme
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-2 align-center footer-logo">
                <?php
                $footer_logo = get_theme_mod('footer_logo');
                if ($footer_logo) {
                    echo '<img src="' . esc_url($footer_logo) . '" alt="' . get_bloginfo('name') . ' Footer Logo">';
                } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-8 align-center footer-text">
                <?php
                $footer_text = get_theme_mod('footer_text');
                if ($footer_text) {
                    echo '<div class="footer-text">' . ($footer_text) . '</div>';
                } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-8 align-center footer-socials">
                <?php
                if (have_rows('social_profiles', 'option')) {
                    while (have_rows('social_profiles', 'option')) {
                        the_row();
                        $profile_url         = get_sub_field('profile_url');
                        $icon_type           = get_sub_field('icon_type');
                        $icon_color          = get_sub_field('icon_color');
                        $social_network_name = get_sub_field('social_network_name'); // Assume a field to get the name of the social network

                        // Use the social network name in the aria-label for better accessibility
                        echo '<a href="' . esc_url($profile_url) . '" style="color:' . esc_attr($icon_color) . ';" target="_blank" rel="noopener noreferrer" aria-label="Follow us on ' . esc_attr($social_network_name) . '">';

                        if ($icon_type === 'fontawesome') {
                            $fontawesome_class = get_sub_field('fontawesome_class');
                            echo '<i class="fab ' . esc_attr($fontawesome_class) . '" aria-hidden="true"></i>';
                        } else if ($icon_type === 'svg') {
                            $svg_icon_url = get_sub_field('svg_icon');
                            // Add an alt tag to the img element
                            echo '<img src="' . esc_url($svg_icon_url) . '" alt="' . esc_attr($social_network_name) . ' Icon" style="fill:' . esc_attr($icon_color) . ';">';
                        }

                        echo '</a>';
                    }
                }
                ?>
            </div>

        </div>
        <div class="row">
            <div class="col align-center">
                <?php
                $copyright_text = get_theme_mod('footer_copyright_text');
                if ($copyright_text) {
                    echo '<div class="copyright-text">' . $copyright_text . '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>