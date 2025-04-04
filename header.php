<?php
/**
 * The header for our theme
 * 
 * @package AMRE WP
 */
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
</head>

<body <?php body_class(); ?>>
<?php do_action('wp_body_open'); ?>
<div class="site" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <header id="masthead" class="site-header">

        <!-- === 1. Large Desktop Header (≥1176px) === -->
        <div class="header-desktop-large">
            <div class="container d-flex align-items-center justify-content-between">
                <!-- Left Menu -->
                <nav class="nav-left" aria-label="Left Menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header_left',
                        'menu_id'        => 'left-menu',
                        'container'      => false,
                    ));
                    ?>
                </nav>

                <!-- Site Branding -->
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

                <!-- Right Menu -->
                <nav class="nav-right" aria-label="Right Menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header_right',
                        'menu_id'        => 'right-menu',
                        'container'      => false,
                    ));
                    ?>
                </nav>
            </div>
        </div>

        <!-- === 2. Medium Desktop Header (1025px–1175px) === -->
        <div class="header-desktop-medium">
            <div class="container d-flex flex-column align-items-center">
                
                <!-- Branding on top row -->
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

                <!-- Menus below in one row. 
                     We can do nav-left and nav-right side by side in a single row, etc. -->
                <div class="d-flex justify-content-center align-items-center mt-2 nav-row">
                    <nav class="nav-left" aria-label="Left Menu">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'header_left',
                            'menu_id'        => 'left-menu-med',
                            'container'      => false,
                        ));
                        ?>
                    </nav>
                    <nav class="nav-right" aria-label="Right Menu">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'header_right',
                            'menu_id'        => 'right-menu-med',
                            'container'      => false,
                        ));
                        ?>
                    </nav>
                </div>
            </div>
        </div>

        <!-- === 3. Mobile Hamburger (below 1025px) === -->
        <div class="header-mobile mobile-only">
            <div class="container d-flex align-items-center justify-content-between">
                <!-- Logo or anything you like on mobile -->
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

                <!-- Hamburger Toggle -->
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="hamburger fas fa-bars"></span>
                </button>
            </div>

            <!-- Mobile Navigation Slide-out -->
            <nav role="navigation" aria-label="Mobile Menu" id="site-navigation" class="main-navigation">
                <button class="menu-close fas fa-times"></button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'menu-list',
                    'container'      => false,
                ));
                ?>
                <!-- Socials, etc. -->
            </nav>
        </div>

    </header>
    <div class="header-spacer"></div>
