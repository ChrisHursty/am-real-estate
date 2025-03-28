<?php
/**
 * AMRE WP functions and definitions
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Customizer
require_once get_template_directory() . '/inc/theme-customizer.php';
// Theme Options
require_once get_template_directory() . '/inc/theme-options.php';
// Custom Post Types
require_once get_template_directory() . '/inc/cpts.php';
// Widgets
require get_template_directory() . '/inc/widgets.php';

function amre_wp_theme_setup() {
    // Add theme support for Automatic Feed Links
    add_theme_support( 'automatic-feed-links' );

    // Add theme support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );
    // Register a new image size for the sidebar
    // 150px wide x 150px tall, hard crop
    add_image_size('sidebar-thumb', 150, 150, true);

    // Register Navigation Menu
    function amre_register_menus() {
        register_nav_menus(array(
          'header_left'  => __('Header Left Menu', 'amre-wp'),
          'header_right' => __('Header Right Menu', 'amre-wp'),
          'primary'      => __('Mobile Primary Menu', 'amre-wp'),
        ));
      }
      add_action('init', 'amre_register_menus');

    // Add theme support for HTML5 and Title Tag
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'custom-fields' ) );
    add_theme_support( 'title-tag' );

    // Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    add_image_size('portfolio_slider', 810, 810, true); // true for hard crop mode
}

add_action( 'after_setup_theme', 'amre_wp_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function amre_wp_scripts_styles() {
    // Enqueue Owl Carousel & Magnific Popup Stuff
    wp_enqueue_style('owl-carousel-css', get_template_directory_uri() . '/library/owl-carousel/css/owl.carousel.min.css');
    wp_enqueue_style('magnific-popup-css', get_template_directory_uri() . '/library/magnific-popup/magnific-popup.css');
    wp_enqueue_style('owl-carousel-theme', get_template_directory_uri() . '/library/owl-carousel/css/owl.theme.default.min.css');
    wp_enqueue_script('magnific-popup-js', get_template_directory_uri() . '/library/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), null, true);
    wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/library/owl-carousel/js/owl.carousel.min.js', array('jquery'), '2.3.4', true);
    
    // FontAwesome
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/library/font-awesome/font-awesome-5-15-4l.min.css');

    // Theme CSS
    wp_enqueue_style( 'amre-wp-style', get_template_directory_uri() . '/dist/css/main.min.css', array(), '1.0.0', 'all');

    // Theme JS
    wp_enqueue_script('amre-wp-main-js', get_template_directory_uri() . '/dist/js/main.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('amre-smart-header-js', get_template_directory_uri() . '/dist/js/smart-header.min.js', array(), '1.0.0', true);

    // Check if we are on a single post or the single-portfolio.php template
    if (is_single() && (is_singular('post') || is_singular('portfolio'))) {
        // Enqueue the progress-bar.js script
        wp_enqueue_script('my-progress-bar', get_template_directory_uri() . '/dist/js/progress-bar.min.js', array(), '1.0.0', true);
    }

    if (is_singular('portfolio')) {
        wp_enqueue_script('single-portfolio-js', get_template_directory_uri() . '/js/single-portfolio.js', array('jquery', 'owl-carousel-js', 'magnific-popup-js'), '1.0.0', true);
    }
    // Register and Enqueue a Script
    // wp_enqueue_script( 'amre-wp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20201208', true );
}

add_action( 'wp_enqueue_scripts', 'amre_wp_scripts_styles' );

function amre_wp_admin_styles() {
    wp_enqueue_style('amre-wp-admin-styles', get_template_directory_uri() . '/dist/css/admin-styles.min.css');
    wp_enqueue_media();
    wp_enqueue_script('portfolio-thumbnail-uploader', get_template_directory_uri() . '/dist/js/portfolio-thumbnail-uploader.min.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'amre_wp_admin_styles');


// SVG upload compatibility
function custom_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'custom_mime_types');
  
function fix_svg_thumb_display() {
    echo '
      <style>
        td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {
          width: 100% !important;
          height: auto !important;
        }
      </style>
    ';
}
add_action('admin_head', 'fix_svg_thumb_display');

// Customizer CSS
function ccs_custom_css() {
  $hero_btn_bg_color   = get_theme_mod('hero_button_bg_color');
  $hero_btn_text_color = get_theme_mod('hero_button_text_color');
  $cta_btn_bg_color    = get_theme_mod('button_background_color');
  $cta_btn_text_color  = get_theme_mod('button_text_color');
  // ... any other theme_mod values
 
  $custom_css = "
      /* Customizer CSS */
      .hero-button {
          background-color: $hero_btn_bg_color !important;
          border: 1px solid $hero_btn_bg_color !important;
      }

      .hero-button span {
          color: $hero_btn_text_color !important;
      }

      .hero-button:hover {
          background-color: $hero_btn_text_color !important;
          border: 1px solid $hero_btn_text_color !important;
      }

      .hero-button:hover span {
          color: $hero_btn_bg_color !important;
      }

      .cta-button {
          border: 4px solid $cta_btn_text_color !important;
      }

      .cta-button:hover {
          background-color: $cta_btn_text_color !important;
          border: 4px solid $cta_btn_text_color !important;
      }
      .cta-button:hover span {
          color: $cta_btn_bg_color !important;
      }
      /* ... any other custom CSS */
  ";

  wp_add_inline_style( 'ccs-customizer-css', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ccs_custom_css', 20 );

function ccs_enqueue_scripts_and_styles() {
  wp_enqueue_style( 'ccs-customizer-css', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'ccs_enqueue_scripts_and_styles' );

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

// Custom Image for Portfolio Grid
function amre_add_portfolio_thumbnail_meta_box() {
    add_meta_box(
        'portfolio_thumbnail_meta_box', // ID of the meta box
        __('Portfolio Thumbnail Image', 'textdomain'), // Title of the meta box
        'amre_portfolio_thumbnail_meta_box_html', // Callback function to display the meta box
        'portfolio', // Post type
        'side', // Context ('normal', 'side', and 'advanced')
        'low' // Priority
    );
}

add_action('add_meta_boxes', 'amre_add_portfolio_thumbnail_meta_box');

function amre_portfolio_thumbnail_meta_box_html($post) {
    $thumbnail_id = get_post_meta($post->ID, '_portfolio_thumbnail_id', true);
    echo '<input type="hidden" id="portfolio_thumbnail_id" name="portfolio_thumbnail_id" value="' . esc_attr($thumbnail_id) . '">';
    echo '<button id="portfolio_thumbnail_button" class="button">' . __('Select Image', 'amre-wp') . '</button>';
    echo '<p class="description">' . __('Select an image for the portfolio thumbnail.', 'amre-wp') . '</p>';
    // Display the image preview
    if ($thumbnail_id) {
        echo wp_get_attachment_image($thumbnail_id, 'thumbnail');
    }
    // Add nonce for security
    wp_nonce_field('portfolio_thumbnail_nonce_action', 'portfolio_thumbnail_nonce');
}

function amre_save_portfolio_thumbnail($post_id) {
    // Verify the nonce before proceeding.
    if (!isset($_POST['portfolio_thumbnail_nonce']) || !wp_verify_nonce($_POST['portfolio_thumbnail_nonce'], 'portfolio_thumbnail_nonce_action')) {
        return;
    }

    // Check if the current user has permission to edit the post.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['portfolio_thumbnail_id'])) {
        update_post_meta($post_id, '_portfolio_thumbnail_id', sanitize_text_field($_POST['portfolio_thumbnail_id']));
    }
}

add_action('save_post_portfolio', 'amre_save_portfolio_thumbnail');

function register_random_posts_widget() {
    register_widget('Random_Posts_Widget');
    register_widget('Random_Portfolio_Widget');
}
add_action('widgets_init', 'register_random_posts_widget');


function custom_cpt_archive_posts_per_page( $query ) {
    if ( ! is_admin() && $query->is_post_type_archive('hair_salon_service') && $query->is_main_query() ) {
        $query->set( 'posts_per_page', -1 ); // Show all posts
    }
}
add_action( 'pre_get_posts', 'custom_cpt_archive_posts_per_page' );

// Schema
function add_generic_schema() {
    if (is_singular('post')) {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'description' => get_the_excerpt(),
            'url' => get_permalink(),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => [
                '@type' => 'Person',
                'name' => get_the_author()
            ]
        ];
    } else {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => get_the_title(),
            'url' => get_permalink(),
            'description' => get_dynamic_webpage_description()
        ];
    }

    // Output JSON-LD
    echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
}
add_action('wp_head', 'add_generic_schema');

// Description for Schema
function get_dynamic_webpage_description() {
    // Check if Yoast SEO is active and fetch meta description
    if (class_exists('WPSEO_Frontend')) {
        $meta_description = WPSEO_Frontend::get_instance()->metadesc(false);
        if (!empty($meta_description)) {
            return $meta_description;
        }
    }

    // Fallback to the page/post excerpt
    if (is_singular()) {
        $excerpt = get_the_excerpt();
        if (!empty($excerpt)) {
            return $excerpt;
        }
    }

    // Fallback to a default description from Theme Options
    $default_description = get_field('default_description', 'option'); // ACF field
    if (!empty($default_description)) {
        return $default_description;
    }

    // Hardcoded fallback as a last resort
    return "Welcome to AM Real Estate Hair Salon, the best place for expert balayage and hair styling.";
}

// Add Listings to Search Results
function amre_add_listings_to_search($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search) {
        $post_types = $query->get('post_type');
        if ( empty($post_types) ) {
            $query->set('post_type', array('post', 'page', 'listing'));
        }
    }
}
add_action('pre_get_posts','amre_add_listings_to_search');

