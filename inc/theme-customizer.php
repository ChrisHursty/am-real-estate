<?php
/**
 * AMRE WP functions and definitions
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function amre_wp_customize_register( $wp_customize ) {
    // Add a new panel for the Footer
    $wp_customize->add_panel('footer_panel', array(
        'title' => __('AMRE Footer', 'amre-wp'),
        'priority' => 90, // Adjust the priority to position it
    ));

    // Add a section within the panel
    $wp_customize->add_section('footer_settings_section', array(
        'title' => __('Footer Settings', 'amre-wp'),
        'panel' => 'footer_panel',
        'priority' => 90, // Adjust the priority to position it
    ));

    // Add settings for logo upload
    $wp_customize->add_setting('footer_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label' => __('Footer Logo', 'amre-wp'),
        'section' => 'footer_settings_section',
        'settings' => 'footer_logo',
    )));

    // Add settings for the text area
    $wp_customize->add_setting('footer_text', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_text', array(
        'type' => 'textarea',
        'label' => __('Footer Text', 'amre-wp'),
        'section' => 'footer_settings_section',
    ));

    // Footer Copyright
    $wp_customize->add_setting('footer_copyright_text', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_copyright_text', array(
        'type' => 'textarea',
        'label' => __('Footer Copyright Text', 'amre-wp'),
        'section' => 'footer_settings_section',
    ));

    // Add AM Style Options Panel
    $wp_customize->add_panel('am_style_options_panel', array(
        'title' => __('AM Style Options', 'amre-wp'),
        'description' => __('Customize the overall style of your site', 'amre-wp'),
        'priority' => 40,
    ));

    // Add Typography Section
    $wp_customize->add_section('typography_section', array(
        'title' => __('Typography', 'amre-wp'),
        'panel' => 'am_style_options_panel',
        'priority' => 10,
    ));

    // Heading Font Family
    $wp_customize->add_setting('heading_font_family', array(
        'default' => 'Roboto',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('heading_font_family', array(
        'label' => __('Heading Font Family', 'amre-wp'),
        'section' => 'typography_section',
        'type' => 'text',
        'input_attrs' => array(
            'class' => 'google-font-autocomplete',
            'data-font-type' => 'heading'
        ),
        'priority' => 10,
    ));

    // Add heading font text transform setting
    $wp_customize->add_setting('heading_font_transform', array(
        'default'           => 'none',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    // Add heading font text transform control
    $wp_customize->add_control('heading_font_transform', array(
        'label'    => __('Heading Text Transform', 'amre-wp'),
        'section'  => 'typography_section',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __('None', 'amre-wp'),
            'uppercase'  => __('Uppercase', 'amre-wp'),
            'lowercase'  => __('Lowercase', 'amre-wp'),
            'capitalize' => __('Capitalize', 'amre-wp'),
            'italic'     => __('Italic', 'amre-wp'),
            'oblique'    => __('Oblique', 'amre-wp'),
        ),
        'priority' => 11,
    ));

    // Add heading font weight setting
    $wp_customize->add_setting('heading_font_weight', array(
        'default'           => 'normal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    // Add heading font weight control
    $wp_customize->add_control('heading_font_weight', array(
        'label'    => __('Heading Font Weight', 'amre-wp'),
        'section'  => 'typography_section',
        'type'     => 'select',
        'choices'  => array(
            'normal'     => __('Normal', 'amre-wp'),
            '100'       => __('Thin (100)', 'amre-wp'),
            '200'       => __('Extra Light (200)', 'amre-wp'),
            '300'       => __('Light (300)', 'amre-wp'),
            '400'       => __('Regular (400)', 'amre-wp'),
            '500'       => __('Medium (500)', 'amre-wp'),
            '600'       => __('Semi Bold (600)', 'amre-wp'),
            '700'       => __('Bold (700)', 'amre-wp'),
            '800'       => __('Extra Bold (800)', 'amre-wp'),
            '900'       => __('Black (900)', 'amre-wp'),
        ),
        'priority' => 12,
    ));

    // Body Font Family
    $wp_customize->add_setting('body_font_family', array(
        'default' => 'Open Sans',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('body_font_family', array(
        'label' => __('Body Font Family', 'amre-wp'),
        'section' => 'typography_section',
        'type' => 'text',
        'input_attrs' => array(
            'class' => 'google-font-autocomplete',
            'data-font-type' => 'body'
        ),
    ));

    // Add Colors Section
    $wp_customize->add_section('color_section', array(
        'title' => __('Colors', 'amre-wp'),
        'panel' => 'am_style_options_panel',
        'priority' => 20,
    ));

    // Primary Color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Primary Color', 'amre-wp'),
        'section' => 'color_section',
    )));

    // Secondary Color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => __('Secondary Color', 'amre-wp'),
        'section' => 'color_section',
    )));

    // Add Layout Section
    $wp_customize->add_section('layout_section', array(
        'title' => __('Layout', 'amre-wp'),
        'panel' => 'am_style_options_panel',
        'priority' => 30,
    ));

    // Container Width
    $wp_customize->add_setting('container_width', array(
        'default' => '1200',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('container_width', array(
        'label' => __('Container Width (px)', 'amre-wp'),
        'section' => 'layout_section',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 800,
            'max' => 2000,
            'step' => 10,
        ),
    ));

    // Add Spacing Section
    $wp_customize->add_section('spacing_section', array(
        'title' => __('Spacing', 'amre-wp'),
        'panel' => 'am_style_options_panel',
        'priority' => 40,
    ));

    // Section Padding
    $wp_customize->add_setting('section_padding', array(
        'default' => '60',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('section_padding', array(
        'label' => __('Section Padding (px)', 'amre-wp'),
        'section' => 'spacing_section',
        'type' => 'number',
    ));

    // Button Vertical Spacing
    $wp_customize->add_setting('button_vertical_spacing', array(
        'default' => '15',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('button_vertical_spacing', array(
        'label' => __('Button Vertical Spacing (px)', 'amre-wp'),
        'description' => __('Add vertical margin/padding around buttons', 'amre-wp'),
        'section' => 'spacing_section',
        'type' => 'number',
        'priority' => 20,
    ));

    // Section Vertical Spacing
    $wp_customize->add_setting('section_vertical_spacing', array(
        'default' => '60',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('section_vertical_spacing', array(
        'label' => __('Section Vertical Spacing (px)', 'amre-wp'),
        'description' => __('Add vertical margin/padding between sections', 'amre-wp'),
        'section' => 'spacing_section',
        'type' => 'number',
        'priority' => 30,
    ));

    // Add Header Section
    $wp_customize->add_section('header_section', array(
        'title'    => __('Header', 'amre-wp'),
        'panel'    => 'am_style_options_panel',
        'priority' => 30,
    ));

    // Header Background Color
    $wp_customize->add_setting('header_bg_color', array(
        'default'           => '#3f5a36',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label'    => __('Header Background Color', 'amre-wp'),
        'section'  => 'header_section',
        'priority' => 10,
    )));

    // Header Transparent Option
    $wp_customize->add_setting('header_transparent', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('header_transparent', array(
        'label'    => __('Transparent Header', 'amre-wp'),
        'section'  => 'header_section',
        'type'     => 'checkbox',
        'priority' => 20,
    ));

    // Header Font Color
    $wp_customize->add_setting('header_font_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_font_color', array(
        'label'    => __('Header Font Color', 'amre-wp'),
        'section'  => 'header_section',
        'priority' => 30,
    )));

    // Header Font Weight
    $wp_customize->add_setting('header_font_weight', array(
        'default'           => 'normal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('header_font_weight', array(
        'label'    => __('Header Font Weight', 'amre-wp'),
        'section'  => 'header_section',
        'type'     => 'select',
        'choices'  => array(
            'normal' => __('Normal', 'amre-wp'),
            '300'   => __('Light (300)', 'amre-wp'),
            '400'   => __('Regular (400)', 'amre-wp'),
            '500'   => __('Medium (500)', 'amre-wp'),
            '600'   => __('Semi Bold (600)', 'amre-wp'),
            '700'   => __('Bold (700)', 'amre-wp'),
        ),
        'priority' => 40,
    ));

    // Header Font Size
    $wp_customize->add_setting('header_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('header_font_size', array(
        'label'       => __('Header Font Size (px)', 'amre-wp'),
        'section'     => 'header_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 32,
            'step' => 1,
        ),
        'priority'    => 45,
    ));

    // Header Border Radius
    $wp_customize->add_setting('header_border_radius', array(
        'default'           => '0',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('header_border_radius', array(
        'label'       => __('Header Border Radius (px)', 'amre-wp'),
        'section'     => 'header_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 50,
            'step' => 1,
        ),
        'priority'    => 50,
    ));

    // Add Footer Section
    $wp_customize->add_section('footer_section', array(
        'title'    => __('Footer', 'amre-wp'),
        'panel'    => 'am_style_options_panel',
        'priority' => 40,
    ));

    // Footer Background Color
    $wp_customize->add_setting('footer_bg_color', array(
        'default'           => '#3f5a36',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', array(
        'label'    => __('Footer Background Color', 'amre-wp'),
        'section'  => 'footer_section',
        'priority' => 10,
    )));

    // Footer Font Color
    $wp_customize->add_setting('footer_font_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_font_color', array(
        'label'    => __('Footer Font Color', 'amre-wp'),
        'section'  => 'footer_section',
        'priority' => 20,
    )));

    // Footer Font Weight
    $wp_customize->add_setting('footer_font_weight', array(
        'default'           => 'normal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('footer_font_weight', array(
        'label'    => __('Footer Font Weight', 'amre-wp'),
        'section'  => 'footer_section',
        'type'     => 'select',
        'choices'  => array(
            'normal' => __('Normal', 'amre-wp'),
            '300'   => __('Light (300)', 'amre-wp'),
            '400'   => __('Regular (400)', 'amre-wp'),
            '500'   => __('Medium (500)', 'amre-wp'),
            '600'   => __('Semi Bold (600)', 'amre-wp'),
            '700'   => __('Bold (700)', 'amre-wp'),
        ),
        'priority' => 30,
    ));
}

add_action( 'customize_register', 'amre_wp_customize_register' );

function amre_wp_add_customizer_setting( $wp_customize, $section, $setting_id, $label, $type ) {
  $wp_customize->add_setting( $setting_id, array(
      'default' => '',
      'sanitize_callback' => 'wp_kses_post',
  ));

  $control_type = 'WP_Customize_Control';
  if ( $type === 'textarea' ) {
      $control_type = 'WP_Customize_Control';
      $type = 'textarea';
  } elseif ( $type === 'color' ) {
      $control_type = 'WP_Customize_Color_Control';
  }

  $wp_customize->add_control( new $control_type( $wp_customize, $setting_id, array(
      'label' => $label,
      'section' => $section,
      'settings' => $setting_id,
      'type' => $type,
  )));
}
