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

    /*--------------------------------------------------------------
	# SECTION: Paragraph Styles
	--------------------------------------------------------------*/
	$wp_customize->add_section(
		'am_paragraph_styles',
		array(
			'title'       => __( 'Paragraph Styles', 'amre' ),
			'panel'       => 'am_style_options_panel',
			'priority'    => 10,
			'description' => __( 'Adjust default paragraph line-height and space after paragraphs.', 'amre' ),
		)
	);

	/* Line Height */
	$wp_customize->add_setting(
		'am_p_line_height',
		array(
			'default'           => '1.6',
			'type'              => 'theme_mod',
			'sanitize_callback' => function( $value ) {
				return ( is_numeric( $value ) && $value > 0 ) ? $value : '1.6';
			},
		)
	);

	$wp_customize->add_control(
		'am_p_line_height',
		array(
			'label'       => __( 'Line height (unit-less)', 'amre' ),
			'section'     => 'am_paragraph_styles',
			'type'        => 'number',
			'input_attrs' => array(
				'step' => '0.1',
				'min'  => '1',
				'max'  => '3',
			),
		)
	);

	/* === Setting : Space below paragraphs ======================= */
	$wp_customize->add_setting(
		'am_p_margin_bottom',
		array(
			'default'           => '1.1',
			'type'              => 'theme_mod',
			'sanitize_callback' => function( $value ) {
				return ( is_numeric( $value ) && $value >= 0 ) ? $value : '1.1';
			},
		)
	);

	$wp_customize->add_control(
		'am_p_margin_bottom',
		array(
			'label'       => __( 'Space below paragraphs (em)', 'amre' ),
			'section'     => 'am_paragraph_styles',
			'type'        => 'number',
			'input_attrs' => array(
				'step' => '0.1',
				'min'  => '0',
				'max'  => '5',
			),
		)
	);

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
        'label' => __('Primary Color (Headings)', 'amre-wp'),
        'section' => 'color_section',
    )));

    // Secondary Color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => __('Secondary Color (Body Text)', 'amre-wp'),
        'section' => 'color_section',
    )));

    // Add Layout Section
    $wp_customize->add_section('layout_section', array(
        'title' => __('Layout', 'amre-wp'),
        'panel' => 'am_style_options_panel',
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
