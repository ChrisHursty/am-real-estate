<?php
/**
 * Google Fonts functionality
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Get all available Google Fonts
 */
function amre_get_google_fonts() {
    // Check for cached fonts first
    $cached_fonts = get_transient('amre_google_fonts_list');
    if ($cached_fonts !== false) {
        return $cached_fonts;
    }
    // Get API key from filter or default
    $api_key = apply_filters('amre_google_fonts_api_key', '');
    
    if (empty($api_key)) {
        return new WP_Error('missing_api_key', __('Google Fonts API key is required', 'am-real-estate'));
    }
    
    $request_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . $api_key;

    $response = wp_remote_get($request_url);

    if (is_wp_error($response)) {
        // Fallback to a basic set of fonts if API call fails
        return array(
            'Roboto' => array(
                'weights' => array('300', '400', '500', '700'),
                'styles' => array('normal', 'italic'),
            ),
            'Open Sans' => array(
                'weights' => array('300', '400', '600', '700'),
                'styles' => array('normal', 'italic'),
            ),
            // Add more fallback fonts...
        );
    }

    $fonts_data = json_decode(wp_remote_retrieve_body($response), true);
    $fonts = array();

    if (!empty($fonts_data['items'])) {
        foreach ($fonts_data['items'] as $font) {
            $fonts[$font['family']] = array(
                'weights' => $font['variants'],
                'styles' => array('normal', 'italic'),
                'category' => $font['category'],
            );
        }
    }

    // Cache the fonts for 1 week
    set_transient('amre_google_fonts_list', $fonts, WEEK_IN_SECONDS);

    return $fonts;
}

/**
 * Enqueue Google Fonts
 */
function amre_enqueue_google_fonts() {
    // Get font selections from customizer
    $heading_font = get_theme_mod('heading_font_family', 'IM Fell English SC');
    $body_font = get_theme_mod('body_font_family', 'Montserrat');
    
    // Debug output for administrators
    if (current_user_can('manage_options')) {
        error_log('Enqueuing Heading Font: ' . $heading_font);
        error_log('Enqueuing Body Font: ' . $body_font);
    }
    
    // Early exit if no fonts are selected
    if (empty($heading_font) && empty($body_font)) {
        return;
    }

    // Remove any existing font enqueues
    wp_dequeue_style('amre-heading-font');
    wp_dequeue_style('amre-body-font');
    wp_deregister_style('amre-heading-font');
    wp_deregister_style('amre-body-font');

    // Force a unique version number to prevent caching
    $version = time();

    // Prepare font URLs
    if (!empty($heading_font)) {
        $heading_font_url = 'https://fonts.googleapis.com/css2?family=' . str_replace(' ', '+', $heading_font) . '&display=swap';
        wp_enqueue_style('amre-heading-font', esc_url_raw($heading_font_url), array(), $version);
    }
    
    if (!empty($body_font) && $body_font !== $heading_font) {
        $body_font_url = 'https://fonts.googleapis.com/css2?family=' . str_replace(' ', '+', $body_font) . '&display=swap';
        wp_enqueue_style('amre-body-font', esc_url_raw($body_font_url), array(), $version);
    }
}
add_action('wp_enqueue_scripts', 'amre_enqueue_google_fonts', 1);

/**
 * Force refresh when customizer settings change
 */
function amre_handle_customizer_font_change() {
    // Clear caches
    delete_transient('amre_google_fonts_list');
    wp_cache_delete('amre_google_fonts_list', 'transient');
    
    // Force a unique version number
    update_option('amre_google_fonts_version', time());
}
add_action('customize_save_after', 'amre_handle_customizer_font_change');

/**
 * Enqueue customizer scripts
 */
function amre_customize_controls_enqueue_scripts() {
    wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
    wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '4.1.0', true);
    
    wp_enqueue_script('amre-google-fonts-autocomplete', get_template_directory_uri() . '/js/google-fonts-autocomplete.js', array('jquery', 'select2'), '1.0.0', true);
    
    $fonts = amre_get_google_fonts();
    $font_list = array();
    
    foreach ($fonts as $font_family => $font_data) {
        $font_list[] = array(
            'id' => $font_family,
            'text' => $font_family,
            'category' => $font_data['category']
        );
    }
    
    wp_localize_script('amre-google-fonts-autocomplete', 'amreGoogleFonts', array(
        'fonts' => $font_list
    ));

    // Add custom styles for the font selector
    $custom_css = "
        .select2-container {
            min-width: 200px;
        }
        .select2-results__option {
            padding: 8px;
            font-size: 14px;
        }
        .select2-results__option .font-preview {
            font-size: 16px;
            margin-top: 4px;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #0073aa;
        }
    ";
    wp_add_inline_style('select2', $custom_css);
}
add_action('customize_controls_enqueue_scripts', 'amre_customize_controls_enqueue_scripts'); 