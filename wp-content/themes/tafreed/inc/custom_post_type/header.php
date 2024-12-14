<?php
/**
 * Post Name: Header & Footer Manager
 * Description: Custom post type for managing Header & Footer via ACF fields.
 * Author: Jaya Surya
 * Version: 1.0
 */

// Register the custom post type
function header_post_type() {
    $labels = array(
        'name' => _x('Header', 'Post Type General Name', 'tafreed'),
        'singular_name' => _x('Header', 'Post Type Singular Name', 'tafreed'),
        'menu_name' => __('Header & Footer', 'tafreed'),
        'all_items' => __('Header & Footer', 'tafreed'),
        'edit_item' => __('Edit Header & Footer', 'tafreed'),
        'not_found' => __('Not Found', 'tafreed'),
        'not_found_in_trash' => __('Not Found in Trash', 'tafreed'),
    );
    $args = array(
        'label' => __('header-footer', 'tafreed'),
        'description' => __('Manage Header & Footer', 'tafreed'),
        'labels' => $labels,
        'supports' => array('editor', 'custom-fields'), // Removed title support
        'hierarchical' => false,
        'public' => false, // Not accessible publicly
        'show_ui' => true,
        'show_in_menu' => false, // Hidden default menu
        'capability_type' => 'page',
    );

    register_post_type('header', $args);
}
add_action('init', 'header_post_type', 0);

// Add a custom admin menu for the Header & Footer
function header_footer_register() {
    // Check if a Header post exists; if not, create one
    $header_post = get_posts(array(
        'post_type' => 'header',
        'numberposts' => 1,
    ));

    if (empty($header_post)) {
        $post_id = wp_insert_post(array(
            'post_title' => 'Header & Footer',
            'post_type' => 'header',
            'post_status' => 'publish',
        ));
    } else {
        $post_id = $header_post[0]->ID;
    }

    // Add a custom menu item linking directly to the edit page of the first Header post
    $edit_link = admin_url('post.php?post=' . $post_id . '&action=edit');

    add_menu_page(
        'Header & Footer', // Page title
        'Header & Footer', // Menu title
        'manage_options',  // Capability
        $edit_link,        // Menu slug (structured link)
        '',                // Callback (not needed for redirect links)
        'dashicons-admin-page', // Icon
        21                 // Position
    );
}
add_action('admin_menu', 'header_footer_register');

// Completely remove "Add New" button and related UI
function completely_remove_add_new_for_header() {
    global $submenu;

    // Remove "Add New" from submenu
    if (isset($submenu['edit.php?post_type=header'])) {
        unset($submenu['edit.php?post_type=header'][10]); // "Add New" submenu
    }

    // Remove "Add New" button from admin toolbar
    add_action('admin_head', function () {
        echo '<style>
            body.post-type-header .page-title-action,
            #favorite-actions,
            #wp-admin-bar-new-header { 
                display: none !important; 
            }
        </style>';
    });
}
add_action('admin_menu', 'completely_remove_add_new_for_header');
