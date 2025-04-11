<?php
/**
 * AMRE WP Custom Post Types
 *
 * @package AMRE WP
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Testimonials CPT
function register_testimonial_post_type() {
    $args = array(
        'public'        => true,
        'label'         => 'Testimonials',
        'supports'      => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon'     => 'dashicons-groups',
        'menu_position' => 6,
    );
    register_post_type('testimonial', $args);
  }
  add_action('init', 'register_testimonial_post_type');

// Portfolio Custom Post Type
function portfolio() {

	$labels = array(
		'name'                  => _x( 'Portfolio', 'Post Type General Name', 'amre-wp' ),
		'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', 'amre-wp' ),
		'menu_name'             => __( 'Portfolio', 'amre-wp' ),
		'name_admin_bar'        => __( 'Portfolio', 'amre-wp' ),
		'archives'              => __( 'Portfolio Archives', 'amre-wp' ),
		'attributes'            => __( 'Item Attributes', 'amre-wp' ),
		'parent_item_colon'     => __( 'Parent Item:', 'amre-wp' ),
		'all_items'             => __( 'All Portfolio Items', 'amre-wp' ),
		'add_new_item'          => __( 'Add New Portfolio Item', 'amre-wp' ),
		'add_new'               => __( 'Add New Portfolio Item', 'amre-wp' ),
		'new_item'              => __( 'New Item', 'amre-wp' ),
		'edit_item'             => __( 'Edit Item', 'amre-wp' ),
		'update_item'           => __( 'Update Item', 'amre-wp' ),
		'view_item'             => __( 'View Item', 'amre-wp' ),
		'view_items'            => __( 'View Items', 'amre-wp' ),
		'search_items'          => __( 'Search Item', 'amre-wp' ),
		'not_found'             => __( 'Not found', 'amre-wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'amre-wp' ),
		'featured_image'        => __( 'Featured Image', 'amre-wp' ),
		'set_featured_image'    => __( 'Set featured image', 'amre-wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'amre-wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'amre-wp' ),
		'insert_into_item'      => __( 'Insert into item', 'amre-wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'amre-wp' ),
		'items_list'            => __( 'Items list', 'amre-wp' ),
		'items_list_navigation' => __( 'Items list navigation', 'amre-wp' ),
		'filter_items_list'     => __( 'Filter items list', 'amre-wp' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio Item', 'amre-wp' ),
		'description'           => __( 'Post Type Description', 'amre-wp' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'post_tag', 'genres' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
        'menu_icon'             => 'dashicons-portfolio',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'portfolio', 0 );

// Genre Custom Taxonomy
function amre_create_genre_taxonomy() {
    $labels = array(
        'name'          => _x('Genres', 'Taxonomy General Name', 'amre-wp'),
        'singular_name' => _x('Genre', 'Taxonomy Singular Name', 'amre-wp'),
    );

    $args = array(
        'labels'       => $labels,
        'hierarchical' => true,
        'public'       => true,
        'show_in_rest' => true,
    );

    register_taxonomy('genre', array('portfolio'), $args);
}

add_action('init', 'amre_create_genre_taxonomy');

function company_post_type() {
    $labels = array(
        'name'                  => _x('Companies', 'Post Type General Name', 'amre-wp'),
        'singular_name'         => _x('Company', 'Post Type Singular Name', 'amre-wp'),
        'menu_name'             => __('Companies', 'amre-wp'),
        'name_admin_bar'        => __('Company', 'amre-wp'),
        'archives'              => __('Company Archives', 'amre-wp'),
        'attributes'            => __('Company Attributes', 'amre-wp'),
        'parent_item_colon'     => __('Parent Company:', 'amre-wp'),
        'all_items'             => __('All Companies', 'amre-wp'),
        'add_new_item'          => __('Add New Company', 'amre-wp'),
        'add_new'               => __('Add New', 'amre-wp'),
        'new_item'              => __('New Company', 'amre-wp'),
        'edit_item'             => __('Edit Company', 'amre-wp'),
        'update_item'           => __('Update Company', 'amre-wp'),
        'view_item'             => __('View Company', 'amre-wp'),
        'view_items'            => __('View Companies', 'amre-wp'),
        'search_items'          => __('Search Company', 'amre-wp'),
        'not_found'             => __('Not found', 'amre-wp'),
        'not_found_in_trash'    => __('Not found in Trash', 'amre-wp'),
        'featured_image'        => __('Featured Image', 'amre-wp'),
        'set_featured_image'    => __('Set featured image', 'amre-wp'),
        'remove_featured_image' => __('Remove featured image', 'amre-wp'),
        'use_featured_image'    => __('Use as featured image', 'amre-wp'),
        'insert_into_item'      => __('Insert into company', 'amre-wp'),
        'uploaded_to_this_item' => __('Uploaded to this company', 'amre-wp'),
        'items_list'            => __('Companies list', 'amre-wp'),
        'items_list_navigation' => __('Companies list navigation', 'amre-wp'),
        'filter_items_list'     => __('Filter companies list', 'amre-wp'),
    );

    $args = array(
        'label'               => __('Company', 'amre-wp'),
        'description'         => __('Post Type Description', 'amre-wp'),
        'labels'              => $labels,
        'supports'            => array('title', 'thumbnail'),
        'taxonomies'          => array('category', 'post_tag'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-building',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    );

    register_post_type('company', $args);
}

add_action('init', 'company_post_type');

// Register Custom Post Type for Open Houses
function amre_wp_open_houses_cpt() {

    $labels = array(
        'name'                  => _x( 'Open Houses', 'Post Type General Name', 'amre-wp' ),
        'singular_name'         => _x( 'Open House', 'Post Type Singular Name', 'amre-wp' ),
        'menu_name'             => __( 'Open Houses', 'amre-wp' ),
        'name_admin_bar'        => __( 'Open Houses', 'amre-wp' ),
        'archives'              => __( 'Open House Archives', 'amre-wp' ),
        'attributes'            => __( 'Open House Attributes', 'amre-wp' ),
        'parent_item_colon'     => __( 'Parent Open Houses:', 'amre-wp' ),
        'all_items'             => __( 'All Open Houses', 'amre-wp' ),
        'add_new_item'          => __( 'Add New Open House', 'amre-wp' ),
        'add_new'               => __( 'Add New', 'amre-wp' ),
        'new_item'              => __( 'New Open House', 'amre-wp' ),
        'edit_item'             => __( 'Edit Open House', 'amre-wp' ),
        'update_item'           => __( 'Update Open House', 'amre-wp' ),
        'view_item'             => __( 'View Open House', 'amre-wp' ),
        'view_items'            => __( 'View Open Houses', 'amre-wp' ),
        'search_items'          => __( 'Search Open House', 'amre-wp' ),
        'not_found'             => __( 'Not found', 'amre-wp' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'amre-wp' ),
        'featured_image'        => __( 'Featured Image', 'amre-wp' ),
        'set_featured_image'    => __( 'Set featured image', 'amre-wp' ),
        'remove_featured_image' => __( 'Remove featured image', 'amre-wp' ),
        'use_featured_image'    => __( 'Use as featured image', 'amre-wp' ),
        'insert_into_item'      => __( 'Insert into Open House', 'amre-wp' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Open House', 'amre-wp' ),
        'items_list'            => __( 'Open Housess list', 'amre-wp' ),
        'items_list_navigation' => __( 'SOpen Houses list navigation', 'amre-wp' ),
        'filter_items_list'     => __( 'Filter Open Housess list', 'amre-wp' ),
    );
    $args = array(
        'label'                 => __( 'Open House', 'amre-wp' ),
        'description'           => __( 'Open Houses', 'amre-wp' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-home',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'open-houses-near-me', 'with_front' => false ),
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'open_houses', $args );

}
add_action( 'init', 'amre_wp_open_houses_cpt', 0 );

// ========== Register "Listing" CPT ==========
function amre_register_listings_cpt() {

    $labels = array(
        'name'                  => _x( 'Listings', 'Post Type General Name', 'textdomain' ),
        'singular_name'         => _x( 'Listing', 'Post Type Singular Name', 'textdomain' ),
        'menu_name'             => __( 'Listings', 'textdomain' ),
        'name_admin_bar'        => __( 'Listing', 'textdomain' ),
        'add_new_item'          => __( 'Add New Listing', 'textdomain' ),
        'edit_item'             => __( 'Edit Listing', 'textdomain' ),
        'new_item'              => __( 'New Listing', 'textdomain' ),
        'view_item'             => __( 'View Listing', 'textdomain' ),
        'all_items'             => __( 'All Listings', 'textdomain' ),
        'search_items'          => __( 'Search Listings', 'textdomain' ),
        'not_found'             => __( 'No listings found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No listings found in Trash.', 'textdomain' ),
    );

    $args = array(
        'label'               => __( 'Listing', 'textdomain' ),
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,        // This enables archive-listing.php
        'rewrite'             => array( 'slug' => 'listings' ),
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-admin-home',
        'supports'            => array( 'title', 'editor', 'thumbnail' ), 
        // If you're using ACF for fields like price/bedrooms, 
        // you can keep 'custom-fields' out of 'supports' 
        // or include if you want native custom fields.
        'show_in_rest'        => true,  // For Gutenberg or REST integration
    );

    register_post_type( 'listing', $args );
}
add_action( 'init', 'amre_register_listings_cpt' );

// ========== Register Taxonomies (Location, Property Type) ==========
function amre_register_listing_taxonomies() {

    // "Location" – Hierarchical
    $labels_location = array(
        'name'              => _x( 'Locations', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Location', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Locations', 'textdomain' ),
        'all_items'         => __( 'All Locations', 'textdomain' ),
        'parent_item'       => __( 'Parent Location', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Location:', 'textdomain' ),
        'edit_item'         => __( 'Edit Location', 'textdomain' ),
        'update_item'       => __( 'Update Location', 'textdomain' ),
        'add_new_item'      => __( 'Add New Location', 'textdomain' ),
        'new_item_name'     => __( 'New Location Name', 'textdomain' ),
        'menu_name'         => __( 'Locations', 'textdomain' ),
    );
    
    $args_location = array(
        'hierarchical'      => true,
        'labels'            => $labels_location,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'location' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'location', array( 'listing' ), $args_location );

    // "Property Type" – Hierarchical
    $labels_type = array(
        'name'              => _x( 'Property Types', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Property Type', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Property Types', 'textdomain' ),
        'all_items'         => __( 'All Property Types', 'textdomain' ),
        'parent_item'       => __( 'Parent Property Type', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Property Type:', 'textdomain' ),
        'edit_item'         => __( 'Edit Property Type', 'textdomain' ),
        'update_item'       => __( 'Update Property Type', 'textdomain' ),
        'add_new_item'      => __( 'Add New Property Type', 'textdomain' ),
        'new_item_name'     => __( 'New Property Type Name', 'textdomain' ),
        'menu_name'         => __( 'Property Types', 'textdomain' ),
    );

    $args_type = array(
        'hierarchical'      => true,
        'labels'            => $labels_type,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'property-type' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'property_type', array( 'listing' ), $args_type );
}
add_action( 'init', 'amre_register_listing_taxonomies' );

/**
 * Register Neighborhoods CPT
 */
