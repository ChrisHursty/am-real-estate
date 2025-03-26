<?php
/**
 * AMRE WP functions and definitions
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'AM Real Estate Theme Options',
        'menu_title'    => 'AM Real Estate Theme Options',
        'menu_slug'     => 'amre-theme-options',
        'capability'    => 'manage_options',
        'redirect'      => false,
    ));
}

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_social_media',
        'title' => 'Social Media',
        'fields' => array(
            array(
                'key' => 'field_social_media_profiles',
                'label' => 'Social Profiles',
                'name' => 'social_profiles',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Profile',
                'sub_fields' => array(
                    array(
                        'key' => 'field_social_media_name',
                        'label' => 'Social Network Name',
                        'name' => 'social_network_name',
                        'type' => 'text',
                        'instructions' => 'Enter the name of the social network (e.g., Facebook, Twitter).',
                        'required' => 1, // Making this field required
                    ),
                    array(
                        'key' => 'field_social_media_url',
                        'label' => 'Profile URL',
                        'name' => 'profile_url',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_social_media_icon_type',
                        'label' => 'Icon Type',
                        'name' => 'icon_type',
                        'type' => 'radio',
                        'choices' => array(
                            'fontawesome' => 'FontAwesome',
                            'svg' => 'SVG'
                        ),
                        'layout' => 'horizontal',
                    ),
                    array(
                        'key' => 'field_social_media_icon',
                        'label' => 'FontAwesome Class',
                        'name' => 'fontawesome_class',
                        'type' => 'text',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_social_media_icon_type',
                                    'operator' => '==',
                                    'value' => 'fontawesome',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_social_media_svg',
                        'label' => 'SVG Icon',
                        'name' => 'svg_icon',
                        'type' => 'file',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_social_media_icon_type',
                                    'operator' => '==',
                                    'value' => 'svg',
                                ),
                            ),
                        ),
                        'return_format' => 'url',
                        'mime_types' => 'svg', // Restrict to SVG files only
                    ),
                    array(
                        'key' => 'field_social_media_color',
                        'label' => 'Icon Color',
                        'name' => 'icon_color',
                        'type' => 'color_picker',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_social_media_icon_type',
                                    'operator' => '==',
                                    'value' => 'fontawesome',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'amre-theme-options',
                ),
            ),
        ),
    ));
}

