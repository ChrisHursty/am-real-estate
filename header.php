<?php
/**
 * The header for our theme
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <meta name="description" content="<?php echo esc_attr(get_field('meta_description', 'option')); ?>">
    <?php wp_head(); ?>
    <meta property="fb:app_id" content="1391362941486769" />
    <meta name="facebook-domain-verification" content="w3x2ukvsqcbn2elzi15xgxvnaxu36z" />
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7028927369766320"
     crossorigin="anonymous"></script>
</head>

<body <?php body_class(); ?>>
    <?php do_action('wp_body_open'); ?>
    <div class="site" id="page">

        <!-- ******************* The Navbar Area ******************* -->
        <header id="masthead" class="site-header">
            <div class="container d-flex align-items-center justify-content-between">

                <!-- === Left Menu (Desktop Only) === -->
                <nav class="nav-left desktop-only" aria-label="Left Menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header_left',
                        'menu_id'        => 'left-menu',
                        'container'      => false,
                    ));
                    ?>
                </nav>

                <!-- === Logo (always visible, centered on desktop) === -->
                <div class="site-branding text-center">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '" rel="home">
                                <img src="' . esc_url(get_template_directory_uri() . '/dist/images/default-logo.svg') . '" 
                                     alt="' . esc_attr(get_bloginfo('name')) . '">
                              </a>';
                    }
                    ?>
                </div>

                <!-- === Right Menu (Desktop Only) === -->
                <nav class="nav-right desktop-only" aria-label="Right Menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header_right',
                        'menu_id'        => 'right-menu',
                        'container'      => false,
                    ));
                    ?>
                </nav>

                <!-- === Hamburger Toggle (Mobile Only) === -->
                <button class="menu-toggle mobile-only" aria-controls="primary-menu" aria-expanded="false">
                    <span class="hamburger fas fa-bars"></span>
                </button>
            </div>

            <!-- === Mobile Navigation Slide-out === -->
            <nav role="navigation" aria-label="Mobile Menu" id="site-navigation" class="main-navigation mobile-only">
                <button class="menu-close fas fa-times"></button>
                <?php
                // This is the mobile menu location
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'menu-list',
                    'container'      => false,
                ));
                ?>

                <!-- Hamburger Socials (Mobile Only) -->
                <div class="social-media">
                    <?php
                    if (have_rows('social_profiles', 'option')) {
                        while (have_rows('social_profiles', 'option')) {
                            the_row();
                            $profile_url = get_sub_field('profile_url');
                            $icon_type   = get_sub_field('icon_type');
                            $icon_color  = get_sub_field('icon_color');

                            echo '<a href="' . esc_url($profile_url) . '" 
                                      style="color:' . esc_attr($icon_color) . ';" 
                                      target="_blank" 
                                      rel="noopener noreferrer">';

                            if ($icon_type === 'fontawesome') {
                                $fontawesome_class = get_sub_field('fontawesome_class');
                                echo '<i class="fab ' . esc_attr($fontawesome_class) . '"></i>';
                            } else if ($icon_type === 'svg') {
                                $svg_icon_url = get_sub_field('svg_icon');
                                echo '<img src="' . esc_url($svg_icon_url) . '" alt="Social Icon" 
                                           style="fill:' . esc_attr($icon_color) . ';">';
                            }

                            echo '</a>';
                        }
                    }
                    ?>
                </div>
            </nav>
        </header>

        <div class="header-spacer"></div>