function amre_register_cpt_neighborhoods() {
    $labels = array(
        'name'                  => _x('Neighborhoods', 'Post type general name', 'amre'),
        'singular_name'         => _x('Neighborhood', 'Post type singular name', 'amre'),
        'menu_name'             => _x('Neighborhoods', 'Admin Menu text', 'amre'),
        'name_admin_bar'        => _x('Neighborhood', 'Add New on Toolbar', 'amre'),
        'add_new'               => __('Add New', 'amre'),
        'add_new_item'          => __('Add New Neighborhood', 'amre'),
        'new_item'              => __('New Neighborhood', 'amre'),
        'edit_item'             => __('Edit Neighborhood', 'amre'),
        'view_item'             => __('View Neighborhood', 'amre'),
        'all_items'             => __('All Neighborhoods', 'amre'),
        'search_items'          => __('Search Neighborhoods', 'amre'),
        'parent_item_colon'     => __('Parent Neighborhoods:', 'amre'),
        'not_found'             => __('No neighborhoods found.', 'amre'),
        'not_found_in_trash'    => __('No neighborhoods found in Trash.', 'amre'),
        'featured_image'        => _x('Neighborhood Cover Image', 'Overrides the “Featured Image” phrase', 'amre'),
        'set_featured_image'    => _x('Set neighborhood cover image', 'Overrides the “Set featured image” phrase', 'amre'),
        'remove_featured_image' => _x('Remove neighborhood cover image', 'Overrides the “Remove featured image” phrase', 'amre'),
        'use_featured_image'    => _x('Use as neighborhood cover image', 'Overrides the “Use as featured image” phrase', 'amre'),
        'archives'              => _x('Neighborhood archives', 'The post type archive label', 'amre'),
        'insert_into_item'      => _x('Insert into neighborhood', 'Overrides the “Insert into post” phrase', 'amre'),
        'uploaded_to_this_item' => _x('Uploaded to this neighborhood', 'Overrides the “Uploaded to this post” phrase', 'amre'),
        'filter_items_list'     => _x('Filter neighborhoods list', 'Screen reader text', 'amre'),
        'items_list_navigation' => _x('Neighborhoods list navigation', 'Screen reader text', 'amre'),
        'items_list'            => _x('Neighborhoods list', 'Screen reader text', 'amre'),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Neighborhood listings for your site.', 'amre'),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'neighborhoods'), 
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-admin-site',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );

    register_post_type('neighborhoods', $args);
}
add_action('init', 'amre_register_cpt_neighborhoods');
